<?php

class service extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('model');
    }
    public function index(){
        show_404();
    }
    public function nopol() {
        $this->load->view("text",array("text"=>$this->model->search_nopol($_REQUEST['term'])));
    }
    public function stok($status,$id) {
        $this->load->view("stok",array(
            "detail"=>$this->model->get_detail($status,array("id_$status"=>$id)),
            "status"=>$status,
            "data"=>$this->model->get_data("history_".$status,array("id_$status"=>$id), array(
                    "order_by" => array("tgl desc,id_history_$status", "desc"),
                    ))
                ));
    }
    public function sidebar() {
        if($this->session->userdata('sidebar')=="hide"){
            $this->session->set_userdata('sidebar',"show");
        }else{
            $this->session->set_userdata('sidebar',"hide");
        }
    }
}
?>
