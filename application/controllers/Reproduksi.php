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
    // public function tambah()
    // {
    //     $page = $this->input->post('page');
    //     if($page == 'DataIB'){
    //         $data['judul'] = 'Tambah Data IB';
    //         $data['id_user'] = $this->utilitas->user_login();
    //         $this->load->view('template/header');
    //         $this->load->view('template/navbar',$data);
    //         $this->load->view('template/sidebar');
    //         $this->load->view('admin/reproduksi/v_tambah_reproduksi',$data);
    //         $this->load->view('template/footer');
    //         $this->load->view('admin/reproduksi/dta_reproduksi');
    //     }else{
    //         $data['judul'] = 'Tambah Data ET';
    //         $data['id_user'] = $this->utilitas->user_login();
    //         $this->load->view('template/header');
    //         $this->load->view('template/navbar',$data);
    //         $this->load->view('template/sidebar');
    //         $this->load->view('admin/reproduksi/v_tbh_et',$data);
    //         $this->load->view('template/footer');
    //         $this->load->view('admin/reproduksi/dta_reproduksi_et');
    //     }
    // }
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