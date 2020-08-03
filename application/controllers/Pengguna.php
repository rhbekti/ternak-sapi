<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model(['M_pengguna','M_level']);
        $this->session->set_userdata('menu','pengguna');
        $this->session->set_userdata('submenu','');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "Data Pengguna";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/pengguna/v_pengguna',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/pengguna/dta_pengguna');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_pengguna->get_json();
    }
    public function save()
    {
        $this->form_validation->set_rules('nama','Nama','required|trim',['required' => '%s harus diisi']);
		$this->form_validation->set_rules('username','Username','required|trim|max_length[15]|is_unique[pengguna.username]',[
			'is_unique' => '%s telah digunakan',
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
            $data['judul'] = "Tambah Data Pengguna";
            $data['id_user'] = $this->utilitas->user_login();
            $this->load->view('template/header');
            $this->load->view('template/navbar',$data);
            $this->load->view('template/sidebar');
            $this->load->view('admin/pengguna/v_tambah',$data);
            $this->load->view('template/footer');
            $this->load->view('template/ender');
		}else{
			$this->M_pengguna->save();
			$this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Akun Berhasil ditambahkan.</div>');
			redirect('/Pengguna');
		}

    }
    public function add()
    {
        $data['level'] = $this->M_level->get()->result();
        $data['judul'] = "Tambah Data Pengguna";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/pengguna/v_tambah',$data);
        $this->load->view('template/footer');
        $this->load->view('template/ender');

    }
    public function edit()
    {
        $id = $this->input->post('id');
        $data['rs'] = $this->M_pengguna->get($id)->row();
        $data['level'] = $this->M_level->get()->result();
        $data['judul'] = "Edit Data Pengguna";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/pengguna/v_edit',$data);
        $this->load->view('template/footer');
        $this->load->view('template/ender');

    }
    public function update()
    {
        $this->M_pengguna->update();
        redirect('/Pengguna');
    }
    public function hapus()
    {
        $this->M_pengguna->delete();
        redirect('/Pengguna');
    }
}