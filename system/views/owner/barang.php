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
            <div class="panel-body">
                <div style="float: right">
                    <a href="<?= base_url() . $level ?>/addbarang" class="btn btn-primary"><i class='icon-plus'></i> Tambah Barang</a>
                </div>
                <div style="clear: both"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">ID Barang</th>
                                <th style="width: 15%">Nama</th>
                                <th style="width: 10%">Satuan</th>
                                <th style="width: 10%">Harga</th>
                                <th style="width: 10%">Stok</th>
                                <th style="width: 31%">Keterangan</th>
                                <th style="width: 9%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data->result_array() as $v) {
                                if ($v[status]) {
                                    $status = "Aktiv";
                                } else {
                                    $status = "Non-Aktiv";
                                }
                                $nama = explode("@", $v[nama]);
                                echo "<tr>
                                    <td>" . ( ++$i) . "</td>
                                    <td>$v[id]</td>
                                    <td>$v[nama]</td>
                                    <td>$v[satuan]</td>
                                    <td>$v[harga]</td>
                                    <td>$v[stok]</td>
                                    <td>$v[keterangan]</td>
                                    <td style='text-align:center'>
                                    <a href='" . base_url() . $level . "/addstokbarang/$v[id_barang]' class='btn btn-success btn-small'><i class='fa icon-plus'></i></a>
                                    <a href='" . base_url() . $level . "/addbarang/$v[id_barang]' class='btn btn-warning btn-small'><i class='icon-pencil'></i></a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12">
                    <?= $halaman ?>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>