<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Wilayah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_wilayah']);
    }
    public function get_kab()
    {
        $id = $this->input->post('id');
        $data = $this->M_wilayah->get_kabupaten($id);
        echo json_encode($data);
    }
    public function get_kec()
    {
        $id = $this->input->post('pro');
        $data = $this->M_wilayah->get_kecamatan($id);
        echo json_encode($data);
    }
    public function get_kechange()
    {
        $id = $this->input->post('pro');
        $rh = $this->input->post('kab');
        $data = $this->M_wilayah->get_kecubah($id,$rh);
        echo json_encode($data);
    }
}