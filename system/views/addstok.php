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
                <?php
                $this->load->view('alert');
                ?>
                <form action="" role="form" method="post" class="form-horizontal" onsubmit="return confirm('Pastikan data benar?')">
                    <div class="control-group">
                        <label class="control-label">Produk</label>
                        <div class="controls">
                            <select name="id" class="form-control span3" id="id" onchange="update()">
                                <?php
                                foreach ($produk->result_array() as $v) {
                                    if (isset($id) && $id == $v[id_produk]) {
                                        echo "<option value='$v[id_produk]' selected=''>$v[nama]</option>";
                                    } else {
                                        echo "<option value='$v[id_produk]'>$v[nama]</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Stok Gudang</label>
                        <div class="controls"><label class="form-control"><?= $stok['value'] ?></label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Stok</label>
                        <div class="controls"><input type="text" name="stok" value="" min="1" max="<?= $stok['value'] ?>" class="form-control span4">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Keterangan</label>
                        <div class="controls">
                            <textarea name="ket" class="form-control span7">Tambah Stok</textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="<?= base_url() . "$level/" ?>produk" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </form>
                <div id="datastok">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        update();
    });
    function update() {
        id = $("#id").val();
        $.get('<?= base_url() . "service/stok/produk/" ?>' + id, function(data, status) {
            $("#datastok").html(data);
            $("#table1").dataTable();
        });
    }
</script>