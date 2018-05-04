<?php

/**
 * 导出excel信息
 * @param string  $titles    导出的表格标题
 * @param string  $keys      需要导出的键名
 * @param array   $data      需要导出的数据
 * @param string  $file_name 导出的文件名称
 */
function export_excel($titles = '', $keys = '', $data = [], $file_name = '导出文件' )
{
    
    $objPHPExcel = get_excel_obj($file_name);
        
    $y = 1;
    $s = 0;

    $titles_arr = _arr($titles);

    foreach ($titles_arr as $k => $v) {
        
        $objPHPExcel->setActiveSheetIndex($s)->setCellValue(string_from_column_index($k). $y, $v);
    }

    $keys_arr = _arr($keys);

    foreach ($data as $k => $v)
    {

        is_object($v) && $v = $v->toArray();
        
        foreach ($v as $kk => $vv)
        {
            
            $num = array_search($kk, $keys_arr);
            
            false !== $num && $objPHPExcel->setActiveSheetIndex($s)->setCellValue(string_from_column_index($num) . ($y + $k + 1), $vv );
        }
    }

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    
    $objWriter->save('php://output'); exit;
}

/**
 * 获取excel
 */
function get_excel_obj($file_name = '导出文件')
{
    
    set_time_limit(0);

    vendor('phpoffice/phpexcel/Classes/PHPExcel');

    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
    header("Content-Type:application/force-download");
    header("Content-Type:application/vnd.ms-execl");
    header("Content-Type:application/octet-stream");
    header("Content-Type:application/download");
    header('Content-Disposition:attachment;filename='.iconv("utf-8", "gb2312", $file_name).'.xlsx');
    header("Content-Transfer-Encoding:binary");
    
    return new PHPExcel();
}

/**
 * 读取excel返回数据
 */
function get_excel_data($file_url = '', $start_row = 1, $start_col = 0)
{

    vendor('phpoffice/phpexcel/Classes/PHPExcel');

    $objPHPExcel        = PHPExcel_IOFactory::load($file_url);
    $objWorksheet       = $objPHPExcel->getActiveSheet();
    $highestRow         = $objWorksheet->getHighestDataRow(); 
    $highestColumn      = $objWorksheet->getHighestDataColumn(); 
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
    
    $excel_data = [];
    
    for ($row = $start_row; $row <= $highestRow; $row++)
    {
        for ($col = $start_col; $col < $highestColumnIndex; $col++)
        {
            $excel_data[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
        }
    }

    return $excel_data;
}

?>