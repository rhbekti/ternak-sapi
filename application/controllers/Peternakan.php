<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peternakan extends CI_Controller
{
    public function __construct()   
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['M_peternakan','M_wilayah','M_kelompok','M_koperasi']);
        $this->session->set_userdata('menu','peternakan');
        $this->session->set_userdata('submenu','peternakan');
        belum_login();
    }
    public function get_data()
    {
        header('Content-Type:application/json');
        echo $this->M_peternakan->get_json();
    }
    public function index()
    {
        $data['judul'] = "Data Peternakan";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/peternakan/v_peternakan',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/peternakan/dta_peternakan');
    }
    public function hapus()
    {
        $id = $this->input->post('idpeternakan');
        $this->M_peternakan->delete($id);
        $this->session->set_flashdata('info','Di Hapus');
        redirect('/Peternakan');
    }
    public function edit()
    {
        $data['judul'] = "Edit Data Peternakan";
        $id = $this->input->post('id_peternakan');
        $pro = $this->input->post('propinsi');
        $kab = $this->input->post('kabupaten');
        $kec = $this->input->post('kecamatan');
        $data['id_user'] = $this->utilitas->user_login();
        $data['ra'] = $this->M_peternakan->datasingel($id);
        $data['kabupaten'] = $this->M_wilayah->get_kabupaten($pro);
        $data['kecamatan'] = $this->M_wilayah->get_kecubah($pro,$kab);
        $data['propinsi'] = $this->M_wilayah->get_propinsi()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/peternakan/v_edit',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/peternakan/dta_peternakan');
    }
    public function update()
    {
        $id = $this->input->post('id_peternakan');
        $this->M_peternakan->update($id);
        $this->session->set_flashdata('info','Di Perbarui');
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
    public function cetak()
    {
        $id = $this->input->post('id_peternakan');
        $data['rs'] = $this->M_peternakan->datacetak($id)->row();
        // var_dump($data['row']);die;
		$html = $this->load->view('admin/peternakan/cetak_peternakan',$data,true);
		$this->utilitas->PDFprint($html,'Surat Ternak'.$data['rs']->id_peternakan,'A4','potrait');
    }



}