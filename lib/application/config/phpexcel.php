<?php
/**
 * Created by PhpStorm.
 * User: yin
 * Date: 15-6-27
 * Time: 上午8:44
 */
$config['file_resource_name']       = 'A.xlsx';
$config['file_resource_min_row']    = 3;
$config['file_target_name']         = 'B.xlsx';
$config['file_target_extension']    = '';

$config['compare_column']           = array(
    '0' => 'K'
);
$config['date_format_default']      = 'm月d日';

$config['resource_column_install']  = array(
    'A' => '下单时间',
    'B' => '派单时间',
    'C' => '完成时间',
    'D' => '姓名',
    'E' => '电话',
    'F' => '地址',
    'G' => '品名',
    'H' => '收款明细',
    'I' => '应收',
    'J' => '数量',
    'K' => '来源',
    'L' => '服务项目',
    'M' => '安装师傅',
    'N' => '安装卡',
    'O' => '高空补助',
    'P' => '服务情况',
    'Q' => '备注',
    'R' => '',
    'S' => '',
    'T' => '',
    'U' => '',
    'V' => '',
    'W' => '',
    'X' => '',
    'Y' => '',
    'Z' => ''
);
$config['convert_map_install']      = array(
    'A' => array(
        'from' => 'P',
        'name' => '服务情况'
    ),
    'B' => array(
        'from' => '',
        'name' => '组别'
    ),
    'C' => array(
        'from' => 'C',
        'name' => '日期',
        'format' => 'date',
        'format_style' => 'm月d日'
    ),
    'D' => array(
        'from' => 'M',
        'name' => '师傅'
    ),
    'E' => array(
        'from' => 'D',
        'name' => '姓名'
    ),
    'F' => array(
        'from' => '',
        'name' => '区域'
    ),
    'G' => array(
        'from' => 'F',
        'name' => '详细地址'
    ),
    'H' => array(
        'from' => 'E',
        'name' => '联系方式'
    ),
    'I' => array(
        'from' => 'L',
        'name' => '服务类型'
    ),
    'J' => array(
        'from' => '',
        'name' => '家电类型'
    ),
    'K' => array(
        'from' => 'G',
        'name' => '型号'
    ),
    'L' => array(
        'from' => '',
        'name' => '匹数'
    ),
    'M' => array(
        'from' => '',
        'name' => '定/变频'
    ),
    'N' => array(
        'from' => 'J',
        'name' => '数量'
    ),
    'O' => array(
        'from' => 'H',
        'name' => '收款明细'
    ),
    'P' => array(
        'from' => 'I',
        'name' => '应收'
    ),
    'Q' => array(
        'from' => '',
        'name' => '返现'
    ),
    'R' => array(
        'from' => 'N',
        'name' => '安装卡'
    ),
    'S' => array(
        'from' => 'O',
        'name' => '备注'
    ),
    'T' => array(
        'from' => 'Q',
        'name' => '业务介绍人'
    ),
    'U' => array(
        'from' => '',
        'name' => '实收合计'
    ),
    'V' => array(
        'from' => '',
        'name' => '收款方式'
    ),
    'W' => array(
        'from' => '',
        'name' => '收款时间'
    ),
    'X' => array(
        'from' => '',
        'name' => '安装提成'
    ),
    'Y' => array(
        'from' => '',
        'name' => '拆机铜管费'
    ),
    'Z' => array(
        'from' => '',
        'name' => '高空费'
    ),
    'AA' => array(
        'from' => '',
        'name' => '实发'
    ),
    'AB' => array(
        'from' => '',
        'name' => '业务介绍提成'
    ),
    'AC' => array(
        'from' => '',
        'name' => '发票号'
    ),
    'AD' => array(
        'from' => '',
        'name' => '发票时间'
    ),
    'AE' => array(
        'from' => '',
        'name' => '抬头'
    )
);




$config['resource_column__fix']     = array(
    'A' => '下单时间',
    'B' => '完成时间',
    'C' => '姓名',
    'D' => '电话',
    'E' => '地址',
    'F' => '服务项目',
    'G' => '数量',
    'H' => '收款明细',
    'I' => '应收',
    'J' => '维修单号',
    'K' => '来源',
    'L' => '维修师傅',
    'M' => '故障原因',
    'N' => '服务情况',
    'O' => '备注',
    'P' => '',
    'Q' => '',
    'R' => '',
    'S' => '',
    'T' => '',
    'U' => '',
    'V' => '',
    'W' => '',
    'X' => '',
    'Y' => '',
    'Z' => ''
);
$config['convert_map_fix']          = array(
    'A' => array(
        'from' => 'A',
        'name' => '日期',
        'format' => 'date',
        'format_style' => 'm月d日'
    ),
    'B' => array(
        'from' => 'C',
        'name' => '姓名'
    ),
    'C' => array(
        'from' => 'L',
        'name' => '安排师傅'
    ),
    'D' => array(
        'from' => 'D',
        'name' => '电话'
    ),
    'E' => array(
        'from' => 'E',
        'name' => '地址'
    ),
    'F' => array(
        'from' => '',
        'name' => '型号'
    ),
    'G' => array(
        'from' => '',
        'name' => '匹数'
    ),
    'H' => array(
        'from' => '',
        'name' => '定/变频'
    ),
    'I' => array(
        'from' => 'H',
        'name' => '收款明细'
    ),
    'J' => array(
        'from' => 'I',
        'name' => '应收'
    ),
    'K' => array(
        'from' => '',
        'name' => '返现'
    ),
    'L' => array(
        'from' => 'G',
        'name' => '数量'
    ),
    'M' => array(
        'from' => 'F',
        'name' => '服务项目'
    ),
    'N' => array(
        'from' => '',
        'name' => '安装卡'
    ),
    'O' => array(
        'from' => '',
        'name' => '高空费'
    ),
    'P' => array(
        'from' => 'M',
        'name' => '备注'
    ),
    'Q' => array(
        'from' => '',
        'name' => '维修等级'
    ),
    'R' => array(
        'from' => '',
        'name' => '提成'
    )
);

