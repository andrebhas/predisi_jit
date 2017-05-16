<?php

class admin  extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        if ($this->input->get_post('name') && $this->input->get_post('pass')) {
            $this->load->model('model');
            $data['status']=$this->model->cek_login($this->input->post('name'), $this->input->post('pass'));
        }
        if($this->session->userdata('bos')){
            redirect(base_url()."bos");
        }elseif($this->session->userdata('owner')){
            redirect(base_url()."owner");
        }elseif($this->session->userdata('gudang')){
            redirect(base_url()."gudang");
        }else{
            $this->load->view('login',$data);
        }
    }
    public function logout() {
                $this->session->sess_destroy();
        redirect(base_url());
    }
}
?>
