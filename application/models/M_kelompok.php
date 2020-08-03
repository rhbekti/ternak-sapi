<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_kelompok extends CI_Model
{
    public function search_data($data){
        $this->db->like('namakelompok', $data , 'both');
        $this->db->order_by('kodekelompok', 'ASC');
        $this->db->limit(10);
        return $this->db->get('kelompok')->result();
    }
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('kodekelompok',$id);
        }
        return $this->db->get('kelompok');
    }
    public function get_json()
    {
        $this->datatables->select('kodekelompok,namakelompok,alamatkelompok,notelp,kelompok.kodepropinsi as kdpro,kelompok.kodekabupaten as kdkab,kelompok.kodekecamatan as kdkec,wil_propinsi.namapropinsi as propinsi,wil_kabupaten.namakabupaten as kab,wil_kecamatan.namakecamatan as kec');
        $this->datatables->from('kelompok');
        $this->datatables->join('wil_propinsi','wil_propinsi.kodepropinsi = kelompok.kodepropinsi','left');
        $this->datatables->join('wil_kabupaten','wil_kabupaten.kodepropinsi = kelompok.kodepropinsi AND wil_kabupaten.kodekabupaten = kelompok.kodekabupaten','left');
        $this->datatables->join('wil_kecamatan','wil_kecamatan.kodepropinsi = kelompok.kodepropinsi AND wil_kecamatan.kodekabupaten = kelompok.kodekabupaten AND wil_kecamatan.kodekecamatan = kelompok.kodekecamatan','left');
        $this->datatables->add_column('edit','<form action="'.site_url('/Kelompok/edit').'" method="post"> <button class="btn btn-warning" name="kodekelompok" value="$1"><i class="fas fa-pen"></i></button><input type="hidden" value="$2" name="propinsi"><input type="hidden" value="$3" name="kabupaten"><input type="hidden" value="$4" name="kecamatan"></form>','kodekelompok,kdpro,kdkab,kdkec');
        $this->datatables->add_column('hapus','<button class="btn btn-danger" id="hapusdata" data-kodekelompok="$1"><i class="fas fa-trash"></i></button>','kodekelompok');
        return $this->datatables->generate();
    }
    public function insert()
    {
        $data = [
            'kodekelompok' => '',
            'namakelompok' => htmlspecialchars($this->input->post('nama')),
            'alamatkelompok' => htmlspecialchars($this->input->post('alamat')),
            'notelp' => htmlspecialchars($this->input->post('notelp')),
            'kodepropinsi' => htmlspecialchars($this->input->post('propinsi')),
            'kodekabupaten' => htmlspecialchars($this->input->post('kabupaten')),
            'kodekecamatan' => htmlspecialchars($this->input->post('kecamatan'))
        ];
        $this->db->insert('kelompok',$data);
    }
    public function delete()
    {
        $id = $this->input->post('kodekelompok');
        $this->db->where('kodekelompok',$id);
        $this->db->delete('kelompok');
    }
    public function update()
    {
        $id = $this->input->post('kodekelompok');
        $data = [
            'namakelompok' => htmlspecialchars($this->input->post('nama')),
            'alamatkelompok' => htmlspecialchars($this->input->post('alamat')),
            'notelp' => htmlspecialchars($this->input->post('notelp')),
            'kodepropinsi' => htmlspecialchars($this->input->post('propinsi')),
            'kodekabupaten' => htmlspecialchars($this->input->post('kabupaten')),
            'kodekecamatan' => htmlspecialchars($this->input->post('kecamatan'))
        ];
        $this->db->where('kodekelompok',$id);
        $this->db->update('kelompok',$data);
    }
    public function datatunggal()
    {
        $id = $this->input->post('kodekelompok');
        $this->db->where('kodekelompok',$id);
        return $this->db->get('kelompok');
    }
}