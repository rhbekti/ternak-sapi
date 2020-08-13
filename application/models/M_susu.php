<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_susu extends CI_Model
{
    public function get_json()
    {
        $this->datatables->select('id_susu,id_sapi,tgl_produksi,pagi,sore,kandang.namakandang,xlaktasi,sapi.namasapi,peternakan.namapeternakan');
        $this->datatables->from('susu');
        $this->datatables->join('sapi','sapi.idsapi = susu.id_sapi','left');
        $this->datatables->join('peternakan','peternakan.id_peternakan = susu.peternakan','left');
        $this->datatables->join('kandang','kandang.idkandang = susu.kandang','left');
        $this->datatables->add_column('edit','<form action="'.site_url('/susu/edit').'" method="post"> <button class="btn btn-warning" name="id_susu" value="$1"><i class="fas fa-pen"></i></button></form>','id_susu');
        $this->datatables->add_column('hapus','<button class="btn btn-danger" id="btnhapus" data-idsusu="$1"><i class="fas fa-trash"></i></button>','id_susu');
        return $this->datatables->generate();
    }
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('id_susu',$id);
        }
        $this->db->join('kandang','susu.kandang = kandang.idkandang','left');
        $this->db->join('peternakan','peternakan.id_peternakan = susu.peternakan','left');
        $this->db->join('sapi','sapi.idsapi = susu.id_sapi','left');
        return $this->db->get('susu');
    }
    public function insert()
    {
        $data = [
            'id_susu' => '',
            'peternakan' => htmlspecialchars($this->input->post('idpeternakan')),
            'id_sapi' => htmlspecialchars($this->input->post('idsapi')),
            'tgl_produksi' => date('Y-m-d'),
            'pagi' => htmlspecialchars($this->input->post('pagi')),
            'sore' => htmlspecialchars($this->input->post('sore')),
            'kandang' => htmlspecialchars($this->input->post('idkandang')),
            'xlaktasi' => htmlspecialchars($this->input->post('xlatasi')),
            'barcode' => uniqid(date('Y-m-d H:i:s').$this->input->post('idsapi'))
        ];
        $sql = $this->db->insert('susu',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Tambah');
        }else{
            $this->session->set_flashdata('info','Gagal Ditambah');
        }
    }
    public function update($post)
    {
        $data = [
            'peternakan' => htmlspecialchars($this->input->post('idpeternakan')),
            'id_sapi' => htmlspecialchars($this->input->post('idsapi')),
            'tgl_produksi' => date('Y-m-d'),
            'pagi' => htmlspecialchars($this->input->post('pagi')),
            'sore' => htmlspecialchars($this->input->post('sore')),
            'kandang' => htmlspecialchars($this->input->post('idkandang')),
            'xlaktasi' => htmlspecialchars($this->input->post('xlatasi')),
            'barcode' => uniqid(date('Y-m-d H:i:s').$this->input->post('idsapi'))
        ];
        $this->db->where('id_susu',$post);
        $sql = $this->db->update('susu',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Perbarui');
        }else{
            $this->session->set_flashdata('info','Gagal di Perbarui');
        }
    }
    public function delete($post)
    {
        $this->db->where('id_susu',$post);
        $sql = $this->db->delete('susu');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Dihapus');
        }else{
            $this->session->set_flashdata('info','Gagal DiHapus');
        }
    }
}