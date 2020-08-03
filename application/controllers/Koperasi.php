<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Koperasi extends CI_Controller
{
    public function __construct()   
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['M_koperasi','M_wilayah']);
        $this->session->set_userdata('menu','peternakan');
        $this->session->set_userdata('submenu','koperasi');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data koperasi";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/koperasi/v_koperasi',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/koperasi/dta_koperasi');
    }
    public function get_data()
    {
        header('Content-Type:application/json');
        echo $this->M_koperasi->get_json();
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
        $data['judul'] = "Tambah Data koperasi";
        $data['id_user'] = $this->utilitas->user_login();
        $data['propinsi'] = $this->M_wilayah->get_propinsi()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/koperasi/v_tambah',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/koperasi/dta_koperasi');
    }
    public function save()
    {
        $this->form_validation->set_rules('nama','Nama','required|trim',[
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('alamat','Alamat','required|trim',[
            'required' => '%s tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('notelpkoperasi','Notelpkoperasi','required|trim',[
            'required' => '%s tidak boleh kosong'
        ]);

        if($this->form_validation->run() == false){
            $data['judul'] = "Tambah Data koperasi";
            $data['id_user'] = $this->utilitas->user_login();
            $data['propinsi'] = $this->M_wilayah->get_propinsi()->result();
            $this->load->view('template/header');
            $this->load->view('template/navbar',$data);
            $this->load->view('template/sidebar');
            $this->load->view('admin/koperasi/v_tambah',$data);
            $this->load->view('template/footer');
            $this->load->view('admin/koperasi/dta_koperasi');
        }else{
            $this->M_koperasi->insert();
            $this->session->set_flashdata('info','Ditambah');
            redirect('/koperasi');
        }
    }
    public function hapus()
    {
        $this->M_koperasi->delete();
        $this->session->set_flashdata('info','Dihapus');
        redirect('/koperasi');
    }
    public function edit()
    {
        $data['judul'] = "Edit Data koperasi";
        $pro = $this->input->post('propinsi');
        $kab = $this->input->post('kabupaten');
        $kec = $this->input->post('kecamatan');
        $data['id_user'] = $this->utilitas->user_login();
        $data['rs'] = $this->M_koperasi->datatunggal()->row();
        $data['kabupaten'] = $this->M_wilayah->get_kabupaten($pro);
        $data['kecamatan'] = $this->M_wilayah->get_kecubah($pro,$kab);
        $data['propinsi'] = $this->M_wilayah->get_propinsi()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/koperasi/v_edit',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/koperasi/dta_koperasi');
    }
    public function perbarui()
    {
        $this->M_koperasi->update();
        $this->session->set_flashdata('info','Di Perbarui');
        redirect('/koperasi');
    }
}