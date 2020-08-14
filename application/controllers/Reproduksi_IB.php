<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reproduksi_IB extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_reproduksi']);
        $this->session->set_userdata('menu','ref_reproduksi');
        $this->session->set_userdata('submenu','reproduksi_ib');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "REPRODUKSI IB";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/reproduksi/v_reproduksi_ib',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/reproduksi/dta_reproduksi_ib');
    } 
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_reproduksi->get_json_ib();
    }
}