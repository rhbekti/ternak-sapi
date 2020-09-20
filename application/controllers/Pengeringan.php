<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengeringan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_pengeringan']);
        $this->session->set_userdata('menu', 'ref_reproduksi');
        $this->session->set_userdata('submenu', 'data_pengeringan');
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
        echo json_encode($this->M_pengeringan->get_all());
    }
}
