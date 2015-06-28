<?php

if ( ! function_exists('my_date_format')){

    function my_date_format($date_excel,$format){
        $phpexcepDate = $date_excel-25569;
        $date_unix = strtotime("+$phpexcepDate days", mktime(0,0,0,1,1,1970));
        return date($format, $date_unix);
    }

}

if ( ! function_exists('show_memory')){

    function show_memory()
    {
        $size = memory_get_usage(true);
        $unit=array('b','K','M','G','T','P');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).''.$unit[$i];
    }

}

if ( ! function_exists('show_time')){

    function show_time($time_start){

        $time_end = microtime(true);
        return floor(($time_end - $time_start)) . 's';

    }

}
