<?php
$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle('Stok '.  ucfirst($nama));

$sheet->setCellValue('B2', "Nama ".ucfirst($status));
$sheet->setCellValue('B3', "Tanggal Cetak");
if(isset($kode)){
    $nama=$kode." - ".$nama;
}
$sheet->setCellValue('C2', $nama);
$sheet->setCellValue('C3', $tanggal);

$sheet->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$sheet->setCellValue('D4', "Stok :");
$sheet->setCellValue('E4', $stok);

$sheet->getStyle('A1:E5')->getFont()->setBold(true);
$sheet->getStyle('A5:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A5:E5')->getFill()->applyFromArray(
        array('type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => "1CC6FF")));

$sheet->getStyle('A5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A5', "No");
$sheet->getStyle('B5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('B5', "Tanggal");
$sheet->getStyle('C5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C5', "Keterangan");
$sheet->getStyle('D5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('D5', "Masuk");
$sheet->getStyle('E5')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('E5', "Keluar");

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getColumnDimension('D')->setWidth(25);
$sheet->getColumnDimension('E')->setWidth(25);
$i = 1;
foreach ($data->result_array() as $v) {
    $sheet->getStyle('A' . (5 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A' . (5 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('B' . (5 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('C' . (5 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('D' . (5 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('E' . (5 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('A' . (5 + $i), $i);
    $sheet->setCellValue('B' . (5 + $i), $v['tgl']);
    $sheet->setCellValue('C' . (5 + $i), $v['ket']);
    $sheet->setCellValue('D' . (5 + $i), $v['masuk']);
    $sheet->setCellValue('E' . (5 + $i), $v['keluar']);
    $i++;
}

$sheet->getStyle('A1:E' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:E' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow()+1), "Exported on ".date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
