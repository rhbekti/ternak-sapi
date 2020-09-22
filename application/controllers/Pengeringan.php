<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pengeringan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_pengeringan']);
        $this->session->set_userdata('menu', 'ref_reproduksi');
        $this->session->set_userdata('submenu', 'data_pengeringan');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data pengeringan";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/pengeringan/v_pengeringan', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/pengeringan/dta_pengeringan');
    }
    public function get_data()
    {
        echo json_encode($this->M_pengeringan->get_all());
    }
    public function get_pengeringan()
    {
        header('Content-Type:application/json');
        echo $this->M_pengeringan->get_json();
    }
    public function add()
    {
        $post = $this->input->post(null, true);
        if ($post['status'] >= 2) {
            $this->session->set_flashdata('info', 'Maaf Ternak Sedang Masa Pengeringan');
            redirect('/Pengeringan');
        }
        $set = $this->db->get_where('set_pengeringan', ['id' => 1])->row();

        $tgl_mulai = strtotime('-' . $set->awal_pengeringan . ' day', strtotime($post['tanggal']));
        $tgl_akhir = strtotime('+' . $set->akhir_pengeringan . ' day', strtotime($post['tanggal']));

        $data = [
            'idsapi' => $post['idsapi'],
            'tglmulai' => date('Y-m-d', $tgl_mulai),
            'tglakhir' => date('Y-m-d', $tgl_akhir),
            'idib' => $post['idib']
        ];
        $this->M_pengeringan->insert_pengeringan($data, $post['idpkb']);
        $this->M_pengeringan->update_status($post);
        redirect('/Pengeringan');
    }
    public function aturpengeringan()
    {
        $post = $this->input->post(null, True);
        $this->M_pengeringan->set_pengeringan($post);
        redirect('/Pengeringan');
    }
}
