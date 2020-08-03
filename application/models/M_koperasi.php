<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_koperasi extends CI_Model
{
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('kodekoperasi',$id);
        }
        return $this->db->get('koperasi');
    }
    public function get_json()
    {
        $this->datatables->select('kodekoperasi,namakoperasi,alamatkoperasi,notelpkoperasi,koperasi.kodepropinsi as kdpro,koperasi.kodekabupaten as kdkab,koperasi.kodekecamatan as kdkec,wil_propinsi.namapropinsi as propinsi,wil_kabupaten.namakabupaten as kab,wil_kecamatan.namakecamatan as kec');
        $this->datatables->from('koperasi');
        $this->datatables->join('wil_propinsi','wil_propinsi.kodepropinsi = koperasi.kodepropinsi','left');
        $this->datatables->join('wil_kabupaten','wil_kabupaten.kodepropinsi = koperasi.kodepropinsi AND wil_kabupaten.kodekabupaten = koperasi.kodekabupaten','left');
        $this->datatables->join('wil_kecamatan','wil_kecamatan.kodepropinsi = koperasi.kodepropinsi AND wil_kecamatan.kodekabupaten = koperasi.kodekabupaten AND wil_kecamatan.kodekecamatan = koperasi.kodekecamatan','left');
        $this->datatables->add_column('edit','<form action="'.site_url('/koperasi/edit').'" method="post"> <button class="btn btn-warning" name="kodekoperasi" value="$1"><i class="fas fa-pen"></i></button><input type="hidden" value="$2" name="propinsi"><input type="hidden" value="$3" name="kabupaten"><input type="hidden" value="$4" name="kecamatan"></form>','kodekoperasi,kdpro,kdkab,kdkec');
        $this->datatables->add_column('hapus','<button class="btn btn-danger" id="hapusdata" data-kodekoperasi="$1"><i class="fas fa-trash"></i></button>','kodekoperasi');
        return $this->datatables->generate();
    }
    public function insert()
    {
        $data = [
            'kodekoperasi' => '',
            'namakoperasi' => htmlspecialchars($this->input->post('nama')),
            'alamatkoperasi' => htmlspecialchars($this->input->post('alamat')),
            'notelpkoperasi' => htmlspecialchars($this->input->post('notelpkoperasi')),
            'kodepropinsi' => htmlspecialchars($this->input->post('propinsi')),
            'kodekabupaten' => htmlspecialchars($this->input->post('kabupaten')),
            'kodekecamatan' => htmlspecialchars($this->input->post('kecamatan'))
        ];
        $this->db->insert('koperasi',$data);
    }
    public function delete()
    {
        $id = $this->input->post('kodekoperasi');
        $this->db->where('kodekoperasi',$id);
        $this->db->delete('koperasi');
    }
    public function update()
    {
        $id = $this->input->post('kodekoperasi');
        $data = [
            'namakoperasi' => htmlspecialchars($this->input->post('nama')),
            'alamatkoperasi' => htmlspecialchars($this->input->post('alamat')),
            'notelpkoperasi' => htmlspecialchars($this->input->post('notelpkoperasi')),
            'kodepropinsi' => htmlspecialchars($this->input->post('propinsi')),
            'kodekabupaten' => htmlspecialchars($this->input->post('kabupaten')),
            'kodekecamatan' => htmlspecialchars($this->input->post('kecamatan'))
        ];
        $this->db->where('kodekoperasi',$id);
        $this->db->update('koperasi',$data);
    }
    public function datatunggal()
    {
        $id = $this->input->post('kodekoperasi');
        $this->db->where('kodekoperasi',$id);
        return $this->db->get('koperasi');
    }
    public function search_data($data){
        $this->db->like('namakoperasi', $data , 'both');
        $this->db->order_by('kodekoperasi', 'ASC');
        $this->db->limit(10);
        return $this->db->get('koperasi')->result();
    }
}