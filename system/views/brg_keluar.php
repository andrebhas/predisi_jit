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
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">Barang</label>
                        <div class="controls">
                            <select id="barang" class="form-control span5">
                                <?php
                                    foreach ($barang->result_array() as $b) {
                                    echo "<option value='$b[id_barang];$b[harga]'>$b[id] - $b[nama]</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Qty</label>
                        <div class="controls">
                            <input type="text" id="volume" class="form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button onclick="add()" class="btn btn-warning">Add</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <form action="<?= base_url() ?>simpan/penjualan" role="form" method="post" onsubmit="return confirm('Pastikan data benar?')">
                        <div class="box-title">
                            <h4><i class="icon-file-text"></i> Data Pembelian</h4>
                        </div>
                        <div class="span12">
                            <div class="span4">
                                <div class="control-group">
                                    <p class="">Customer</p>
                                    <div class="controls">
                                        <select name="id_customer" class="form-control span11">
                                            <?php
                                            foreach ($customer->result_array() as $v) {
                                              echo "<option value='$v[id_customer]'>$v[id] - $v[nama]</option>";
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="span4">
                                <div class="control-group">
                                    <p class="">Karyawan</p>
                                    <div class="controls">
                                        <select name="id_karyawan" class="form-control span11">
                                            <?php
                                            //foreach ($karyawan->result_array() as $v) {
                                            //    echo "<option value='$v[id_karyawan]'>$v[id] - $v[nama]</option>";
                                           //}

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>-->

                            <div class="span3">
                                <div class="control-group">
                                    <p class="">Tanggal</p>
                                    <div class="controls">
                                        <input type="text" readonly="" name="tgl" value="<?= date("Y-m-d") ?>" class="form-control date-picker">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="span12">
                            <div class="span12">
                                <div class="control-group">
                                    <p class="">Keterangan</p>
                                    <div class="controls">
                                        <textarea name="ket" required="" class="form-control span10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Total : <total>0</total></h3>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Barang</th>
                                    <th style="width: 10%">Qty</th>
                                    <th style="width: 10%">Harga</th>
                                    <th style="width: 9%"></th>
                                </tr>
                            </thead>
                            <tbody id="listdata">
                            </tbody>
                        </table>
                        <div class="" style="text-align: right">
                            <input type="submit" class="btn btn-info">
                        </div>

                    </form>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
</div>
<script>
    total = 0;
    id_data = 0;
    potongan = <?= $this->session->userdata('potongan') ?>;
    function add() {
        barang = $("#barang").val().split(";");
        nama_barang = $("#barang option:selected").text();
        volume = $("#volume").val();
        if (volume > 0) {
            nilai=volume*barang[1];
            total += nilai;
            id_data++;
            $("#listdata").append("<tr id='data_" + id_data + "'>" +
                    "<td>" + nama_barang + "</td>" +
                    "<td style='text-align:right'>" +
                    "<input type='hidden' name='id_barang[]' value='" + barang[0] + "'>" +
                    "<input type='hidden' name='harga[]' value='" + barang[1] + "'>" +
                    "<input type='hidden' name='qty[]' value='" + volume + "'>" +
                    volume + "</td>" +
                    "<td style='text-align:right'>" + uang(nilai) + "</td>" +
                    "<td style='text-align:center'><a href=\"javascript:hapus('" + id_data + ";" + nilai + "');\" class='btn btn-danger'><i class=\"fa icon-trash\"></a></td>" +
                    "</tr>");
            $("total").html(uang(total));
            $("#volume").val("");
        } else {
            alert("Volume tidak boleh kosong!");
        }
    }
    function hapus(input) {
        data = input.split(";");
        $("#data_" + data[0]).remove(0, function() {
        });
        total -= parseInt(data[1]);
        $("total").html(uang(total));
    }
    function uang(number) {
        var number = number.toString(),
                uang = number.split('.')[0],
                cents = (number.split('.')[1] || '') + '00';
        uang = uang.split('').reverse().join('')
                .replace(/(\d{3}(?!$))/g, '$1.')
                .split('').reverse().join('');
        return uang;
    }
    $(function() {
        $("#nopol").autocomplete({
            source: '<?= base_url() . "service/nopol" ?>'
        })
    });
</script>
