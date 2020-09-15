<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_semen extends CI_Model
{
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('kodesemen',$id);
        }
        return $this->db->get('semen');
    }
    public function get_json()
    {
        $this->datatables->select('kodesemen,namasemen');
        $this->datatables->from('semen');
        $this->datatables->add_column('pilih_semen','<button class="btn-semen btn btn-success" data-kodesemen="$1" data-namasemen="$2"><i class="fas fa-plus-circle"></i></button>','kodesemen,namasemen');
        $this->datatables->add_column('edit','<button class="btn btn-warning" id="btnEdit" data-kodesemen="$1" data-namasemen="$2"><i class="fas fa-pen"></i></button>','kodesemen,namasemen');
        $this->datatables->add_column('hapus','<button class="btn btn-danger" id="btnHapus" data-kodesemen="$1"><i class="fas fa-trash"></i></button>','kodesemen');
        return $this->datatables->generate();
    }
    public function insert()
    {
        $data = [
            'kodesemen' => $this->input->post('kodesemen'),
            'namasemen' => $this->input->post('namasemen')
        ];
        $sql = $this->db->insert('semen',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','DATA BERHASIL DITAMBAHKAN');
        }else{
            $this->session->set_flashdata('info','DATA GAGAL DITAMBAHKAN');
        }
    }
    public function update()
    {
        $kodesemen =  $this->input->post('kodesemen');
        $data = [
            'namasemen' => $this->input->post('namasemen')
        ];
        $this->db->where('kodesemen',$kodesemen);
        $sql = $this->db->update('semen',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','DATA BERHASIL DIPERBARUI');
        }else{
            $this->session->set_flashdata('info','DATA GAGAL DIPERBARUI');
        }
    }
    public function delete($post)
    {
        $this->db->where('kodesemen',$post);
        $sql = $this->db->delete('semen');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','DATA BERHASIL DIHAPUS');
        }else{
            $this->session->set_flashdata('info','DATA GAGAL DIHAPUS');
        }
    }
}