<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reproduksi_ET extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_reproduksi','M_petugas']);
        $this->session->set_userdata('menu','ref_reproduksi');
        $this->session->set_userdata('submenu','data_et');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Reproduksi ET";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/reproduksi/v_reproduksi_et',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/reproduksi/dta_reproduksi_et');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_reproduksi->get_json_et();
    }
    public function tambah()
    {
        $this->form_validation->set_rules('tanggal','Tanggal','required',['required' => '%s harus di isi']);
        $this->form_validation->set_rules('sapijantan','Sapijantan','required',['required' => 'Field ini harus di isi']);
        $this->form_validation->set_rules('sapibetina','Sapibetina','required',['required' => 'Field ini harus di isi']);
        

        if($this->form_validation->run() == FALSE){
            $data['judul'] = "Reproduksi ET";
            $this->session->set_flashdata('error', true);
            $data['id_user'] = $this->utilitas->user_login();
            $this->load->view('template/header');
            $this->load->view('template/navbar',$data);
            $this->load->view('template/sidebar');
            $this->load->view('admin/reproduksi/v_reproduksi_et',$data);
            $this->load->view('template/footer');
            $this->load->view('admin/reproduksi/dta_reproduksi_et');
        }else{
            if($this->input->post('idpetugas') == ''){
                $nmpetugas = $this->input->post('namapetugas');
                $this->M_petugas->save_petugas($nmpetugas);
            }else{
                $this->M_reproduksi->insert_et();
                redirect('/Reproduksi_ET');
            }
        }    
    }
    public function hapus()
    {
        $post = $this->input->post(null,true);
        $this->M_reproduksi-> delete_et($post['idtransfer']);
        redirect('/Reproduksi_ET');
    }
}