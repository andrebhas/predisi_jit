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
                  <form id="f1" action="<?=base_url()?>bos/proses_prediksi_jit" method="post">
                          <div class="control-group">
                              <label class="control-label">Nama Barang</label>
                              <div class="controls">
                                  <select id="barang" name="barang" class="form-control span5">
                                    <option value="">-- Pilih --</option>
                                    <?php foreach ($barang->result_array() as $b) {
                                        // $v =  ;
                                    ?>
                                        <option value="<?php echo $b[id_barang].";".$b[harga].";".$b[nama]?>" <?php echo (($b['id_barang'] == $idbrg) ? "selected" : ""); ?>><?php echo $b[id]." - ".$b[nama]; ?></option>
                                    <?php } ?>
                                  </select>
                              </div>
                          </div>
                          <div class="control-group">
                              <label class="control-label">Prediksi di Tahun</label>
                              <div class="controls">
                                   <input type="text" readonly name="tahun" value="<?= $tahun ?>">
                              </div>
                          </div>
                    <div class="control-group">
                        <div class="controls">
                            <button form="f1" type="submit" class="btn btn-warning">Prediksi !</button>
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

function loadData(){
  var nama_brg = $('[name=barang]').val().split(";");
  var bulan    = $('[name=bulan]').val();
  var id_brg   = nama_brg[0];
              $.ajax({
                   url      : "<?=base_url()?>bos/datarincian",
                   type     : "POST",
                   data     : {'d1': id_brg, 'd2':bulan},
                   dataType : "JSON",
                   success  : function(data){
                     alert("sukses gan : "+data);
                      //  $('[name="id"]').val(data.id);
                      //  $('[name="nama"]').val(data.nama);
                      //  $('[name="ttl"]').val(data.ttl);
                      //  $('[name="pekerjaan"]').val(data.pekerjaan);
                      //  $('[name="rt_rw"]').val(data.rt_rw);
                      //  $('[name="no_rumah"]').val(data.no_rumah);
                      //  $('[name="email"]').val(data.email);
                      //  $('#myModal').modal('show'); // show bootstrap modal when complete loaded
                      //  $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

                   },
                   error: function (jqXHR, textStatus, errorThrown)
                   {
                       alert('Error get data from ajax : '+jqXHR+textStatus+errorThrown);
                   }
               });
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
    
</script>
