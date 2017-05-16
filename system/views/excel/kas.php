<?php

$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle('Kas ( Periode ' . $bulan . '-' . $tahun . ' )');
$sheet->getStyle('A1:G2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:G1')->getFont()->setBold(true);
$sheet->getStyle('A1:G1')->getFill()->applyFromArray(
        array('type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => "1CC6FF")));

$sheet->getStyle('A1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A1', "No");

$sheet->getStyle('B1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('B1', "Kode");

$sheet->getStyle('C1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C1', "Nama");

$sheet->getStyle('D1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('D1', "Keterangan");

$sheet->getStyle('E1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('E1', "Pemasukan");

$sheet->getStyle('F1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('F1', "Pengeluaran");

$sheet->getStyle('G1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('G1', "Saldo");

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(40);
$sheet->getColumnDimension('E')->setWidth(20);
$sheet->getColumnDimension('F')->setWidth(20);
$sheet->getColumnDimension('G')->setWidth(20);
$i = 1;
$sheet->getStyle('A' . (1 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('B' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('G' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A' . (1 + $i), $i);
$sheet->mergeCells('B' . (1 + $i) . ':F' . (1 + $i));
$sheet->setCellValue('B' . (1 + $i), "Saldo Awal Bulan");
$sheet->setCellValue('G' . (1 + $i), $saldo);
$i++;
foreach ($data->result_array() as $v) {
    $debit = $v[debit];
    $kredit = $v[kredit];
    $saldo+= ($debit - $kredit);

    $sheet->getStyle('A' . (1 + $i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('B' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('C' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('D' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('E' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('F' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('G' . (1 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

    $nota = $v['id_kas'];
    $pre = "KS";
    for ($x = strlen($nota); $x < 9; $x++) {
        $pre.="0";
    }
    $nota = $pre . $nota;
    $sheet->setCellValue('A' . (1 + $i), $i);
    $sheet->setCellValue('B' . (1 + $i), $nota);
    $sheet->setCellValue('C' . (1 + $i), $v['tgl']);
    $sheet->setCellValue('D' . (1 + $i), $v['ket']);
    $sheet->setCellValue('E' . (1 + $i), $v['debit']);
    $sheet->setCellValue('F' . (1 + $i), $v['kredit']);
    $sheet->setCellValue('G' . (1 + $i), $saldo);
    $i++;
}

$sheet->getStyle('A1:H' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:H' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow()+1), "Exported on ".date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
