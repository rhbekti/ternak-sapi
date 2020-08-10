<?php defined('BASEPATH') OR exit('No direct script access allowed');
class M_kandang extends CI_Model
{
    public function get_json()
    {
        $this->datatables->select('idkandang,namakandang,lokasikandang,kapasitas,idfarm,peternakan.namapeternakan');
        $this->datatables->from('kandang');
        $this->datatables->join('peternakan','peternakan.id_peternakan = kandang.idfarm','left');
        $this->datatables->add_column('edit','<button type="button" id="editkandang" name="edit" class="btn btn-warning" data-idkandang="$1" data-namakandang="$2" data-alamat="$3" data-kapasitas="$4" data-peternakan="$5" data-namapeternakan="$6">
        <i class="fas fa-pen"></i>
      </button>','idkandang,namakandang,lokasikandang,kapasitas,idfarm,namapeternakan');
        $this->datatables->add_column('hapus','<button type="button" id="hapusdata" name="hapus" class="btn btn-danger" data-idkandang="$1">
        <i class="fas fa-trash"></i>
      </button>','idkandang');
        return $this->datatables->generate();
    }
    public function update()
    {
        $idkandang = $this->input->post('idkandang');
        $data = [
            'namakandang' => htmlspecialchars($this->input->post('namakandang')),
            'lokasikandang' => htmlspecialchars(strtoupper($this->input->post('lokasikandang'))),
            'kapasitas' => htmlspecialchars($this->input->post('kapasitas')),
            'idfarm' => htmlspecialchars($this->input->post('peternakan'))
        ];
        $this->db->where('idkandang',$idkandang);
        $sql = $this->db->update('kandang',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Perbarui');
        }else{
            $this->session->set_flashdata('info','Gagal di Perbarui');
        }
    }
    public function insert()
    {
        $data = [
            'idkandang' => '',
            'namakandang' => htmlspecialchars($this->input->post('namakandang')),
            'lokasikandang' => htmlspecialchars(strtoupper($this->input->post('alamat'))),
            'kapasitas' => htmlspecialchars($this->input->post('kapasitas')),
            'idfarm' => htmlspecialchars($this->input->post('peternakan'))
        ];
        $sql = $this->db->insert('kandang',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Simpan');
        }else{
            $this->session->set_flashdata('info','Gagal di Simpan');
        }
    }
    public function delete()
    {
        $id = $this->input->post('idkandang');
        $this->db->where('idkandang',$id);
        $sql = $this->db->delete('kandang');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Hapus');
        }else{
            $this->session->set_flashdata('info','Gagal di Hapus');
        }
    }
}