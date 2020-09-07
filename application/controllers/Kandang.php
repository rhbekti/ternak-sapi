<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kandang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_kandang']);
        $this->session->set_userdata('menu', 'peternakan');
        $this->session->set_userdata('submenu', 'kandang');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data Kandang";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kandang/v_kandang', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/kandang/dta_kandang');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_kandang->get_json();
    }
    public function update()
    {
        $this->M_kandang->update();
        redirect('/Kandang');
    }
    public function add()
    {
        $data['judul'] = "Tambah Data Kandang";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/kandang/v_tambah_kandang', $data);
        $this->load->view('template/footer');
        $this->load->view('admin/kandang/dta_kandang');
    }
    public function save()
    {
        $this->form_validation->set_rules('namakandang', 'Nama Kandang', 'required|trim|min_length[3]', [
            'required' => '%s harus di isi',
            'min_length' => '%s minimal 3 karakter'
        ]);
        $this->form_validation->set_rules('alamat','Alamat','required|trim',[
            'required' => '%s harus di isi'
        ]);
        $this->form_validation->set_rules('kapasitas','Kapasitas','required|trim',[
            'required' => '%s harus di isi'
        ]);
        $this->form_validation->set_rules('namapeternakan','Nama Peternakan','required|trim',[
            'required' => '%s harus di isi'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', true);
            $data['judul'] = "Data Kandang";
            $data['id_user'] = $this->utilitas->user_login();
            $this->load->view('template/header');
            $this->load->view('template/navbar', $data);
            $this->load->view('template/sidebar');
            $this->load->view('admin/kandang/v_kandang', $data);
            $this->load->view('template/footer');
            $this->load->view('admin/kandang/dta_kandang');
        } else {
            $this->M_kandang->insert();
            redirect('/Kandang');
        }
    }
    public function delete()
    {
        $this->M_kandang->delete();
        redirect('/Kandang');
    }
    public function get_kandang()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_kandang->cari_data($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $array_hasil[] = ['label' => $row->namakandang, 'idkd' => $row->idkandang];
                echo json_encode($array_hasil);
            } else {
                $array_hasil[] = ['error' => 'Data Tidak Ditemukan'];
                echo json_encode($array_hasil);
            }
        }
    }
}
