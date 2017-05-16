<?php

$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle($title);
$sheet->getStyle('A1:F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:F2')->getFont()->setBold(true);
$sheet->getStyle('A2:F2')->getFill()->applyFromArray(
        array('type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => "1CC6FF")));

$sheet->mergeCells('A1:F1');
$sheet->setCellValue('A1', strtoupper($title));

$sheet->getStyle('A2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A2', "No");

$sheet->getStyle('B2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('B2', "ID");

$sheet->getStyle('C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C2', "Nama");

$sheet->getStyle('D2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('D2', "Alamat");

$sheet->getStyle('E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('E2', "Kontak");

$sheet->getStyle('F2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('F2', "Saldo");

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(40);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$i = 1;
foreach ($data->result_array() as $v) {
    $sheet->getStyle('A' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $sheet->getStyle('A' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('B' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('C' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('D' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('E' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('F' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('A' . (2 + $i), $i);
    $sheet->setCellValue('B' . (2 + $i), $v['id']);
    $sheet->setCellValue('C' . (2 + $i), $v['nama']);
    $sheet->setCellValue('D' . (2 + $i), $v['alamat']);
    $sheet->setCellValue('E' . (2 + $i), $v['kontak']);
    $sheet->setCellValue('F' . (2 + $i), $v['saldo']);
    $i++;
}
$sheet->getStyle('A' . (2 + $i) . ':E' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('F' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->mergeCells('A' . (2 + $i) . ':E' . (2 + $i));
$sheet->setCellValue('A' . (2 + $i), "Total");
$sheet->setCellValue('F' . (2 + $i), "=SUM(F3:F" . (1 + $i) . ")");

$sheet->getStyle('A1:F' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:F' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow()+1), "Exported on ".date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
