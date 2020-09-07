<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['M_petugas','M_level']);
        $this->session->set_userdata('menu','petugas');
        $this->session->set_userdata('submenu','');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data Petugas";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/petugas/v_petugas',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/petugas/dta_petugas');
    }
    public function add()
    {
        $data['judul'] = "Tambah Data Petugas";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/petugas/v_tambah',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/petugas/dta_petugas');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_petugas->get_json();
    }
    public function save()
    {
        $this->form_validation->set_rules('nama','Nama','required|trim',['required' => '%s harus diisi']);
		$this->form_validation->set_rules('nip','Nip','required|trim|max_length[20]',[
			'required' => '%s belum diisi'
		]);

		//validasi password
		$this->form_validation->set_rules('pass1','Password','required|trim|min_length[3]|matches[pass2]',[
			'required' => '%s belum terisi.',
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('pass2','Password','required|trim|min_length[3]|matches[pass1]',[
			'required' => '%s belum terisi',
			'matches' => '%s tidak sama!'
		]);
		
		if($this->form_validation->run() == false){
            $data['judul'] = "Tambah Data Petugas";
            $data['id_user'] = $this->utilitas->user_login();
            $this->load->view('template/header');
            $this->load->view('template/navbar',$data);
            $this->load->view('template/sidebar');
            $this->load->view('admin/petugas/v_tambah',$data);
            $this->load->view('template/footer');
            $this->load->view('admin/petugas/dta_petugas');
		}else{
			$this->M_petugas->save();
			redirect('/Petugas');
		}

    }
    public function hapus()
    {
        $id = $this->input->post('id');
        $this->M_petugas->delete($id);
        redirect('/Petugas');
    }
    public function update()
    {
        $this->M_petugas->update();
        redirect('/Petugas');
    }
    public function get_auto()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_petugas->search_data($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = [ 'label' => $row->nama,'kode' => $row->idpetugas ];
                echo json_encode($arr_result);
            }
        }
    }
    public function get_petugas()
    {
        $id = $this->input->post('nmpetugas');
        $data = $this->M_petugas->search_data($id);
        echo json_encode($data);
        
    }
    public function get_petugasById()
    {
        $id = $this->input->post('idpetugas');
        $data = $this->M_petugas->get($id)->row();
        echo json_encode($data);
        
    }
}