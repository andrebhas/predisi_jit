<?php

$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle('Pembelian ( Periode ' . $bulan . '-' . $tahun . ' )');
$sheet->getStyle('A1:O2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:O2')->getFont()->setBold(true);
$sheet->getStyle('A1:O2')->getFill()->applyFromArray(
        array('type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array('rgb' => "1CC6FF")));
$sheet->mergeCells('A1:A2');
$sheet->getStyle('A1:A2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A1', "No");

$sheet->mergeCells('B1:B2');
$sheet->getStyle('B1:B2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('B1', "Nota");

$sheet->mergeCells('C1:C2');
$sheet->getStyle('C1:C2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('C1', "Tanggal");

$sheet->mergeCells('D1:D2');
$sheet->getStyle('D1:D2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('D1', "Pemasok");

$sheet->mergeCells('E1:E2');
$sheet->getStyle('E1:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('E1', "Nopol/PT");

$sheet->mergeCells('F1:F2');
$sheet->getStyle('F1:F2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('F1', "Keterangan");

$sheet->mergeCells('G1:G2');
$sheet->getStyle('G1:G2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('G1', "Jenis Beras");

$sheet->mergeCells('H1:H2');
$sheet->getStyle('H1:H2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('H1', "Volume(Kg)");

$sheet->mergeCells('I1:K1');
$sheet->getStyle('I1:K1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('I1', "Refaksi");

$sheet->getStyle('I2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('I2', "Kadar Air(%)");

$sheet->getStyle('J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('J2', "Hampa(%)");

$sheet->getStyle('K2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('K2', "Broken(%)");

$sheet->mergeCells('L1:L2');
$sheet->getStyle('L1:L2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('L1', "Netto (Kg)");

$sheet->mergeCells('M1:N1');
$sheet->getStyle('M1:N1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('M1', "Harga (Rp)");

$sheet->getStyle('M2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('M2', "Harga(Satuan)");

$sheet->getStyle('N2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('N2', "Harga(Total)");

$sheet->mergeCells('O1:O2');
$sheet->getStyle('O1:O2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('O1', "Total (Rp)");

$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(25);
$sheet->getColumnDimension('C')->setWidth(20);
$sheet->getColumnDimension('D')->setWidth(25);
$sheet->getColumnDimension('E')->setWidth(25);
$sheet->getColumnDimension('F')->setWidth(30);
$sheet->getColumnDimension('G')->setWidth(25);
$sheet->getColumnDimension('H')->setWidth(25);
$sheet->getColumnDimension('I')->setWidth(25);
$sheet->getColumnDimension('J')->setWidth(25);
$sheet->getColumnDimension('K')->setWidth(25);
$sheet->getColumnDimension('L')->setWidth(25);
$sheet->getColumnDimension('M')->setWidth(25);
$sheet->getColumnDimension('N')->setWidth(25);
$sheet->getColumnDimension('O')->setWidth(25);

$i = 1;
$no = 1;
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
    $sheet->getStyle('K' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('L' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('M' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('N' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('O' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('G' . (2 + $i), $v['beras']);
    $sheet->setCellValue('H' . (2 + $i), $v['volume']);
    $sheet->setCellValue('I' . (2 + $i), $v['air']);
    $sheet->setCellValue('J' . (2 + $i), $v['hampa']);
    $sheet->setCellValue('K' . (2 + $i), $v['broken']);
    $sheet->setCellValue('L' . (2 + $i), $v['netto']);
    $sheet->setCellValue('M' . (2 + $i), $v['harga']);
    $sheet->setCellValue('N' . (2 + $i), '=L' . (2 + $i) . '*M' . (2 + $i));
    if ($temp != $v['nota']) {
        if ($baris > 1) {
            $sheet->mergeCells('A' . (2 + $i - $baris) . ':A' . (2 + $i - 1));
            $sheet->mergeCells('B' . (2 + $i - $baris) . ':B' . (2 + $i - 1));
            $sheet->mergeCells('C' . (2 + $i - $baris) . ':C' . (2 + $i - 1));
            $sheet->mergeCells('D' . (2 + $i - $baris) . ':D' . (2 + $i - 1));
            $sheet->mergeCells('E' . (2 + $i - $baris) . ':E' . (2 + $i - 1));
            $sheet->mergeCells('F' . (2 + $i - $baris) . ':F' . (2 + $i - 1));
            $sheet->mergeCells('O' . (2 + $i - $baris) . ':O' . (2 + $i - 1));
        }
        $temp = $v['nota'];
        $nota = $v['id_pembelian'];
        $pre = "PB";
        for ($x = strlen($nota); $x < 9; $x++) {
            $pre.="0";
        }
        $nota = $pre . $nota;
        $sheet->setCellValue('A' . (2 + $i), $no);
        $sheet->setCellValue('B' . (2 + $i), $nota);
        $sheet->setCellValue('C' . (2 + $i), $v['tgl']);
        $sheet->setCellValue('D' . (2 + $i), $v['nama']);
        $sheet->setCellValue('E' . (2 + $i), $v['nopol']);
        $sheet->setCellValue('F' . (2 + $i), $v['ket']);
        $sheet->setCellValue('O' . (2 + $i), $v['total']);
        $baris = 0;
        $no++;
    }
    $baris++;
    $i++;
}
if ($baris > 1) {
    $sheet->mergeCells('A' . (2 + $i - $baris) . ':A' . (2 + $i - 1));
    $sheet->mergeCells('B' . (2 + $i - $baris) . ':B' . (2 + $i - 1));
    $sheet->mergeCells('C' . (2 + $i - $baris) . ':C' . (2 + $i - 1));
    $sheet->mergeCells('D' . (2 + $i - $baris) . ':D' . (2 + $i - 1));
    $sheet->mergeCells('E' . (2 + $i - $baris) . ':E' . (2 + $i - 1));
    $sheet->mergeCells('F' . (2 + $i - $baris) . ':F' . (2 + $i - 1));
    $sheet->mergeCells('O' . (2 + $i - $baris) . ':O' . (2 + $i - 1));
}
$sheet->getStyle('A1:O' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:O' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow()+1), "Exported on ".date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
