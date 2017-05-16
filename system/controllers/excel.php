<?php


class excel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
        $this->load->library('PHPExcel');
    }

    public function penjualan($bulan, $tahun) {
        if (!isset($bulan)) {
            $bulan = date('m');
        }
        if (!isset($tahun)) {
            $tahun = date('Y');
        }
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['data'] = $this->model->get_data("v_fullpenjualan", array("MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun), array(
            "order_by" => array("tgl asc, nota", "asc"),
        ));
        $this->export("penjualan", $data);
    }

    public function pembelian($bulan, $tahun, $type) {
        if (!isset($bulan)) {
            $bulan = date('m');
        }
        if (!isset($tahun)) {
            $tahun = date('Y');
        }
        $kondisi = array("MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun);
        if ($type < 2) {
            $kondisi['type'] = $type;
        }
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['data'] = $this->model->get_data("v_fullpembelian", $kondisi, array(
            "order_by" => array("tgl asc, nota", "asc"),
        ));
        $this->export("pembelian", $data);
    }

    public function giling($bulan, $tahun) {
        if (!isset($bulan)) {
            $bulan = date('m');
        }
        if (!isset($tahun)) {
            $tahun = date('Y');
        }
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['data'] = $this->model->get_data("v_giling", array("MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun), array(
            "order_by" => array("tgl asc, id_giling", "asc"),
        ));
        $this->export("giling", $data);
    }

    public function saldo($status, $id) {
        if (isset($id) && isset($status) && ($status == "konsumen" || $status == "pemasok")) {
            $data = $this->model->get_detail("$status", array("id_$status" => $id));
            $data['data'] = $this->model->get_data("history_$status", array("id_$status" => $id), array(
                "order_by" => array("tgl desc,id_history_$status", "desc"),
            ));
            $data['title'] = "$data[id] $data[nama]";
            if ($status == "pemasok") {
                $status = "supplier";
            }
            $data['status'] = "$status";
            $data['tanggal'] = date("Y-m-d H:i:s");
            $this->export("saldo", $data);
        } else {
            show_404();
        }
    }

    public function stok($status, $id) {
        if (isset($id) && isset($status) && ($status == "produk" || $status == "kemasan")) {
            $data = $this->model->get_detail("$status", array("id_$status" => $id));
            $data['data'] = $this->model->get_data("history_$status", array("id_$status" => $id), array(
                "order_by" => array("tgl desc,id_history_$status", "desc"),
            ));
            $data['title'] = "$data[id] $data[nama]";
            $data['status'] = "$status";
            $data['tanggal'] = date("Y-m-d H:i:s");
            $this->export("stok", $data);
        } else {
            show_404();
        }
    }

    public function kas($bulan, $tahun) {
        $data['title'] = "Data Kas";
        $saldo = $this->model->get_detail_sum("kas", array("debit", "kredit"), array("tgl < " => "$tahun-$bulan-1"));
        $data['saldo'] = $saldo['debit'] - $saldo['kredit'];
        $data['data'] = $this->model->get_data("kas", array("MONTH(tgl)" => $bulan, "YEAR(tgl)" => $tahun), array(
            "order_by" => array("tgl asc, id_kas", "asc"),
        ));
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $this->export('kas', $data);
    }

    //data master
    public function kemasan() {
        $data['title'] = "Data Kemasan";
        $data['data'] = $this->model->get_data("kemasan", array(), array(
            "order_by" => array("nama", "asc")
        ));
        $this->export('kemasan', $data);
    }

    public function konsumen() {
        $data['title'] = "Data Konsumen";
        $data['data'] = $this->model->get_data("konsumen", array("status" => 1), array(
            "order_by" => array("nama", "asc")
        ));
        $this->export('konsumen', $data);
    }

    public function pemasok() {
        $data['title'] = "Data Supplier";
        $data['data'] = $this->model->get_data("pemasok", array("status" => 1), array(
            "order_by" => array("nama", "asc")
        ));
        $this->export('pemasok', $data);
    }
    
    public function produk() {
        $data['title'] = "Data Produk";
        $data['data'] = $this->model->get_data("produk", array("status" => 1), array(
            "order_by" => array("harga", "desc"),
        ));
        $this->export('produk', $data);
    }
    
    public function bahanbaku() {
        $data['title'] = "Data Bahan Baku";
        $data['data'] = $this->model->get_data("bahanbaku", array("status" => 1), array(
            "order_by" => array("type desc, harga", "desc"),
        ));
        $this->export('bahanbaku', $data);
    }

    private function export($file, $content) {
        if (!isset($content['bulan']) && !isset($content['tahun'])) {
            $content['bulan'] = date("Y/m/d");
            $content['tahun'] = date("H/i/s");
        }
        $data = $content;
        $data['objPHPExcel'] = new PHPExcel();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $file . ' (Periode ' . $content['bulan'] . '-' . $content['tahun'] . ') on ' . date('Y-m-d') . '.xls"');
        header('Cache-Control: max-age=0');
        $this->load->view('excel/' . $file, $data);
    }

}

?>
