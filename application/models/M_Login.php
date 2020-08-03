<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Login extends CI_Model
{
    public function proses($post)
    {
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->where('username',$post['username']);
        $this->db->where('password',sha1($post['password']));
        $hasil = $this->db->get();
        return $hasil;
    }
    function insert()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'level' => '2',
            'password' => sha1($this->input->post('pass1'))
        ];
        $this->db->insert('pengguna',$data);
    }
}