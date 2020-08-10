<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Kandang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_kandang']);
        $this->session->set_userdata('menu','peternakan');
        $this->session->set_userdata('submenu','kandang');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data Kandang";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kandang/v_kandang',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/kandang/dta_kandang');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_kandang->get_json();
    }
    public function update()
    {
        $this->M_kandang->update();
        redirect('/Kandang');
    }
    public function add()
    {
        $data['judul'] = "Tambah Data Kandang";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kandang/v_tambah_kandang',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/kandang/dta_kandang');

    }
    public function save()
    {
        $this->M_kandang->insert();
        redirect('/Kandang');
    }
    public function delete()
    {
        $this->M_kandang->delete();
        redirect('/Kandang');
    }
}