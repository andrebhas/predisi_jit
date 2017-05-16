<?php

$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle($title);
$sheet->getStyle('A1:D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:D2')->getFont()->setBold(true);
$sheet->getStyle('A2:D2')->getFill()->applyFromArray(
        array('type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => "1CC6FF")));

$sheet->mergeCells('A1:D1');
$sheet->setCellValue('A1', strtoupper($title));

$sheet->getStyle('A2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A2', "No");

$sheet->getStyle('B2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('B2', "Nama Produk");

$sheet->getStyle('C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C2', "Stok");

$sheet->getStyle('D2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('D2', "Harga Jual");

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(45);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(20);

$i = 1;
foreach ($data->result_array() as $v) {
    $sheet->getStyle('A' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $sheet->getStyle('A' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('B' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('C' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('D' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('A' . (2 + $i), $i);
    $sheet->setCellValue('B' . (2 + $i), $v['nama']);
    $sheet->setCellValue('C' . (2 + $i), $v['stok']);
    $sheet->setCellValue('D' . (2 + $i), $v['harga']);
    $i++;
}
$sheet->getStyle('A' . (2 + $i) . ':B' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('C' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('D' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->mergeCells('A' . (2 + $i) . ':B' . (2 + $i));
$sheet->setCellValue('A' . (2 + $i), "Total");
$sheet->setCellValue('C' . (2 + $i), "=SUM(C3:C" . (1 + $i) . ")");
$sheet->getStyle('C' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:D' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:D' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow()+1), "Exported on ".date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
