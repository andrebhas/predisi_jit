<div class="page-title">
    <div>
        <h1><i class="icon-file-alt"></i> <?= $title ?></h1>
    </div>
</div>
<div class="row-fluid">
    <!-- /.panel-heading -->
    <div class="box">
        <div class="box-content">
            <div style="float: right">
                <button onclick="window.history.back();" class="btn btn-default"><i class='fa icon-backward'></i> Back</button>
            </div>
            <div style="clear: both"></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 10%">ID Barang</th>
                            <th style="">Barang</th>
                            <th style="width: 13%">Harga</th>
                            <th style="width: 10%">Qty</th>
                            <th style="width: 15%">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data->result_array() as $v) {
                            $volume=$v[volume];
                            $nilai+=$v[nilai];
                            echo "<tr>
                                    <td>" . ( ++$i) . "</td>
                                    <td style='text-align:center'>$v[id]</td>
                                    <td>$v[nama]</td>
                                    <td style='text-align:right'>" . uang($v['harga']) . "</td>
                                    <td style='text-align:center'>$v[jml_kemasan]</td>
                                    <td style='text-align:right'>" . uang($v['nilai']) . "</td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4"></td>
                            <td style='text-align:center'><?= $volume ?></td>
                            <td style='text-align:right'><?= uang($nilai) ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
