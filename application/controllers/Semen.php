<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Semen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_semen']);
        $this->session->set_userdata('menu','ref_reproduksi');
        $this->session->set_userdata('submenu','data_semen');
        belum_login();
    }
    public function index()
    {
        $data['judul'] = "DATA SEMEN";
        $data['id_user'] = $this->utilitas->user_login();
        $this->load->view('template/header');
        $this->load->view('template/navbar',$data);
        $this->load->view('template/sidebar');
        $this->load->view('admin/semen/v_semen',$data);
        $this->load->view('template/footer');
        $this->load->view('admin/semen/dta_semen');
    } 
    public function tambah()
    {
        $this->form_validation->set_rules('kodesemen','Kodesemen','required|trim|min_length[10]|max_length[11]|is_unique[semen.kodesemen]',
        [
            'is_unique' => 'Data Telah Digunakan',
            'required' => 'Field harus di isi',
            'min_lenght' => 'Field minimal 6 karakter',
            'max_length' => 'Field maximal 8 karakter'
        ]);
        $this->form_validation->set_rules('namasemen','Namasemen','required|trim',[
            'required' => 'Field harus diisi'
        ]);

        if($this->form_validation->run() == false){
            $this->session->set_flashdata('error',true);
            $data['judul'] = "DATA SEMEN";
            $data['id_user'] = $this->utilitas->user_login();
            $this->load->view('template/header');
            $this->load->view('template/navbar',$data);
            $this->load->view('template/sidebar');
            $this->load->view('admin/semen/v_semen',$data);
            $this->load->view('template/footer');
            $this->load->view('admin/semen/dta_semen');
        }else{
            $this->M_semen->insert();
            redirect('/semen');
        }
    }
    public function update()
    {
        $kode = $this->input->post('kodesemen');
        $kodelama = $this->input->post('kode');
        $query = $this->M_semen->get($kode);
        if($query->num_rows() > 0)
        {
           $this->M_semen->update();
        }else{
            $this->M_semen->delete($kodelama);
            $this->M_semen->insert();
        }
        redirect('/semen');
        
    }
    public function delete()
    {
        $kode = $this->input->post('kodesemen');
        $this->M_semen->delete($kode);
        redirect('/semen');
    }
    public function get_data()
    {
        header('Content-Type: application/json');
        echo $this->M_semen->get_json();
    }
}