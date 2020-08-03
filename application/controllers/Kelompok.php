<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kelompok extends CI_Controller
{
    public function __construct()   
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['M_kelompok','M_wilayah']);
        $this->session->set_userdata('menu','peternakan');
        $this->session->set_userdata('submenu','kelompok');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data Kelompok";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kelompok/v_kelompok',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/kelompok/dta_kelompok');
    }
    public function get_data()
    {
        header('Content-Type:application/json');
        echo $this->M_kelompok->get_json();
    }
    public function get_kab()
    {
        $id = $this->input->post('id');
        $data = $this->M_wilayah->get_kabupaten($id);
        echo json_encode($data);
    }
    public function get_kec()
    {
        $id = $this->input->post('pro');
        $data = $this->M_wilayah->get_kecamatan($id);
        echo json_encode($data);
    }
    public function get_kechange()
    {
        $id = $this->input->post('pro');
        $rh = $this->input->post('kab');
        $data = $this->M_wilayah->get_kecubah($id,$rh);
        echo json_encode($data);
    }
    public function add()
    {
        $data['judul'] = "Tambah Data Kelompok";
        $data['id_user'] = $this->utilitas->user_login();
        $data['propinsi'] = $this->M_wilayah->get_propinsi()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kelompok/v_tambah',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/kelompok/dta_kelompok');
    }
    public function save()
    {
        $this->form_validation->set_rules('nama','Nama','required|trim',[
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat','Alamat','required|trim',[
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('notelp','Notelp','required|trim',[
            'required' => '%s tidak boleh kosong'
        ]);

        if($this->form_validation->run() == false){
            $data['judul'] = "Tambah Data Kelompok";
            $data['id_user'] = $this->utilitas->user_login();
            $data['propinsi'] = $this->M_wilayah->get_propinsi()->result();
            $this->load->view('template/header');
            $this->load->view('template/navbar',$data);
            $this->load->view('template/sidebar');
            $this->load->view('admin/kelompok/v_tambah',$data);
            $this->load->view('template/footer');
            $this->load->view('admin/kelompok/dta_kelompok');
        }else{
            $this->M_kelompok->insert();
            redirect('/Kelompok');
        }
    }
    public function hapus()
    {
        $this->M_kelompok->delete();
        redirect('/Kelompok');
    }
    public function edit()
    {
        $data['judul'] = "Edit Data Kelompok";
        $pro = $this->input->post('propinsi');
        $kab = $this->input->post('kabupaten');
        $kec = $this->input->post('kecamatan');
        $data['id_user'] = $this->utilitas->user_login();
        $data['rs'] = $this->M_kelompok->datatunggal()->row();
        $data['kabupaten'] = $this->M_wilayah->get_kabupaten($pro);
        $data['kecamatan'] = $this->M_wilayah->get_kecubah($pro,$kab);
        $data['propinsi'] = $this->M_wilayah->get_propinsi()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kelompok/v_edit',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/kelompok/dta_kelompok');
    }
    public function perbarui()
    {
        $this->M_kelompok->update();
        redirect('/Kelompok');
    }
}