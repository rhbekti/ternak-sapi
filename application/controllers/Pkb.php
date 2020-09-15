<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pkb extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_reproduksi', 'M_pengeringan']);
        $this->session->set_userdata('menu', 'ref_reproduksi');
        $this->session->set_userdata('submenu', 'data_pkb');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = 'Data PKB';
        $data['id_user'] = $this->utilitas->user_login();
        $data['rs'] = $this->M_reproduksi->get_pkb()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/reproduksi/v_pkb', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/reproduksi/dta_pkb');
    }
    public function get_data()
    {
        echo json_encode($this->M_reproduksi->get_json_pkb()->result());
    }
    public function hapus()
    {
        $post = $this->input->post(null, True);
        $this->M_reproduksi->delete_pkb($post);
        $this->M_pengeringan->delete_pk($post);
        redirect('/Pkb');
    }
    public function tambah()
    {
        $data['judul'] = 'Data PKB';
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/reproduksi/v_tambah_pkb', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/reproduksi/dta_pkb');
    }
    public function edit()
    {
        $id = $this->input->post('idpkb');
        $data['rw'] = $this->M_reproduksi->get_pkb($id)->row();
        $data['judul'] = 'Edit Data PKB';
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/reproduksi/v_edit_pkb', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/reproduksi/dta_pkb');
    }
    public function update()
    {
        $post = $this->input->post(null, True);
        $this->M_reproduksi->edit_pkb($post);
        redirect('/Pkb');
    }
    public function save()
    {
        $post = $this->input->post(null, True);
        $this->M_reproduksi->insert_pkb($post);
        if ($post['hasil'] == 'P') {
            $this->M_reproduksi->update_status_sapi($post);
            $this->M_pengeringan->insert_pengeringan($post);
        }
        redirect('/Pkb');
    }
}
