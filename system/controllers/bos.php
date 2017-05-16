<?php

class bos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
        if (!$this->session->userdata('bos')) {
            //redirect(base_url());
        }
    }

    public function index() {
        if ($this->input->get_post("tahun")) {
            $data['tahun'] = $this->input->post("tahun");
        } else {
            $data['tahun'] = date("Y");
        }
        $data['debit'] = $this->model->get_data_sum(array("sum" => array("debit"), "select" => array("MONTH(tgl) as bulan")), "kas", array("YEAR(tgl)" => $data['tahun']), array(
            "order_by" => array("MONTH(tgl)"),
            "group_by" => array("MONTH(tgl)")
        ));
        $data['kredit'] = $this->model->get_data_sum(array("sum" => array("kredit"), "select" => array("MONTH(tgl) as bulan")), "kas", array("YEAR(tgl)" => $data['tahun']), array(
            "order_by" => array("MONTH(tgl)"),
            "group_by" => array("MONTH(tgl)")
        ));
        $this->page("home", $data, array("home"));
    }

    public function karyawan($id) {
        if (!isset($id)) {
            $id = 0;
        }
        $total = $this->model->get_total("karyawan", array("status" => 1));

        $data['no'] = $id;
        $data['title'] = "Data karyawan";
        $data['halaman'] = $this->paging("bos/karyawan");
        $data['data'] = $this->model->get_data("karyawan", array("status" => 1), array(
            "order_by" => array("nama", "asc")
        ));
        $this->page('karyawan', $data, array("master", "kry"));
    }

    public function addkaryawan($id) {
        if (isset($id)) {
            $data = $this->model->get_detail("karyawan", array("id_karyawan" => $id));
        }
        $data['title'] = "Update karyawan";
        $this->page("addkaryawan", $data, array("master", "kry"));
    }

    public function customer($id) {
        if (!isset($id)) {
            $id = 0;
        }
        $total = $this->model->get_total("customer", array("status" => 1));

        $data['no'] = $id;
        $data['title'] = "Data Customer";
        $data['halaman'] = $this->paging("bos/customer");
        $data['data'] = $this->model->get_data("customer", array("status" => 1), array(
            "order_by" => array("nama", "asc")
        ));
        $this->page('customer', $data, array("master", "csr"));
    }

    public function addcustomer($id) {
        if (isset($id)) {
            $data = $this->model->get_detail("customer", array("id_customer" => $id));
        }
        $data['title'] = "Update Customer";
        $this->page("addcustomer", $data, array("master", "csr"));
    }

//    public function brg_retur() {
//        $data['title'] = "Transaksi Barang Retur";
//
//        $data['barang'] = $this->model->get_data("barang", array("status" => 1), array(
//            "order_by" => array("id", "asc"),
//        ));
//
//        $data['customer'] = $this->model->get_data("customer", array("status" => 1), array(
//            "order_by" => array("nama", "asc"),
//        ));
//        $this->page('brg_retur', $data, array("barang_retur", "brg_retur"));
//    }
//
//    public function rbrg_retur() {
//        $data['title'] = "Data Barang Retur ";
//        if ($this->input->get_post('bulan')) {
//            $bulan = $this->input->post('bulan');
//        } else {
//            $bulan = date('m');
//        }
//        if ($this->input->get_post('tahun')) {
//            $tahun = $this->input->post('tahun');
//        } else {
//            $tahun = date('Y');
//        }
//        $data['data'] = $this->model->get_data("retur", array("MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun), array(
//            "order_by" => array("tgl desc, nota", "desc"),
//        ));
//        $data['bulan'] = $bulan;
//        $data['tahun'] = $tahun;
//        $this->page('rbrg_retur', $data, array("barang_retur", "rbrg_retur"));
//    }
//
//        public function dbrg_retur($nota) {
//        if (isset($nota)) {
//            $data['data'] = $this->model->get_data("detail_retur", array("nota" => $nota), array(
//                "order_by" => array("harga", "desc"),
//            ));
//            $v = $this->model->get_detail("detail_retur", array("nota" => $nota));
//            $nota = $v['id_retur'];
//            $pre = "PB";
//            for ($i = strlen($nota); $i < 9; $i++) {
//                $pre.="0";
//            }
//            $nota = $pre . $nota;
//            $data['title'] = "Nota : $nota";
//            $this->page('dbrg_retur', $data, array("barang_retur", "dbrg_retur"));
//        } else {
//            redirect(base_url());
//        }
//    }
//
    public function barang() {
        $data['title'] = "Data Barang";
        $data['data'] = $this->model->get_data("barang", array("status" => 1), array(
            "order_by" => array("id", "acs"),
        ));
        $this->page('barang', $data, array("barang", "data_barang"));
    }

    public function addbarang($id) {
        $this->admin();
        if (isset($id)) {
            $data = $this->model->get_detail("barang", array("id_barang" => $id));
        }
        $data['title'] = "Update barang";
        $this->page("addbarang", $data, array("barang", "data_barang"));
    }

    public function brg_masuk() {
        $data['title'] = "Transaksi Pembelian Untuk Barang Masuk";

        $data['barang'] = $this->model->get_data("barang", array("status" => 1), array(
            "order_by" => array("id", "asc"),
        ));

        $data['karyawan'] = $this->model->get_data("karyawan", array("status" => 1), array(
            "order_by" => array("nama", "asc"),
        ));
        $this->page('brg_masuk', $data, array("barang_masuk", "brg_masuk"));
    }

    public function rbrg_masuk() {
        $data['title'] = "Data Pembelian Untuk Barang Masuk ";
        if ($this->input->get_post('bulan')) {
            $bulan = $this->input->post('bulan');
        } else {
            $bulan = date('m');
        }
        if ($this->input->get_post('tahun')) {
            $tahun = $this->input->post('tahun');
        } else {
            $tahun = date('Y');
        }
        // $data['data'] = $this->model->get_data("pembelian", array("MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun), array(
        //     "order_by" => array("tgl desc, nota", "desc"),
        // ));
        $data['data']  = $this->model->get_datapembelian($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $this->page('rbrg_masuk', $data, array("barang_masuk", "rbrg_masuk"));
    }

    public function dbrg_masuk($nota) {
        if (isset($nota)) {
            // $data['data']  = $this->model->get_dataPBnota($nota);
            // $data['data'] = $this->model->get_data("detail_pembelian", array("nota" => $nota), array(
            //     "order_by" => array("harga", "desc"),
            // ));
            // $v = $this->model->get_detail("detail_pembelian", array("nota" => $nota));
            $data['data'] = $this->model->get_detailpembelian($nota);
            foreach ($data['data']->result_array() as $n) {
                   $a = $n['nota'];
            }
            $nota = $a;
            $pre = "PB";
            for ($i = strlen($nota); $i < 9; $i++) {
                $pre.="0";
            }
            $nota = $pre . $nota;
            $data['title'] = "Nota : $nota";
            $this->page('dbrg_masuk', $data, array("barang_masuk", "dbrg_masuk"));
        } else {
            redirect(base_url());
        }
    }


   public function brg_keluar() {
        $data['title'] = "Transaksi Pembelian Untuk Barang Keluar";

        $data['barang'] = $this->model->get_data("barang", array("status" => 1), array(
            "order_by" => array("id", "asc"),
        ));

        $data['customer'] = $this->model->get_data("customer", array("status" => 1), array(
            "order_by" => array("nama", "asc"),
        ));
        $this->page('brg_keluar', $data, array("barang_keluar", "brg_keluar"));
    }

    public function rbrg_keluar() {
        $data['title'] = "Data Pembelian Untuk Barang Keluar ";
        if ($this->input->get_post('bulan')) {
            $bulan = $this->input->post('bulan');
        } else {
            $bulan = date('m');
        }
        if ($this->input->get_post('tahun')) {
            $tahun = $this->input->post('tahun');
        } else {
            $tahun = date('Y');
        }
        // $data['data'] = $this->model->get_data("penjualan", array("MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun), array(
        //     "order_by" => array("tgl desc, nota", "desc"),
        // ));
        $data['data']  = $this->model->get_datapenjualan($bulan, $tahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $this->page('rbrg_keluar', $data, array("barang_keluar", "rbrg_keluar"));
    }

    public function dbrg_keluar($nota) {
        if (isset($nota)) {
            // $data['data'] = $this->model->get_data("detail_penjualan", array("nota" => $nota), array(
            //     "order_by" => array("harga", "desc"),
            // ));
            // $v = $this->model->get_detail("detail_penjualan", array("nota" => $nota));
            // $nota = $v['id_penjualan'];
            $data['data'] = $this->model->get_detailpenjualan($nota);
            foreach ($data['data']->result_array() as $n) {
                   $a = $n['nota'];
            }
            $nota = $a;
            $pre = "PB";
            for ($i = strlen($nota); $i < 9; $i++) {
                $pre.="0";
            }
            $nota = $pre . $nota;
            $data['title'] = "Nota : $nota";
            $this->page('dbrg_keluar', $data, array("barang_keluar", "dbrg_keluar"));
        } else {
            redirect(base_url());
        }
    }


     public function list_brgretur() {
         $data['title'] = "Data Retur Barang ";
         if ($this->input->get_post('bulan')) {
             $bulan = $this->input->post('bulan');
         } else {
             $bulan = date('m');
         }
         if ($this->input->get_post('tahun')) {
             $tahun = $this->input->post('tahun');
         } else {
             $tahun = date('Y');
         }
         $data['data']  = $this->model->get_dataretur($bulan, $tahun);
         $data['bulan'] = $bulan;
         $data['tahun'] = $tahun;
         $this->page('rbrg_retur', $data, array("retur", "rbrg_retur"));
     }


     public function trans_brgretur() {
          $data['title'] = "Transaksi Barang Retur";
          $data['barang'] = $this->model->get_data("barang", array("status" => 1), array(
              "order_by" => array("id", "asc"),
          ));

          $data['customer'] = $this->model->get_data("customer", array("status" => 1), array(
              "order_by" => array("nama", "asc"),
          ));
          $this->page('brg_retur', $data, array("retur", "add_retur"));
      }

      public function dbrg_retur($nota) {
          if (isset($nota)) {
              $data['data'] = $this->model->get_detailretur($nota);
              foreach ($data['data']->result_array() as $n) {
                     $a = $n['nota'];
              }
              $nota = $a;
              $pre = "PB";
              for ($i = strlen($nota); $i < 9; $i++) {
                  $pre.="0";
              }
              $nota = $pre . $nota;
              $data['title'] = "Nota : $nota";
              $this->page('dbrg_retur', $data, array("retur", "rbrg_retur"));
          } else {
              redirect(base_url());
          }
      }

      public function kondisi_stokbrg() {
          $data['title'] = "Data Kondisi Stok Barang ";
          if ($this->input->get_post('bulan')) {
              $bulan = $this->input->post('bulan');
          } else {
              $bulan = date('m');
          }
          if ($this->input->get_post('tahun')) {
              $tahun = $this->input->post('tahun');
          } else {
              $tahun = date('Y');
          }
          // $data1['data1']  = $this->model->get_datakonstokbrg($bulan, $tahun);
          $goodstok  = $this->model->get_goodstok();
          foreach ($goodstok as $gs) {
                $badstok1  = $this->model->get_badstok("Rusak/Cacat", $gs['id_barang']);
                $badstok2  = $this->model->get_badstok("Kadaluarsa", $gs['id_barang']);

                if(!empty($badstok1)){
                    foreach ($badstok1 as $bs1) {
                          $rbs1 = $bs1['jml_retur'];
                    }
                }else{
                          $rbs1 = 0;
                }

                if(!empty($badstok2)){
                    foreach ($badstok2 as $bs2) {
                          $rbs2 = $bs2['jml_retur'];
                    }
                }else{
                          $rbs2 = 0;
                }

                $datax[] = array(
                  'id_barang'   => $gs['id'],
                  'nama_barang' => $gs['nama_barang'],
                  'stok'        => ($gs['stok'] - $rbs1) - $rbs2,
                  'stokcacat'   => $rbs1,
                  'stokexpired' => $rbs2
                );
          }

          $data['data']  = $datax;
          $data['bulan'] = $bulan;
          $data['tahun'] = $tahun;
          $this->page('kondisi_stokbrg', $data, array("retur", "kondisi_stokbrg"));
      }

      function datarincian(){
        // $datax = array (
        //                 'id_brg' => $this->input->post('id_brg'),
        //                 'bulan'  => $this->input->post('bulan')
        //         );
          // $data = $this->model->get_dataRincian($datax['id_brg'], $datax['bulan']);
          // $datax = $this->model->get_dataRincian();
          // foreach ($datax as $k) {
          //    $s[] = $k['id_retur'];
          // }
          // $data = $s;
          // foreach ($datax as $a) {
          //    $d[] = $a['jml_brgmsk'];
          // }
          // $data['data'] = $d;
          // $data = $this->model->get_goodstok();
          // echo json_encode($datax);
          // $a = {"currency" : [
          //                       {
          //                         "name" : "South Africa",
          //                         "code" : "ZAR",
          //                         "amount" : 0.14
          //                       },
          //                       {
          //                         "name" : "America",
          //                         "code" : "USD",
          //                         "amount" : 0.64
          //                       },
          //                       {
          //                         "name" : "Europe",
          //                         "code" : "GBP",
          //                         "amount" : 1.29
          //                       }
          //       ]};
          $a = array('tahu' => brontak , 'pisang' => goreng );
          echo json_encode($a);
      }

      public function prediksi() {
        $data['title'] = "Prediksi";

        // if ($this->input->get_post('bulan')) {
        //     $bulan = $this->input->post('bulan');
        // } else {
        //     $bulan = date('m');
        // }
        if ($this->input->get_post('tahun')) {
            $tahun = $this->input->post('tahun');
        } else {
            $tahun = date('Y');
        }

        // $str = "".$this->input->post('barang')."";
        // $data['bulan']  = $bulan;
        $bulan  = $this->input->post('bulan');
        $idbrg  = explode(";",$this->input->post('barang'));
        $data['bln']       = $bulan;
        $data['tahun']     = $tahun;
        $data['idbrg']     = $idbrg[0];
        $data['rincian']   = $this->model->get_dataRincian($idbrg[0],$bulan);
        $bm = str_replace(str_split('\\/:*.?"<>|Rp'), '', $this->input->post('jml_brgmsk'));
        $bk = str_replace(str_split('\\/:*.?"<>|Rp'), '', $this->input->post('jml_brgklr'));
        $br = str_replace(str_split('\\/:*.?"<>|Rp'), '', $this->input->post('jml_brgretur'));
        $data['calculate'] = $this->jitkonv($bm,$bk,$br,$idbrg[2],$idbrg[1]);
        $data['barang'] = $this->model->get_data("barang", array("status" => 1), array(
          "order_by" => array("id", "asc"),
        ));
        // $this->page('brg_keluar', $data, array("barang_keluar", "brg_keluar"));
          $this->page('prediksi', $data, array("prediksi"));
      }










      //codingan andre bhaskoro  ==============================================================
      public function prediksi_jit() {
        $data['title'] = "Prediksi";
        
        $get_tahun = $this->db->query("SELECT MAX( DISTINCT YEAR(`tgl`) ) as tahun FROM `penjualan`");
        $tahun = $get_tahun->row()->tahun + 1;

        $data['tahun']     = $tahun;
        $data['idbrg']     = $idbrg[0];
        $data['barang'] = $this->model->get_data("barang", array("status" => 1), array(
          "order_by" => array("id", "asc"),
        ));
           $this->page('v_prediksi_jit', $data, array("prediksi_jit"));
      }

      public function proses_prediksi_jit() {
        $tahun_prediksi = $this->input->post('tahun');
        $idbrg  = explode(";",$this->input->post('barang'));
        $id_barang = $idbrg[0];
        $nama_barang = $this->model->get_barang_by_id($id_barang)->nama; 
        $harga_barang =  $this->model->get_barang_by_id($id_barang)->harga;    
        $data['idbrg']     = $id_barang;

        $total_penjualan = $this->model->get_total_penjualan()->total;
        for ($i=1; $i < 13 ; $i++) { 
            $bulan = "0".$i;
            $total_penjualan_bulan[] = $this->model->get_total_penjualan_bulan($bulan)->total;
        }

        $bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
        $tahun_penjualan = $this->model->get_tahun_penjualan();

        foreach ($tahun_penjualan as $key => $value) {
           $total_penjualan_tahun[$value['tahun']] = $this->model->get_total_penjualan_tahun($value['tahun'])->total;
        }
        $count_tahun = count($tahun_penjualan);
        for ($i=0; $i < $count_tahun; $i++) { 
            for ($j=0; $j < $count_tahun; $j++) { 
                if($i==$j){
                    $nilaix[$i][$j] = 0;
                } else {
                    $nilaix[$i][$j] = $i-$j;
                }
            }
        }

        $data = array(
            'tahun' => $tahun_prediksi ,
            'nilaix' => $nilaix ,
            'bulan' => $bulan,
            'total_penjualan_bulan' => $total_penjualan_bulan,
            'total_penjualan_tahun' => $total_penjualan_tahun,
            'total_penjualan' => $total_penjualan ,
            'tahun_penjualan' => $tahun_penjualan ,
            'harga_barang' => $harga_barang,
        );

        $data['title'] = "Detail Prediksi <br>".$nama_barang." Tahun ".$tahun_prediksi;
        $this->page('v_detail_prediksi_jit', $data, array("detail_prediksi_jit"));
      }



      //tutup codingan andre bhaskoro 082333817317  ==============================================================

    function jitkonv($bm, $bk, $br,$nmb,$hb){
          $total_jual   = abs(($bm - $bk + $br) * $hb);
          $jit_bpounit    = abs(($bm - $bk + $br) * 30);
          $jit_variabel   = abs(($bm - $bk + $br)* 1020);
          $jit_bpotetap   = abs(($bm - $bk + $br) * 130);
          $jit_biaya      = abs($total_jual - $jit_bpounit - $jit_variabel - $jit_bpotetap);
          $konv_variabel    = abs(($bm - $bk + $br) * 1160);
          $konv_bpotetap   = abs(($bm - $bk + $br) * 30);
          $konv_biaya      = abs($total_jual - $konv_bpotetap - $konv_variabel);
          $selisih = $jit_biaya - $konv_biaya;
          $jmlbelibrg = $selisih/$hb;
          $result = array('biaya_jit' => $jit_biaya, 'biaya_konv' => $konv_biaya, 'selisih' => $selisih, 'nmb' => $nmb, 'hb' => $jmlbelibrg);
          return $result;
    }


    public function cetak() {
        define('FPDF_FONTPATH', 'codemiring/fonts/');
    }

    private function page($content, $input, $menu) {
        $data['level'] = 'bos';
        $data['content_name'] = $content;
        $data['content_data'] = $input;
        $data['content_data']['level'] = $data['level'];
        $data['title'] = $input['title'];
        foreach ($menu as $m) {
            $data['menu'][$m] = "active";
        }
        $this->load->view('template', $data);
    }

    private function paging($baseurl, $total, $perpage) {
        $this->load->library('pagination');
        $config['base_url'] = base_url() . $baseurl;
        $config['total_rows'] = $total;
        $config['per_page'] = $perpage;
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        return '<div class="pagination pagination-right"><ul>' . $this->pagination->create_links() . '</ul></div>';
    }

    private function admin() {
        if ($this->session->userdata('operator')) {
            $data['text'] = "<script>alert('Forbidden Access!');window.history.back();</script>";
            $this->load->view('text', $data);
        }
    }

}

?>
