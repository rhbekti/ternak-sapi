<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_susu extends CI_Model
{
    public function get_json()
    {
        $this->datatables->select('idpengukuran,tanggal,pagi,sore,kandang.namakandang,xlaktasi,sapi.namasapi');
        $this->datatables->from('pengukuran_produksisusu');
        $this->datatables->join('sapi','sapi.idsapi = pengukuran_produksisusu.idsapi','left');
        $this->datatables->join('kandang','kandang.idkandang = pengukuran_produksisusu.kandang','left');
        $this->datatables->add_column('edit','<form action="'.site_url('/susu/edit').'" method="post"> <button class="btn btn-warning" name="idpengukuran" value="$1"><i class="fas fa-pen"></i></button></form>','idpengukuran');
        $this->datatables->add_column('hapus','<button class="btn btn-danger" id="btnhapus" data-idpengukuran="$1"><i class="fas fa-trash"></i></button>','idpengukuran');
        return $this->datatables->generate();
    }
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('idpengukuran',$id);
        }
        $this->db->join('kandang','pengukuran_produksisusu.kandang = kandang.idkandang','left');
        $this->db->join('sapi','sapi.idsapi = pengukuran_produksisusu.idpengukuran','left');
        return $this->db->get('pengukuran_produksisusu');
    }
    public function insert()
    {
        $data = [
            'idpengukuran' => '',
            'idsapi' => htmlspecialchars($this->input->post('idsapi')),
            'tanggal' => date('Y-m-d'),
            'pagi' => htmlspecialchars($this->input->post('pagi')),
            'sore' => htmlspecialchars($this->input->post('sore')),
            'kandang' => htmlspecialchars($this->input->post('idkandang')),
            'xlaktasi' => htmlspecialchars($this->input->post('xlatasi'))
        ];
        $sql = $this->db->insert('pengukuran_produksisusu',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Tambah');
        }else{
            $this->session->set_flashdata('info','Gagal Ditambah');
        }
    }
    public function update($post)
    {
        $data = [
            'idsapi' => htmlspecialchars($this->input->post('idsapi')),
            'tanggal' => date('Y-m-d'),
            'pagi' => htmlspecialchars($this->input->post('pagi')),
            'sore' => htmlspecialchars($this->input->post('sore')),
            'kandang' => htmlspecialchars($this->input->post('idkandang')),
            'xlaktasi' => htmlspecialchars($this->input->post('xlatasi'))
        ];
        $this->db->where('idpengukuran',$post);
        $sql = $this->db->update('pengukuran_produksisusu',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Perbarui');
        }else{
            $this->session->set_flashdata('info','Gagal di Perbarui');
        }
    }
    public function delete($post)
    {
        $this->db->where('idpengukuran',$post);
        $sql = $this->db->delete('pengukuran_produksisusu');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Dihapus');
        }else{
            $this->session->set_flashdata('info','Gagal DiHapus');
        }
    }
}