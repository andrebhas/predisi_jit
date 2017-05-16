<div class="page-title">
    <div>
        <h1><i class="icon-file-alt"></i> <?= $title ?></h1>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <div class="box">
            <div class="box-title">
                <h3><i class="icon-reorder"></i></h3>
                <div class="box-tool">
                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                    <a data-action="close" href="#"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">


                
                    <ul class="nav nav-tabs">
                        <li class="active"><a  href="#indeks_waktu" data-toggle="tab">Indeks Waktu</a></li>
                        <li><a href="#nilai_perkiraan" data-toggle="tab">Nilai Perkiraan</a></li>
                        <li><a href="#hasil" data-toggle="tab">Hasil Perhitungan Perkiraan Nilai Stok Minimal </a></li>
	            	</ul>


			        <div class="tab-content ">

			            <div class="tab-pane active" id="indeks_waktu">
                            <?php
                                $count_tahun = count($tahun_penjualan);
                                foreach ($total_penjualan_bulan as $key => $value) {
                                    $rata_rata_bulan[] = $value/3;
                                }
                                $total_rata_rata = array_sum($rata_rata_bulan);                               
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Jumlah Penjualan</th>
                                            <th>Rata-Rata Penjualan 3 Tahun</th>
                                            <th>PROSENTASE TERHADAP TOTAL (%)</th>
                                            <th>INDEKS WAKTU</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($total_penjualan_bulan as $key => $value) {
                                    $persen[] = ($rata_rata_bulan[$key] / $total_rata_rata) * 100;
                                    $indeks[] = $persen[$key] * 12;
                                        echo "
                                        <tr>
                                            <td>".$bulan[$key]."</td>
                                            <td>Rp. ".number_format($value)."</td>
                                            <td>Rp. ".number_format($rata_rata_bulan[$key])."</td>
                                            <td>".round($persen[$key],2)." % </td>
                                            <td>".round($indeks[$key],2)."</td>
                                        </tr>
                                        ";
                                    }
                                    $total_persen = array_sum($persen);
                                    $total_indeks = array_sum($indeks);
                                    ?>
                                        <tr>
                                            <td>Total</td>
                                            <td>Rp. <?= number_format($total_penjualan) ?></td>
                                            <td>Rp. <?= number_format($total_rata_rata) ?></td>
                                            <td><?= number_format($total_persen) ?> % </td>
                                            <td><?= number_format($total_indeks) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

				        </div>



                        <div class="tab-pane" id="nilai_perkiraan">
                             <p>untuk mencari nilai perkiraan dapat menggunakan rumus 
Ft=  t ̅/(∑▒t ̅ )×y ̅. Dimana Ft adalah nilai perkiraan dan y ̅ adalah perkiraan tahunan.
Sebelum mencari nilai dari Ft, kita harus mencari nilai dari y ̅ terlebih dahulu, dengan rumus y ̅= a+b(x). Untuk mengetahui nilai y ̅ kita harus mengetahui terlebih dahulu nilai a, b, dan x terlebih dahulu. Berikut adalah tabel perhitungannya
</p>

                             <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Total Penjualan</th>
                                            <th>Rata-Rata Tengah (a)</th>
                                            <th>2013 k1</th>
                                            <th>2014 k2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $j = 1;
                                    foreach ($tahun_penjualan as $key => $value) {
                                        $thn_penjualan[] = $total_penjualan_tahun[$value['tahun']];
                                    }
                                    foreach ($tahun_penjualan as $key => $value) {
                                        $rata_rata[$j] = ( $thn_penjualan[$j] +  $thn_penjualan[$key] ) / 2 ;
                                        $j++;
                                    }
                                    foreach ($tahun_penjualan as $key => $value) {
                                        echo "
                                        <tr>
                                            <td>".$value['tahun']."</td>
                                            <td>Rp. ".number_format($thn_penjualan[$key])."</td>
                                        ";
                                        if($key == 0){
                                            echo "<td></td>";   
                                        } else {
                                            echo "<td>Rp. ".number_format($rata_rata[$key])."</td>";
                                        }
                                        for ($k=1; $k < $count_tahun; $k++) { 
                                            //if($k <> 0 ){
                                                echo "<td>".number_format($nilaix[$key][$k])."</td>";
                                            //}
                                        }
                                        echo "
                                        </tr>";
                                        //$j++;
                                    }
                                    $b = $rata_rata[2] - $rata_rata[1];
                                    ?>                                        
                                    </tbody>
                                </table>
                                <center>
                                    <h2><i>b</i> = <?= number_format($b) ?></h2>
                                </center>
                                <br>
                                <p>Tabel Perhitungan Nilai y ̅ </p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th colspan="2"><center>Tahun 2013</center></th>
                                                <th colspan="2"><center>Tahun 2014</center></th>
                                            </tr>
                                            <tr>
                                                <th>Nilai x</th>
                                                <th>y ̅= a+b(x) </th>
                                                <th>Nilai x</th>
                                                <th>y ̅= a+b(x) </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                for ($i=0; $i < $count_tahun; $i++) { 
                                                    echo "<tr>";
                                                    for ($j=0; $j < $count_tahun; $j++) { 
                                                        if($j <> 0 ){
                                                            $y[$i][$j] = $rata_rata[$j] + ($b*$nilaix[$i][$j]);
                                                            echo "
                                                                <td>".$nilaix[$i][$j]."</td>
                                                                <td> 
                                                                    y ̅= ".number_format($rata_rata[$j])." + ".number_format($b)."(".number_format($nilaix[$i][$j]).")<br>
                                                                    y ̅= Rp. ".number_format($y[$i][$j])."
                                                                </td>
                                                            ";
                                                        }
                                                    }
                                                    echo "</tr>";
                                                }
                                            ?>
                                            <tr>
                                                <?php
                                                    $rata_rata_y = ( $y[0][1] + $y[1][1] + $y[2][1] ) / 3;
                                                ?>
                                                <th>Rata Rata</th>
                                                <th>Rp. <?= number_format($rata_rata_y) ?></th>
                                                <th>Rata Rata</th>
                                                <th>Rp. <?= number_format($rata_rata_y) ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="hasil">
                            <h3>Jumlah Stok Minimal </h3>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Bulan</th>
                                            <th>Perkiraan Nilai Stok Minimal<br> (Ft=  t ̅/(∑▒t ̅ )×y ̅  )</th>
                                            <th>JUMLAH STOK MINIMAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($total_penjualan_bulan as $key => $value) {
                                        $ft[] =  ($indeks[$key] / $total_indeks) * $rata_rata_y ;
                                        $stok[] =  $ft[$key] / $harga_barang;
                                        echo "
                                        <tr>
                                            <td>".$bulan[$key]."</td>
                                            <td>Rp. ".number_format($ft[$key])."</td>
                                            <td>".number_format($stok[$key])."</td>
                                        </tr>
                                        ";
                                    }
                                    $rata_rata_ft = array_sum($ft) / 12;
                                    $rata_rata_stok = array_sum($stok) / 12;
                                    ?>
                                        <tr>
                                            <th>Rata-Rata</th>
                                            <th>Rp. <?= number_format($rata_rata_ft) ?></th>
                                            <th><?= number_format($rata_rata_stok) ?></th>
                                        </tr>
                                    </tbody>
                                </table>
                                <h3>Dari hasil perhitungan perkiraan penjualan, dapat diketahui bahwa ,<br>rata-rata stok minimal di tahun <?= $tahun ?> sebanyak <?= number_format($rata_rata_stok) ?> pcs untuk setiap bulannya</h3>
                            </div>

                        </div>

			        


                </div>


            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
</div>
<script type="text/javascript">


    
</script>
