<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class simpan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('model');
        if (!$this->session->userdata('login')) {
            redirect(base_url());
        }
    }

    public function index() {
        redirect(base_url());
    }

//    public function keterangan($table, $tujuan) {
//        if (isset($table) && isset($tujuan)) {
//            $input = array("id_$table" => $this->input->post("id_$table"),
//                'keterangan' => $this->input->post('keterangan'));
//            $status = $this->model->update($table, $input);
//        }
//        redirect(base_url() . $this->session->userdata('user_level') . "/$tujuan?status=$status");
//    }

    public function bahanbaku() {
        if ($this->input->get_post('nama')) {
            $input = array('id_bahanbaku' => $this->input->post('id_bahanbaku'),
                'nama' => $this->input->post('nama'),
                'type' => $this->input->post('type'),
                'harga' => $this->input->post('harga'),
                'A' => $this->input->post('A'),
                'B' => $this->input->post('B'),
                'C' => $this->input->post('C'),
                'status' => $this->input->post('status'));
            $status = $this->model->update('bahanbaku', $input);
        }
        redirect(base_url() . $this->session->userdata('user_level') . "/bahanbaku?status=$status");
    }



    public function customer() {
        if ($this->input->get_post('nama')) {
            $input = array('id_customer' => $this->input->post('id_customer'),
                'id' => $this->input->post('id'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kontak' => $this->input->post('kontak'),
                'status' => $this->input->post('status'));
            $status = $this->model->update('customer', $input);
        }
        redirect(base_url() . $this->session->userdata('user_level') . "/customer?status=$status");
    }

    public function karyawan() {
        if ($this->input->get_post('nama')) {
            $input = array('id_karyawan' => $this->input->post('id_karyawan'),
                'id' => $this->input->post('id'),
                'nama' => $this->input->post('nama'),
                'alamat' => $this->input->post('alamat'),
                'kontak' => $this->input->post('kontak'),
                'tgl_gabung' => $this->input->post('tgl_gabung'),
                'status' => $this->input->post('status'));
            $status = $this->model->update('karyawan', $input);
        }
        redirect(base_url() . $this->session->userdata('user_level') . "/karyawan?status=$status");
    }

    public function barang() {
        if ($this->input->get_post('nama')) {
            $input = array('id_barang' => $this->input->post('id_barang'),
                'id' => $this->input->post('id'),
                'nama' => $this->input->post('nama'),
                'satuan' => $this->input->post('satuan'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'),
                'keterangan' => $this->input->post('keterangan'),
                'status' => $this->input->post('status'));
            $status = $this->model->update('barang', $input);
        }
        redirect(base_url() . $this->session->userdata('user_level') . "/barang?status=$status");
    }



    public function pembelian() {
        if ($this->input->get_post('id_barang')) {
            $input = array('nota' => $this->input->post('nota'),
                'tgl' => $this->input->post('tgl'),
                'id_karyawan'=>  $this->input->post('id_karyawan'),
                'ket' => $this->input->post('ket'),
                'harga' => $this->input->post('harga'),
                'qty' => $this->input->post('qty'),
                'id_barang' => $this->input->post('id_barang'));
            $status = $this->model->pembelian($input);
        }
        redirect(base_url() . $this->session->userdata('user_level') . "/rbrg_masuk?status=$status");
    }

    public function penjualan() {
        if ($this->input->get_post('id_barang')) {
            $input = array('nota' => $this->input->post('nota'),
                'tgl' => $this->input->post('tgl'),
                'id_customer' => $this->input->post('id_customer'),
                'ket' => $this->input->post('ket'),
                'harga' => $this->input->post('harga'),
                'qty' => $this->input->post('qty'),
                'id_barang' => $this->input->post('id_barang')
              );
            $status = $this->model->penjualan($input);
        }
        redirect(base_url() . $this->session->userdata('user_level') . "/rbrg_keluar?status=$status");
    }

    public function retur() {
        if ($this->input->get_post('id_barang')) {
            $input = array('nota' => $this->input->post('nota'),
                'tgl' => $this->input->post('tgl'),
                'id_customer' => $this->input->post('id_customer'),
                'ket' => $this->input->post('ket'),
                'harga' => $this->input->post('harga'),
                'qty' => $this->input->post('qty'),
                'id_barang' => $this->input->post('id_barang')
              );
            $status = $this->model->retur($input);
        }
        redirect(base_url() . $this->session->userdata('user_level') . "/list_brgretur?status=$status");
    }

}

?>
