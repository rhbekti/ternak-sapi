<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Reproduksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_reproduksi']);
        $this->session->set_userdata('menu','ref_reproduksi');
        $this->session->set_userdata('submenu','tbhreproduksi');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Tambah Data Reproduksi";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/reproduksi/v_tambah_reproduksi',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/reproduksi/dta_reproduksi');
    }
    public function save()
    {
        
        $this->M_reproduksi->insert();
        redirect('/Reproduksi');
    }
}