<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Reproduksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_reproduksi','M_petugas']);
        $this->session->set_userdata('menu','ref_reproduksi');
        $this->session->set_userdata('submenu','tbhreproduksi');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Tambah Data Reproduksi";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/reproduksi/v_tambah_reproduksi',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/reproduksi/dta_reproduksi');
    }
    public function save()
    {  
        $idpetugas = $this->input->post('idpetugas');
        var_dump($idpetugas);
        if($idpetugas == ''){
            $namapetugas = htmlspecialchars(strtoupper($this->input->post('petugas')));
            if($namapetugas !== ''){
                $this->M_petugas->save_petugas($namapetugas);
                $query = $this->M_petugas->get($namapetugas)->row();
                $petugas = $query->idpetugas;
                $this->M_reproduksi->insert($petugas);
            }else{
                $this->session->set_flashdata('pesan','Data Petugas Belum di Isi');
                redirect('/Reproduksi');
            }
        }else{
            $this->M_reproduksi->insert($idpetugas);
        }
        redirect('/Reproduksi');
    }
    public function hapus()
    {
        $jenis = $this->input->post('jenis');
        if($jenis == 'IB'){
            $id = htmlspecialchars($this->input->post('idib'));
            $this->M_reproduksi->delete_ib($id);
            redirect('/Reproduksi_IB');
        }else if($jenis == 'ET'){
            $id = htmlspecialchars($this->input->post('idet'));
            $this->M_reproduksi->delete_et($id);
            redirect('/Reproduksi_ET');
        }else{
            redirect('/Reproduksi');
        }
    }
}