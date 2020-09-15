<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeringan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_pengeringan']);
        $this->session->set_userdata('menu','reproduksi');
        $this->session->set_userdata('submenu','pengeringan');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data pengeringan";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/pengeringan/v_pengeringan', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/pengeringan/dta_pengeringan');
    }
    public function get_data()
    {
        header('Content-Type:application/json');
        echo $this->M_pengeringan->get_json();
    }
    public function tes()
    {
        $tgl = strtotime(date('Y-m-d'));
        $hasil = strtotime('+2 day',$tgl);
        echo date('Y-m-d',$hasil);
    }
}