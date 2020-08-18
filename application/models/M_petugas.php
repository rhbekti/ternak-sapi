<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_petugas extends CI_Model
{
    public function search_data($data){
        $this->db->like('nama', $data , 'both');
        $this->db->order_by('idpetugas', 'ASC');
        $this->db->limit(10);
        return $this->db->get('petugas')->result();
    }
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('idpetugas',$id);
        }
        return $this->db->get('petugas');
    }
    public function get_json()
    {
        $this->datatables->select('idpetugas,nama,jabatan,nip,password');
        $this->datatables->from('petugas');
        $this->datatables->add_column('edit','<button id="editData" class="btn btn-warning" data-idpetugas="$1" data-nama="$2" data-jabatan="$3" data-nip="$4"><i class="fas fa-pen"></i></button>','idpetugas,nama,jabatan,nip');
        $this->datatables->add_column('hapus','<button id="hapusData" class="btn btn-danger" data-idpetugas="$1"><i class="fas fa-trash"></i></button>','idpetugas');
        return $this->datatables->generate();
    }
    public function save()
    {
        $data = [
            'idpetugas' => '',
            'nama' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip'),
            'password' => sha1($this->input->post('pass1'))
        ];
        $sql = $this->db->insert('petugas',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Data Berhasil Ditambah');
        }else{
            $this->session->set_flashdata('info','Data Gagal Ditambah');
        }
    }
    public function update()
    {
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
            'jabatan' => $this->input->post('jabatan'),
            'nip' => $this->input->post('nip')
        ];
        $this->db->where('idpetugas',$id);
        $sql = $this->db->update('petugas',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Data Berhasil DiPerbarui');
        }else{
            $this->session->set_flashdata('info','Data Gagal DiPerbarui');
        }
    }
    public function delete($post)
    {
        $this->db->where('idpetugas',$post);
        $sql = $this->db->delete('petugas');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Data Berhasil Dihapus');
        }else{
            $this->session->set_flashdata('info','Data Gagal Dihapus');
        }
    }
}