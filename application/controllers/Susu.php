<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Susu extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_susu']);
        $this->session->set_userdata('menu','ref_produksi');
        $this->session->set_userdata('submenu','susu');
        belum_login();
    }
    public function index()
    {
        
        $data['judul'] = "Data Produksi Susu";
        $data['id_user'] = $this->utilitas->user_login();
        $data['rs'] = $this->M_susu->get()->result();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/susu/v_susu',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/susu/dta_susu');
    }
    public function get_auto()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_Sapi->search_data($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = [ 'label' => $row->nama,'kode' => $row->idsapi ];
                echo json_encode($arr_result);
            }
        }
    }
}