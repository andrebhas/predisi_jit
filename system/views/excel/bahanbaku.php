<?php

$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle($title);
$sheet->getStyle('A1:G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:G3')->getFont()->setBold(true);
$sheet->getStyle('A2:G3')->getFill()->applyFromArray(
        array('type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => "1CC6FF")));

$sheet->mergeCells('A1:G1');
$sheet->setCellValue('A1', strtoupper($title));

$sheet->mergeCells('A2:A3');
$sheet->getStyle('A2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A2', "No");

$sheet->mergeCells('B2:B3');
$sheet->getStyle('B2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('B2', "Nama Bahan Baku");

$sheet->mergeCells('C2:E2');
$sheet->getStyle('C2:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C2', "Refaksi");

$sheet->getStyle('C3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C3', "Kadar Air");
$sheet->getStyle('D3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('D3', "Hampa");
$sheet->getStyle('E3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('E3', "Broken");

$sheet->mergeCells('F2:F3');
$sheet->getStyle('F2:F3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('F2', "Kategori");

$sheet->mergeCells('G2:G3');
$sheet->getStyle('G2:G3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('G2', "Harga Beli");

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(40);
$sheet->getColumnDimension('C')->setWidth(10);
$sheet->getColumnDimension('D')->setWidth(10);
$sheet->getColumnDimension('E')->setWidth(10);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(20);

$i = 1;
foreach ($data->result_array() as $v) {
    $sheet->getStyle('A' . (3 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C' . (3 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D' . (3 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E' . (3 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F' . (3 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G' . (3 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $sheet->getStyle('A' . (3 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('B' . (3 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('C' . (3 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('D' . (3 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('E' . (3 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('F' . (3 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('G' . (3 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    if ($v['type'] == 0) {
        $kategory = "Gabah";
    } else {
        $kategory = "Beras";
    }
    $sheet->setCellValue('A' . (3 + $i), $i);
    $sheet->setCellValue('B' . (3 + $i), $v['nama']);
    $sheet->setCellValue('C' . (3 + $i), ($v['A']*100) . " %");
    $sheet->setCellValue('D' . (3 + $i), ($v['B']*100) . " %");
    $sheet->setCellValue('E' . (3 + $i), ($v['C']*100) . " %");
    $sheet->setCellValue('F' . (3 + $i), $kategory);
    $sheet->setCellValue('G' . (3 + $i), $v['harga']);
    $i++;
}

$sheet->getStyle('A1:G' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:G' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow() + 1), "Exported on " . date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
