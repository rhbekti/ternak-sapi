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
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/sapi/v_ternak');
        $this->load->view('template/footer');
        $this->load->view('admin/sapi/dta_ternak');
    }
    public function hapus_data()
    {
        $id = $this->input->post('idsapi');
        $this->M_ternak->delete($id);
        redirect('/Sapi');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_ternak->get_json();
    }
    public function add()
    {
        $data['judul'] = "Tambah Data Ternak";
        $data['id_user'] = $this->utilitas->user_login();
        $data['bangsa'] = $this->M_ternak->get_bangsa()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/sapi/v_tambah_ternak');
        $this->load->view('template/footer');
        $this->load->view('admin/sapi/dta_ternak');
    }
    public function save()
    {
        $this->M_ternak->insert();
        redirect('/Sapi');
    }
    public function edit()
    {
        $id = $this->input->post('idsapi');
        $data['judul'] = "Edit Data Ternak Sapi";
        $data['id_user'] = $this->utilitas->user_login();
        $data['rs'] = $this->M_ternak->get($id)->row();
        $data['bangsa'] = $this->M_ternak->get_bangsa()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/sapi/v_edit_ternak',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/sapi/dta_ternak');
    }
    public function update()
    {
        $id = $this->input->post('idsapi');
        $this->M_ternak->update($id);
        redirect('/Sapi'); 
    }
    public function get_betina()
    {
        echo json_encode($this->M_ternak->get_sapi_betina());  
    }
    public function get_jantan()
    {
        echo json_encode($this->M_ternak->get_sapi_jantan());  
    }
    public function valid_tag()
    {
        $post = $this->input->post(null,true);
        echo json_encode($this->M_ternak->validasi_tag($post['tag'])->result());
    }
   
    
}