<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_pengguna extends CI_Model
{
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('id',$id);
        }
        $this->db->join('level','level.id_level = pengguna.level');
        return $this->db->get('pengguna');
    }
    public function get_json()
    {
        $this->datatables->select('id,nama,username,level.nama_level');
        $this->datatables->from('pengguna');
        $this->datatables->join('level','level.id_level = pengguna.level');
        $this->datatables->add_column('edit','<form action="'.site_url('/Pengguna/edit').'" method="post"><button class="btn btn-warning" name="id" value="$1"><i class="fas fa-pen"></i></button></form>','id');
        $this->datatables->add_column('hapus','<button class="btn btn-danger" id="hapusdata" data-id="$1"><i class="fas fa-trash"></i></button>','id');
        $this->datatables->add_column('editpass','<a href="'.site_url('/pengguna/editpass').'" data-id="$1" class="btn btn-secondary">ubah password</a>','id');
        return $this->datatables->generate();
    }
    public function save()
    {
        $data = [
            'id' => '',
            'nama' => htmlspecialchars($this->input->post('nama')),
            'username' => htmlspecialchars($this->input->post('username')),
            'password' => sha1($this->input->post('pass1')),
            'level' => $this->input->post('level')
        ];
        $this->db->insert('pengguna',$data);
    }
    public function update()
    {
        $id = $this->input->post('id');
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama')),
            'username' => htmlspecialchars($this->input->post('username')),
            'password' => sha1($this->input->post('password')),
            'level' => $this->input->post('level')
        ];
        $this->db->where('id',$id);
        $this->db->update('pengguna',$data);
    }
    public function delete()
    {
        $id = $this->input->post('id');
        $this->db->where('id',$id);
        $this->db->delete('pengguna');
    }
}