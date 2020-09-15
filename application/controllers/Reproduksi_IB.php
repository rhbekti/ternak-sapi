<?php defined('BASEPATH') or exit('No direct script access allowed');

class Reproduksi_IB extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_reproduksi','M_ternak']);
        $this->session->set_userdata('menu', 'ref_reproduksi');
        $this->session->set_userdata('submenu', 'reproduksi_ib');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "REPRODUKSI IB";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/reproduksi/v_reproduksi_ib', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/reproduksi/dta_reproduksi_ib');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_reproduksi->get_json_ib();
    }
    public function tambah()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required', ['required' => 'Field tidak boleh kosong']);
        $this->form_validation->set_rules('kodesemen','KodeSemen','required',['required'=> 'Field tidak boleh kosong']);
        $this->form_validation->set_rules('sapibetina', 'Sapi', 'required', ['required' => 'Field tidak boleh kosong']);
        $this->form_validation->set_rules('petugas', 'Petugas', 'required', ['required' => 'Field tidak boleh kosong']);
        $this->form_validation->set_rules('ibke', 'Ibke', 'required', ['required' => 'Field tidak boleh kosong']);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error',True);
            $data['judul'] = "REPRODUKSI IB";
            $data['id_user'] = $this->utilitas->user_login();
            $this->load->view('template/header');
            $this->load->view('template/navbar', $data);
            $this->load->view('template/sidebar');
            $this->load->view('admin/reproduksi/v_reproduksi_ib', $data);
            $this->load->view('template/footer');
            $this->load->view('admin/reproduksi/dta_reproduksi_ib');
        }else{
            $post = $this->input->post(null,true);
            $data = $this->M_ternak->validasi_tag($post['sapibetina'])->row();
            $post['sapibetina'] = $data->idsapi;
            if($post['idpetugas'] == ''){
                $namapetugas = htmlspecialchars(strtoupper($post['petugas']));
                $this->M_petugas->save_petugas($namapetugas);
                $query = $this->M_petugas->get($namapetugas)->row();
                $petugas = $query->idpetugas;
                $this->M_reproduksi->insert_ib($petugas,$post);
            }else{
                $petugas = $post['idpetugas'];
                $this->M_reproduksi->insert_ib($petugas,$post);
            }
            redirect('/Reproduksi_IB');
        }
    }
    
}
