<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 15-6-27
 * Time: 上午8:25
 */
class Reader extends CI_Model{

    private $INSTALL                    = 'install';
    private $FIX                        = 'fix';

    private $file_directory             = '';
    private $file_resource_name         = 'A.xlsx';
    private $file_resource_min_row      = 3;

    private $file_target_name           = 'B.xlsx';

    private $compare_column             = array();
    private $convert_map_install        = array();
    private $convert_map_fix            = array();

    private $objPHPExcel_resource       = null;
    private $objPHPExcel_target         = null;

    private $file_target_sheet_count    = 0;

    private $date_format_default        = 'm月d日';

    private $time_start                 = 0;

    public function __construct(){

        $this->time_start = microtime(true);
        $memeory_limit = 2*1024;
        if(intval(ini_get('memory_limit')) <= $memeory_limit)
        {
            ini_set('memory_limit', $memeory_limit . 'M');
        }
        ini_set('max_execution_time', 24*3600*7  );

        parent::__construct();

        $this->load->helper('phpexcel');
        $this->load->config('phpexcel');
        $this->load->library('phpexcel');
        $this->load->library('log');

        $this->file_directory           = ROOTPATH;
        $this->file_resource_name       = config_item('file_resource_name');
        $this->file_target_name         = config_item('file_target_name');
        $this->file_resource_min_row    = config_item('file_resource_min_row');

        $this->compare_column           = config_item('compare_column');
        $this->convert_map_install      = config_item('convert_map_install');
        $this->convert_map_fix          = config_item('convert_map_fix');

        $this->date_format_default      = config_item('date_format_default');

        $this->load_resource_sheets();
        $this->objPHPExcel_target       = new PHPExcel();

    }

    public function readFile(){

        $wsIterator = $this->objPHPExcel_resource->getWorksheetIterator();
        foreach ($wsIterator as $resource_sheet) {
            $sheet_index = $wsIterator->key();
            $this->write_log(' Starting convert the ' .($sheet_index + 1). ' sheet ....');
            $this->read_sheet($resource_sheet,$sheet_index);
        }
        $this->save_file();

    }

    private function load_resource_sheets(){

        $this->write_log(' Starting reading excel file, this may take minutes, please wait....');
        $file_resource_path = $this->file_directory . $this->file_resource_name;
        if(file_exists($file_resource_path)){
            $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
            $cacheSettings = array( 'memoryCacheSize' => '2GB');
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

            $reader = PHPExcel_IOFactory::createReader('Excel2007');
            $reader->setReadDataOnly(true);
            $this->objPHPExcel_resource = $reader->load($file_resource_path);
        }
        $this->write_log(' File read. starting convert:');

    }

    private function read_cell($sheet,$colmon,$row){

        return trim($sheet->getCell($colmon . $row)->getValue());

    }

    private function read_sheet($resource_sheet,$sheet_index){

        $name_prefix = $resource_sheet->getTitle();
        $install_or_fix = $this->install_or_fix($name_prefix,$sheet_index);
        $allRow = $resource_sheet->getHighestRow();

        for( $currentRow = $this->file_resource_min_row ; $currentRow <= $allRow ; $currentRow++){

            $name_suffix = '';
            foreach($this->compare_column as $diff){
                $cell_diff = $this->read_cell($resource_sheet,$diff,$currentRow);
                if(!empty($cell_diff)){
                    $name_suffix .= '-' . $cell_diff;
                }
            }

            if(!empty($name_suffix)){
                $target_sheet = $this->load_target_sheet($name_prefix . $name_suffix,$install_or_fix);
                $row = $target_sheet->getHighestRow()+1;
                $map = $this->convert_map_install;
                if($this->FIX === $install_or_fix){
                    $map = $this->convert_map_fix;
                }
                foreach($map as $colmon => $item){
                    $value = '';
                    if(!empty($item['from'])){
                        $value = $this->read_cell($resource_sheet,$item['from'],$currentRow);
                    }
                    if(isset($item['format']) && $item['format'] === 'date'){
                        $format = isset($item['format_style'])?$item['format_style']:$this->date_format_default;
                        $value = my_date_format($value,$format);
                    }
                    $target_sheet->SetCellValue($colmon . $row,$value);
                }
            }

        }

    }

    private function save_file(){

        $this->write_log(' Convert over.Saving file....');
        $this->objPHPExcel_target->setActiveSheetIndex();
        $xlsWriter = new PHPExcel_Writer_Excel5($this->objPHPExcel_target);
        $xlsWriter->save($this->file_directory . $this->file_target_name);
        $this->write_log(' Saving OK, convert successfully!');
    }

    private function load_target_sheet($name,$install_or_fix){

        if(!$this->objPHPExcel_target->getSheetByName($name)){
            $this->write_log(' Generating sheet ' . ($this->file_target_sheet_count + 1));
            $this->objPHPExcel_target->createSheet();
            if( 0 === $this->file_target_sheet_count){
                $this->objPHPExcel_target->removeSheetByIndex(0);
            }
            $this->file_target_sheet_count++;
            $this->objPHPExcel_target->setActiveSheetIndex($this->file_target_sheet_count-1);
            $this->objPHPExcel_target->getActiveSheet()->setTitle($name);

            $map = $this->convert_map_install;
            if($this->FIX === $install_or_fix){
                $map = $this->convert_map_fix;
            }
            foreach($map as $colmon => $item){
                $this->objPHPExcel_target->getActiveSheet()->SetCellValue($colmon . '1', $item['name']);
            }
        }

        return $this->objPHPExcel_target->getSheetByName($name);

    }

    private function install_or_fix($str,$sheet_index){

        if (strpos($str, '安装')) {
            return $this->INSTALL;
        }
        if (strpos($str, '维修')) {
            return $this->FIX;
        }
        $warning = 'name of sheet ' . ($sheet_index+1) .' is illegal!';
        $this->write_warning($warning);

        return null;

    }

    private function write_log($message,$with_time = TRUE){

        if($with_time){
            $message = date('Y-m-d H:i:s') . ' --  [ Memory=' . show_memory() . ',Time=' .show_time($this->time_start) . ' ] ' . ' -- ' . $message;
        }
        $message .= "\n";
        echo $message;
        $this->log->write($message);

    }

    private function write_warning($warning){
        $this->write_log("\n",false);
        $this->write_log('##############################################################',false);
        $this->write_log('#  Attention:  ' .$warning, false);
        $this->write_log('##############################################################',false);
        $this->write_log("\n",false);
    }

}