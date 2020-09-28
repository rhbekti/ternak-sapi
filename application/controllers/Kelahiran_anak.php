<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kelahiran_anak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_kelahiran']);
        $this->session->set_userdata('menu', 'ref_kelahiran');
        $this->session->set_userdata('submenu', 'kelahiran_anak');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data Kelahiran Anak";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kelahiran_anak/v_kelahiran_anak', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/kelahiran_anak/dta_kelahiran_anak');
    }
    public function get_data()
    {
        header('Content-Type:application/json');
        echo $this->M_kelahiran->get_kelahiran_anak();
    }
    public function add()
    {
        $post = $this->input->post(null, true);
        $result = $this->M_kelahiran->get_kelahiran_id($post['idsapi']);

        if ($post['status'] == 'single') {
            if ($result->num_rows() > 0) {
                $this->session->set_flashdata('info', 'Data sudah di Masukkan');
                redirect('/Kelahiran_anak');
            } else {
                $this->M_kelahiran->insert_kelahiran_anak($post);
                $this->M_kelahiran->update_status_kelahiran($post['idib']);
                $this->M_kelahiran->update_status_pkb($post['idib']);
                $this->M_kelahiran->update_status_ib($post['idib']);
            }
        } else {
            if ($result->num_rows() > 1) {
                $this->session->set_flashdata('info', 'Data sudah di Masukkan');
                redirect('/Kelahiran_anak');
            } else {
                $this->M_kelahiran->insert_kelahiran_anak($post);
                $this->M_kelahiran->update_status_kelahiran($post['idib']);
                $this->M_kelahiran->update_status_pkb($post['idib']);
                $this->M_kelahiran->update_status_ib($post['idib']);
            }
        }
        redirect('/Kelahiran_anak');
    }
}
