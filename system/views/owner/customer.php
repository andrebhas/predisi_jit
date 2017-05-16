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
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div style="float: right">
                    <a href="<?=base_url().$level?>/addcustomer" class="btn btn-primary"><i class='fa icon-plus'></i> Tambah Customer</a>
<!--                    <a href='<?= base_url() . "excel/customer" ?>' class='btn btn-info'><i class='fa icon-print'></i> Export</a>-->
                </div>
                <div style="clear: both"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="table1">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 10%">ID</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 25%">Alamat</th>
                                <th style="width: 10%">Kontak</th>
                                <th style="width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data->result_array() as $v) {
                                echo "<tr>
                                    <td>".(++$i)."</td>
                                    <td>$v[id]</td>
                                    <td>$v[nama]</td>
                                    <td>$v[alamat]</td>
                                    <td>$v[kontak]</td>
                                    <td style='text-align:center'>
                                    <a href='".base_url().$level."/addcustomer/$v[id_customer]' class='btn btn-warning btn-small'><i class='fa icon-pencil'></i></a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!--div class="col-sm-12">
                    <?=$halaman?>
                </div-->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div>