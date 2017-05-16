<?php

$sheet = $objPHPExcel->setActiveSheetIndex(0);
$sheet->setTitle('Penjualan ( Periode ' . $bulan . '-' . $tahun . ' )');
$sheet->getStyle('A1:S2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:S2')->getFont()->setBold(true);
$sheet->getStyle('A1:S2')->getFill()->applyFromArray(
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
$sheet->setCellValue('D1', "Nama Customer");

$sheet->mergeCells('E1:E2');
$sheet->getStyle('E1:E2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('E1', "Alamat");

$sheet->mergeCells('F1:F2');
$sheet->getStyle('F1:F2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('F1', "Jenis Barang");

$sheet->mergeCells('G1:I1');
$sheet->getStyle('G1:I1')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('G1', "Zak");

$sheet->getStyle('G2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('G2', "Merk");

$sheet->getStyle('H2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('H2', "Jumlah");

$sheet->getStyle('I2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('I2', "Kemasan");

$sheet->mergeCells('J1:J2');
$sheet->getStyle('J1:J2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('J1', "Tonase (Kg)");

$sheet->mergeCells('K1:K2');
$sheet->getStyle('K1:K2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('K1', "Harga (Rp)");

$sheet->mergeCells('L1:L2');
$sheet->getStyle('L1:L2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('L1', "Jumlah Total (Rp)");

$sheet->mergeCells('M1:M2');
$sheet->getStyle('M1:M2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('M1', "Nopol/Nama PT");

$sheet->mergeCells('N1:N2');
$sheet->getStyle('N1:N2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('N1', "Tunai (Rp)");

$sheet->mergeCells('O1:O2');
$sheet->getStyle('O1:O2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('O1', "Total Tagihan");

$sheet->mergeCells('P1:P2');
$sheet->getStyle('P1:P2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('P1', "Kredit (Rp)");

$sheet->mergeCells('Q1:Q2');
$sheet->getStyle('Q1:Q2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('Q1', "Status");

$sheet->mergeCells('R1:R2');
$sheet->getStyle('R1:R2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('R1', "Via");

$sheet->mergeCells('S1:S2');
$sheet->getStyle('S1:S2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('S1', "Keterangan");

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
$sheet->getColumnDimension('P')->setWidth(25);
$sheet->getColumnDimension('Q')->setWidth(25);
$sheet->getColumnDimension('R')->setWidth(25);
$sheet->getColumnDimension('S')->setWidth(25);
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
    $sheet->setCellValue('F' . (2 + $i), $v['beras']);
    $sheet->getStyle('G' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('G' . (2 + $i), $v['kemasan']);
    $sheet->getStyle('H' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('H' . (2 + $i), $v['jml_kemasan']);
    $sheet->getStyle('I' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('I' . (2 + $i), $v['satuan_kemasan']);
    $sheet->getStyle('J' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('J' . (2 + $i), $v['volume']);
    $sheet->getStyle('K' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('K' . (2 + $i), $v['harga']);
    $sheet->getStyle('L' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue('L' . (2 + $i), $v['nilai']);
    $sheet->getStyle('M' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('N' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('O' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('P' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('Q' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('R' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->getStyle('S' . (2 + $i))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    if ($temp != $v['nota']) {
        if ($baris > 1) {
            $sheet->mergeCells('A' . (2 + $i - $baris) . ':A' . (2 + $i - 1));
            $sheet->mergeCells('B' . (2 + $i - $baris) . ':B' . (2 + $i - 1));
            $sheet->mergeCells('C' . (2 + $i - $baris) . ':C' . (2 + $i - 1));
            $sheet->mergeCells('D' . (2 + $i - $baris) . ':D' . (2 + $i - 1));
            $sheet->mergeCells('E' . (2 + $i - $baris) . ':E' . (2 + $i - 1));
            $sheet->mergeCells('M' . (2 + $i - $baris) . ':M' . (2 + $i - 1));
            $sheet->mergeCells('N' . (2 + $i - $baris) . ':N' . (2 + $i - 1));
            $sheet->mergeCells('O' . (2 + $i - $baris) . ':O' . (2 + $i - 1));
            $sheet->mergeCells('P' . (2 + $i - $baris) . ':P' . (2 + $i - 1));
            $sheet->mergeCells('Q' . (2 + $i - $baris) . ':Q' . (2 + $i - 1));
            $sheet->mergeCells('R' . (2 + $i - $baris) . ':R' . (2 + $i - 1));
            $sheet->mergeCells('S' . (2 + $i - $baris) . ':S' . (2 + $i - 1));
        }
        $temp = $v['nota'];
        $nota = $v['id_penjualan'];
        $pre = "PJ";
        for ($x = strlen($nota); $x < 9; $x++) {
            $pre.="0";
        }
        $nota = $pre . $nota;
        $sheet->setCellValue('A' . (2 + $i), $no);
        $sheet->setCellValue('B' . (2 + $i), $nota);
        $sheet->setCellValue('C' . (2 + $i), $v['tgl']);
        $sheet->setCellValue('D' . (2 + $i), $v['nama']);
        $sheet->setCellValue('E' . (2 + $i), $v['alamat']);
        $sheet->setCellValue('M' . (2 + $i), $v['nopol']);
        $sheet->setCellValue('N' . (2 + $i), $v['tunai']);
        $sheet->setCellValue('O' . (2 + $i), $v['tagihan']);
        $sheet->setCellValue('P' . (2 + $i), '=O' . (2 + $i) . '-N' . (2 + $i));
        $sheet->setCellValue('Q' . (2 + $i), $v['ket_penjualan']);
        $sheet->setCellValue('R' . (2 + $i), $v['via']);
        $sheet->setCellValue('S' . (2 + $i), $v['ket']);
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
    $sheet->mergeCells('M' . (2 + $i - $baris) . ':M' . (2 + $i - 1));
    $sheet->mergeCells('N' . (2 + $i - $baris) . ':N' . (2 + $i - 1));
    $sheet->mergeCells('O' . (2 + $i - $baris) . ':O' . (2 + $i - 1));
    $sheet->mergeCells('P' . (2 + $i - $baris) . ':P' . (2 + $i - 1));
    $sheet->mergeCells('Q' . (2 + $i - $baris) . ':Q' . (2 + $i - 1));
    $sheet->mergeCells('R' . (2 + $i - $baris) . ':R' . (2 + $i - 1));
    $sheet->mergeCells('S' . (2 + $i - $baris) . ':S' . (2 + $i - 1));
}
$sheet->getStyle('A1:S' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
$sheet->getStyle('A1:S' . $sheet->getHighestRow())->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->setCellValue('A' . ($sheet->getHighestRow()+1), "Exported on ".date('d M Y H:i:s'));
$output = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$output->save('php://output');
