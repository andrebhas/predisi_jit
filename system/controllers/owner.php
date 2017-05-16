<?php

class owner extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
        if (!$this->session->userdata('owner')) {
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
        $this->page("owner/home", $data, array("home"));
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
        $data['title'] = "Proses Retur";
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
            "order_by" => array("nama", "acs"),
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

        $data['customer'] = $this->model->get_data("customer", array("status" => 1), array(
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

      public function prediksi() {
        $data['title'] = "Prediksi";

        $data['barang'] = $this->model->get_data("barang", array("status" => 1), array(
            "order_by" => array("id", "asc"),
        ));

        $data['customer'] = $this->model->get_data("customer", array("status" => 1), array(
            "order_by" => array("nama", "asc"),
        ));

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
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        // $this->page('brg_keluar', $data, array("barang_keluar", "brg_keluar"));
          $this->page('prediksi', $data, array("prediksi"));
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
