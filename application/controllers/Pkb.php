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
        $data = $this->db->get_where('set_pkb')->row();
        echo json_encode($this->M_reproduksi->get_all_pkb($data->jumlah_hari)->result());
    }
    public function aturpkb()
    {
        $post = $this->input->post(null, true);
        $this->db->where('id', 1);
        $this->db->update('set_pkb', ['jumlah_hari' => htmlspecialchars($post['tglhari'])]);
        redirect('/Pkb');
    }
    public function get_json()
    {
        header('Content-Type: application/json');
        echo $this->M_reproduksi->get_json_pkb();
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
        $post = $this->input->post(null, true);
        $this->M_reproduksi->insert_pkb($post);
        $this->M_reproduksi->delete_ib($post['idib']);
        redirect('/Pkb');
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
