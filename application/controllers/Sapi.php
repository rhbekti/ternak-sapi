<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sapi extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_ternak']);
        $this->session->set_userdata('menu','data_ternak');
        $this->session->set_userdata('submenu','sapi');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data Ternak Sapi";
        // $data['rs'] = $this->M_ternak->get()->result();
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/sapi/v_ternak');
        $this->load->view('template/footer');
        $this->load->view('admin/sapi/dta_ternak');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_ternak->get_json();
    }
    
}