<div class="page-title">
    <div>
        <h1><i class="icon-file-alt"></i> <?= $title ?></h1>
    </div>
</div>
<div class="row-fluid">
    <!-- /.panel-heading -->
    <div class="box">
        <div class="box-content">
            <?php
            include 'alert.php';
            ?>
            <div class="toolbar pull-left">
            </div>
            <div class="toolbar pull-right clearfix">
                <form method="post">
                    <select name="bulan" style="width: 200px" onchange="this.form.submit();">
                        <?php
                        $nbulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                        foreach ($nbulan as $v) {
                            if (( ++$b) == $bulan) {
                                echo "<option value='$b' selected=''>$v</option>";
                            } else {
                                echo "<option value='$b'>$v</option>";
                            }
                        }
                        ?>
                    </select>
                    <select name="tahun" style="width: 200px" onchange="this.form.submit();">
                        <?php
                        for ($t = date('Y'); $t > (date('Y') - 5); $t--) {
                            if ($t == $tahun) {
                                echo "<option value='$t' selected=''>$t</option>";
                            } else {
                                echo "<option value='$t'>$t</option>";
                            }
                        }
                        ?>
                    </select>
                </form>
            </div>
            <div class="clearfix"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="table1">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 15%">Nota</th>
                            <th style="width: 10%">Tanggal</th>
                            <th style="width: 15%">Karyawan</th>
                            <th style="width: 25%">Keterangan</th>
                            <th style="width: 10%">Total</th>
                            <th style="width: 3%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data->result_array() as $v) {
                            $nota = $v['id_pembelian'];
                            $pre = "PB";
                            for ($x = strlen($nota); $x < 9; $x++) {
                                $pre.="0";
                            }
                            $nota = $pre . $nota;
                            $nilai+=$v['total'];
                            $action = "<a href='" . base_url() . $level . "/dbrg_masuk/$v[nota]' class='btn btn-warning btn-small'><i class='fa icon-search'></i></a>";
                            echo "<tr>
                                    <td>" . ( ++$i) . "</td>
                                    <td>$v[nota]</td>
                                    <td>$v[tgl]</td>
                                    <td>$v[nama]</td>
                                    <td>$v[ket]</td>
                                    <td style='text-align:right'>" . uang($v['total']) . "</td>
                                    <td style='text-align:center'>" . $action . "</td>
                                </tr>";
                        }
                        // print_r(eek);
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td style='text-align:right'><?= uang($nilai) ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- /.panel-body -->
</div>
