<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(array('M_Login'));
	}
	public function index()
	{
		//mengecek session user
		sudah_login();
		$this->load->view('depan/login/v_login');
	}
	public function proses()
	{
		$this->form_validation->set_rules('username','Username','required|trim',[
			'required' => '%s tidak boleh kosong'
		]);
		$this->form_validation->set_rules('password','Password','required',[
			'required' => '%s tidak boleh kosong'
		]);
		if($this->form_validation->run() == false){
				$this->load->view('depan/login/v_login');
		}else{
			$post = $this->input->post(null,True);
			if(isset($post['login'])){
				$query = $this->M_Login->proses($post);
				if($query->num_rows() > 0){
					$row = $query->row();
					$param = [
						'id' => $row->id,
						'level' => $row->level
					];
					$this->session->set_userdata($param);
					$this->session->set_flashdata('pesan',$row->username);
					redirect('/Pengguna');
				}else{
					$this->session->set_flashdata('pesan','<div class="alert alert-danger" role="alert">Username / Password salah.</div>');
					redirect('/Login');
				}
			}
		}
	}
	public function register()
	{
		$this->load->view('depan/login/v_register');
	}
	public function tambah()
	{
		$this->form_validation->set_rules('nama','Nama','required|trim');
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
			$this->load->view('depan/login/v_register');
		}else{
			$this->M_Login->insert();
			$this->session->set_flashdata('pesan','<div class="alert alert-success" role="alert">Selamat Akun Telah dibuat.silakan Login untuk melanjutkan.</div>');
			redirect('/Login');
		}
	}
	public function logout()
	{
		$param = ['id','level'];
		$this->session->unset_userdata($param);
		redirect('/Login');
	}
}
