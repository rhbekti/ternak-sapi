<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Susu extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_susu']);
        $this->session->set_userdata('menu','ref_produksi');
        $this->session->set_userdata('submenu','susu');
        belum_login();
    }
    public function index()
    {
        
        $data['judul'] = "Data Produksi Susu";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/susu/v_susu',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/susu/dta_susu');
    }
    public function tambah()
    {
        
        $data['judul'] = "Tambah Data Produksi Susu";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/susu/v_tambah',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/susu/dta_susu');
    }
    public function edit()
    {
        $id = $this->input->post('idpengukuran');
        $data['judul'] = "Edit Data Produksi Susu";
        $data['id_user'] = $this->utilitas->user_login();
        $data['rs'] = $this->M_susu->get($id)->row();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/susu/v_edit',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/susu/dta_susu');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_susu->get_json();
    }
    public function save()
    {
        $this->M_susu->insert();
        redirect('/Susu');
    }
    public function hapus()
    {
        $post = $this->input->post('idpengukuran');
        $this->M_susu->delete($post);
        redirect('/Susu');
    }
    public function update()
    {
        $id = $this->input->post('idpengukuran');
        $this->M_susu->update($id);
        redirect('/Susu');
    }
}