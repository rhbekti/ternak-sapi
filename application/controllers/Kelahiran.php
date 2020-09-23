<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kelahiran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_kelahiran', 'M_ternak', 'M_reproduksi']);
        $this->session->set_userdata('menu', 'ref_kelahiran');
        $this->session->set_userdata('submenu', 'data_kelahiran');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data Kelahiran";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kelahiran/v_kelahiran', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/kelahiran/dta_kelahiran');
    }
    public function get_kelahiran()
    {
        $data = $this->M_reproduksi->get_data_lahir()->result();
        echo json_encode($data);
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_kelahiran->get_data_json();
    }
    public function delete()
    {
        $id = $this->input->post('idkelahiran');
        $this->M_kelahiran->delete($id);
        $this->session->set_flashdata('info', 'Di Hapus');
        redirect('/Kelahiran');
    }
    public function tambah()
    {
        $sapi = $this->M_ternak->get($this->input->post('idsapi'))->row();
        $data = [
            'idkelahiran' => "",
            'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
            'idsapi' => $this->input->post('idsapi'),
            'xlaktasi' => $this->input->post('xlaktasi'),
            'keterangan' => $this->input->post('keterangan'),
            'idpetugas' => $this->input->post('idpetugas'),
            'tglinput' => $this->input->post('tglinput'),
            'tagsapi' => $this->input->post('namasapi'),
            'statuslahir' => $this->input->post('statuslahir'),
            'status_ternak' => 4,
            'idfarm' => $this->input->post('idfarm'),
            'idib' => $this->input->post('idib')
        ];

        $this->M_kelahiran->insert_data($data);
        $this->M_kelahiran->update_status($this->input->post('idpkb'));
        redirect('/Kelahiran');
    }
    public function edit()
    {
        $post = $this->input->post('idkelahiran');
        $data['rs'] = $this->M_kelahiran->get($post)->row();
        $data['judul'] = "Edit Data Kelahiran";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kelahiran/v_edit_kelahiran', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/kelahiran/dta_kelahiran');
    }
    public function update()
    {
        $post = $this->input->post(null, true);
        $this->M_kelahiran->update_data($post);
        redirect('/Kelahiran');
    }
}
