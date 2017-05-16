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
                  <form id="f1" action="<?=base_url()?>bos/prediksi" method="post">
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
                              <label class="control-label">Bulan</label>
                              <div class="controls">
                                    <select name="bulan" style="width: 200px">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                            $nbulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                            $b=1;
                                            foreach ($nbulan as $v) {
                                                if ($b == $bln) {
                                        ?>
                                                <option value="<?php echo $b;?>" <?php echo (($b == $bln) ? "selected" : ""); ?>><?php echo $v; ?></option>
                                        <?php } else { ?>
                                                <option value="<?php echo $b;?>"><?php echo $v; ?></option>
                                        <?php
                                              }
                                            $b++;
                                          }
                                         ?>
                                    </select>
                                      <!-- <select name="tahun" style="width: 200px" onchange="this.form.submit();">
                                          <?php
                                          for ($t = date('Y'); $t > (date('Y') - 5); $t--) {
                                              if ($t == $tahun) {
                                                  echo "<option value='$t' selected=''>$t</option>";
                                              } else {
                                                  echo "<option value='$t'>$t</option>";
                                              }
                                          }
                                          ?>
                                      </select> -->
                              </div>
                          </div>
                    <div class="control-group">
                        <div class="controls">
                            <button form="f1" type="submit" class="btn btn-warning">Add</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- <form action="<?= base_url() ?>simpan/penjualan" role="form" method="post" onsubmit="return confirm('Pastikan data benar?')"> -->
                        <div class="box-title">
                            <h4><i class="icon-check"></i> Rincian Data</h4>
                        </div>
                        <div class="form-horizontal">
                          <!-- <form id="f2" action="<?=base_url()?>bos/prediksi" method="post"> -->
                              <div class="control-group">
                                  <label class="control-label">Jumlah Barang Masuk</label>
                                  <div class="controls">
                                        <input type="text" readonly="" name="jml_brgmsk" value="<?php echo  number_format($rincian['jml_brgmsk'], 0, ",", ".");?>" class="form-control">
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">Jumlah Barang Keluar</label>
                                  <div class="controls">
                                        <input type="text" readonly="" name="jml_brgklr" value="<?php echo  number_format($rincian['jml_brgklr'], 0, ",", ".");?>" class="form-control">
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">Jumlah Barang Retur</label>
                                  <div class="controls">
                                        <input type="text" readonly="" name="jml_brgretur" value="<?php echo  number_format($rincian['jml_brgretur'], 0, ",", ".");?>"  class="form-control">
                                  </div>
                              </div>
                      </form>
                              <div class="control-group">
                                  <div class="controls">
                                      <button form="f1" type="submit" class="btn btn-success">Start</button>
                                  </div>
                              </div>
                        </div>
                        <div class="box-title">
                            <h4><i class="icon-check"></i> Hasil Perhitungan</h4>
                        </div>
                        <div class="form-horizontal">
                              <div class="control-group">
                                  <label class="control-label">Konvensional</label>
                                  <div class="controls">
                                        <input type="text" readonly="" name="konvesional" value="<?php echo "Rp. ". number_format($calculate['biaya_konv'], 0, ",", ".");?>" class="form-control">
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">JIT</label>
                                  <div class="controls">
                                        <input type="text" readonly="" name="jit"  value="<?php echo "Rp. ". number_format($calculate['biaya_jit'], 0, ",", ".");?>" class="form-control">
                                  </div>
                              </div>
                        </div>
                        <div class="box-title">
                            <h4><i class="icon-check"></i> Penjelasan</h4>
                        </div>
                        <div class="form-horizontal">
                              <div class="control-group">
                                  <label>
                                    Laba yang diperoleh menggunakan metode JIT ternyata lebih besar dibandingkan dengan laba menggunkan metode perhitungan
                                    secara konvesional. Dari perhitungan diatas dapat diperoleh laba bersih sekitar
                                    <input style="width: 100px;" type="text" readonly="" name="jit" value="<?php echo "Rp. ". number_format($calculate['selisih'], 0, ",", ".");?>" class="form-control">
                                    Sehingga perusahaan dapat menggunakan laba tersebut untuk mengambil/membeli
                                     <?php echo $calculate['nmb']?> sejumlah
                                    <input style="width: 50px;" type="text" readonly="" name="" value="<?php echo $calculate['hb']?>" class="form-control"> pcs/dosen/karton.
                                  
                                  </label>
                              </div>
                        </div>
                        <!-- <div class="span12">
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
                        </div> -->
                        <!-- <h3>Total : <total>0</total></h3>
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
                        </div> -->

                    <!-- </form> -->
                </div>




            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
</div>
<script type="text/javascript">


// $(document).ready(function(){
//        loadData();
// });

// function loadData2(){
//     var nama_brg = $('[name=barang]').val().split(";");
//     var bulan    = $('[name=bulan]').val();
//     var id_brg   = nama_brg[0];
//     // alert($('[name=barang]').val() +" | "+  id_brg +" | "+  $('[name=bulan]').val());
// }

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
//             $.ajax({
//                  url      : "<?php echo site_url('bos/datarincian')?>",
//                  type     : "POST",
//                  data     : "",
// //                           contentType : false,
// //                           processData : false,
//                  dataType : "json",
//                  success  : function(data){
//                     //  $('#myModal').modal('hide');
//                     //  loadData();
//                     alert("cek : "+data);
//                  },
//                  error: function(jqXHR, textStatus, errorThrown){
// //                       alert('Error adding / update data');
//                       alert("error1 : "+jqXHR+" | error2 :"+errorThrown);
//                  }
//              });
}



    // total = 0;
    // id_data = 0;
    // potongan = <?= $this->session->userdata('potongan') ?>;
    // function add() {
    //     barang = $("#barang").val().split(";");
    //     nama_barang = $("#barang option:selected").text();
    //     volume = $("#volume").val();
    //     if (volume > 0) {
    //         nilai=volume*barang[1];
    //         total += nilai;
    //         id_data++;
    //         $("#listdata").append("<tr id='data_" + id_data + "'>" +
    //                 "<td>" + nama_barang + "</td>" +
    //                 "<td style='text-align:right'>" +
    //                 "<input type='hidden' name='id_barang[]' value='" + barang[0] + "'>" +
    //                 "<input type='hidden' name='harga[]' value='" + barang[1] + "'>" +
    //                 "<input type='hidden' name='qty[]' value='" + volume + "'>" +
    //                 volume + "</td>" +
    //                 "<td style='text-align:right'>" + uang(nilai) + "</td>" +
    //                 "<td style='text-align:center'><a href=\"javascript:hapus('" + id_data + ";" + nilai + "');\" class='btn btn-danger'><i class=\"fa icon-trash\"></a></td>" +
    //                 "</tr>");
    //         $("total").html(uang(total));
    //         $("#volume").val("");
    //     } else {
    //         alert("Volume tidak boleh kosong!");
    //     }
    // }
    // function hapus(input) {
    //     data = input.split(";");
    //     $("#data_" + data[0]).remove(0, function() {
    //     });
    //     total -= parseInt(data[1]);
    //     $("total").html(uang(total));
    // }
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
