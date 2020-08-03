<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengajuan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['M_peternakan','M_wilayah','M_kelompok','M_koperasi']);
        $this->session->set_userdata('menu','peternakan');
        $this->session->set_userdata('submenu','pengajuan');
    }
    public function index()
    {
        $data['id_user'] = $this->utilitas->user_login();
        $data['judul'] = "Pengajuan Data Peternakan";
        $data['propinsi'] = $this->M_wilayah->get_propinsi()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/peternakan/v_pengajuan',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/peternakan/dta_pengajuan');
    }
    public function save()
    {
        $this->M_peternakan->save();
        $this->session->set_flashdata('info','Di Tambahkan');
        redirect('/Peternakan');
    }
    public function get_auto()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_kelompok->search_data($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = [ 'label' => $row->namakelompok,'kode' => $row->kodekelompok ];
                echo json_encode($arr_result);
            }
        }
    }
    public function get_koperasi()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_koperasi->search_data($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = [ 'label' => $row->namakoperasi,'kode' => $row->kodekoperasi ];
                echo json_encode($arr_result);
            }
        }
    }
}