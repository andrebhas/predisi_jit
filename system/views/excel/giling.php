<?php
$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle('Pembelian ( Periode '.$bulan.'-'.$tahun.' )');
$sheet->getStyle('A1:J2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:J2')->getFont()->setBold(true);
$sheet->getStyle('A1:J2')->getFill()->applyFromArray(
        array('type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => "1CC6FF")));

$sheet->mergeCells('A1:A2');
$sheet->getStyle('A1:A2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A1', "No");

$sheet->mergeCells('B1:B2');
$sheet->getStyle('B1:B2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('B1', "Tanggal");

$sheet->mergeCells('C1:C2');
$sheet->getStyle('C1:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C1', "Pemasok");

$sheet->mergeCells('D1:D2');
$sheet->getStyle('D1:D2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('D1', "Berat");

$sheet->mergeCells('E1:E2');
$sheet->getStyle('E1:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('E1', "Beras");

$sheet->mergeCells('F1:F2');
$sheet->getStyle('F1:F2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('F1', "M GL B");

$sheet->mergeCells('G1:G2');
$sheet->getStyle('G1:G2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('G1', "Hasil(Kg)");

$sheet->mergeCells('H1:H2');
$sheet->getStyle('H1:H2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('H1', "Hasil(%)");

$sheet->mergeCells('I1:I2');
$sheet->getStyle('I1:I2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('I1', "Standar Harga Beras");

$sheet->mergeCells('J1:J2');
$sheet->getStyle('J1:J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('J1', "Keterangan");


$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->getColumnDimension('I')->setWidth(20);
$sheet->getColumnDimension('J')->setWidth(30);


$i = 1;
foreach ($data->result_array() as $v) {
    $sheet->getStyle('A' . (2 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('B' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('C' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('D' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('E' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('F' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('G' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('H' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('I' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('J' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    
	$sheet->setCellValue('A' . (2 + $i), $i);
    $sheet->setCellValue('B' . (2 + $i), $v['tgl']);
    $sheet->setCellValue('C' . (2 + $i), $v['nama']);
    $sheet->setCellValue('D' . (2 + $i), $v['berat']);
    $sheet->setCellValue('E' . (2 + $i), $v['beras']);
    $sheet->setCellValue('F' . (2 + $i), $v['mglb']);
    $sheet->setCellValue('G' . (2 + $i), $v['hasil']);
    $sheet->setCellValue('H' . (2 + $i), $v['hasilp']);
    $sheet->setCellValue('I' . (2 + $i), $v['harga']);
	$sheet->setCellValue('J' . (2 + $i), $v['ket']);
	
    $i++;
}

$sheet->getStyle('A1:H' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:H' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow()+1), "Exported on ".date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
