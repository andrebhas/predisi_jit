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

                <form action="<?= base_url() ?>simpan/karyawan" role="form" method="post" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">ID Customer</label>
                        <div class="controls">
                            <input type="text" name="id" value="<?= $id ?>" class="form-control">
                            <input type="hidden" name="id_karyawan" value="<?= $id_karyawan ?>"required/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Nama</label>
                        <div class="controls">
                            <input type="text" name="nama" value="<?= $nama ?>" class="form-control span9"required/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Kontak</label>

                        <div class="controls"><input type="text" name="kontak" value="<?= $kontak ?>" class="form-control"required/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Alamat</label>
                        <div class="controls">
                            <textarea name="alamat" class="form-control" rows="3"required/><?= $alamat ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Tanggal Gabung</label>
                        <div class="controls">
                            <input type="text" name="tgl_gabung" value="<?= date("Y-m-d") ?>" class="form-control date-picker"required/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <select name="status" class="form-control span3">
                                <option value="1">Aktif</option>
                                <option value="0">Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <a href="javascript:window.history.back()" class="btn btn-default">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>