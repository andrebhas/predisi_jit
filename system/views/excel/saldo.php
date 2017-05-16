<?php
$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle('Saldo '.  ucfirst($status));

$sheet->setCellValue('B2', "Kode");
$sheet->setCellValue('B3', "Nama");
$sheet->setCellValue('B4', "Alamat");
$sheet->setCellValue('B5', "Kontak");
$sheet->setCellValue('B6', "Tanggal Cetak");

$sheet->setCellValue('C2', $id);
$sheet->setCellValue('C3', $nama);
$sheet->setCellValue('C4', $alamat);
$sheet->setCellValue('C5', $kontak);
$sheet->setCellValue('C6', $tanggal);

$sheet->getStyle('D7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$sheet->setCellValue('D7', "Saldo :");
$sheet->setCellValue('E7', $saldo);

$sheet->getStyle('A1:E8')->getFont()->setBold(true);
$sheet->getStyle('A8:E8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A8:E8')->getFill()->applyFromArray(
        array('type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array('rgb' => "1CC6FF")));

$sheet->getStyle('A8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A8', "No");
$sheet->getStyle('B8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('B8', "Tanggal");
$sheet->getStyle('C8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C8', "Keterangan");
$sheet->getStyle('D8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('D8', "Uang Masuk");
$sheet->getStyle('E8')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('E8', "Uang Keluar");

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(40);
$sheet->getColumnDimension('D')->setWidth(25);
$sheet->getColumnDimension('E')->setWidth(25);
$i = 1;
foreach ($data->result_array() as $v) {
    $sheet->getStyle('A' . (8 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A' . (8 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('B' . (8 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('C' . (8 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('D' . (8 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('E' . (8 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('A' . (8 + $i), $i);
    $sheet->setCellValue('B' . (8 + $i), $v['tgl']);
    $sheet->setCellValue('C' . (8 + $i), $v['ket']);
    $sheet->setCellValue('D' . (8 + $i), $v['debit']);
    $sheet->setCellValue('E' . (8 + $i), $v['kredit']);
    $i++;
}

$sheet->getStyle('A1:E' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:E' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow()+1), "Exported on ".date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
