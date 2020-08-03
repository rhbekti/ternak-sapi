<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_peternakan extends CI_Model
{
    public function save()
    {
        $data = [
            'id_peternakan' => '',
            'kodekoperasi' => htmlspecialchars($this->input->post('kodekoperasi')),
            'kodekelompok' => htmlspecialchars($this->input->post('kodekelompok')),
            'namapeternakan' => htmlspecialchars($this->input->post('nmpeternakan')),
            'alamat' => htmlspecialchars($this->input->post('alpeternakan')),
            'notelp' => htmlspecialchars($this->input->post('notelp')),
            'nosiup' => htmlspecialchars($this->input->post('nosiup')),
            'tglberdiri' => htmlspecialchars($this->input->post('tglberdiri')),
            'namapeternak' => htmlspecialchars($this->input->post('pemilik')),
            'kodekecamatan' => htmlspecialchars($this->input->post('kecamatan')),
            'kodekabupaten' => htmlspecialchars($this->input->post('kabupaten')),
            'kodepropinsi' => htmlspecialchars($this->input->post('propinsi')),
            'user_id' => $this->input->post('user_id')
        ];
        $this->db->insert('peternakan',$data);
    }
    public function get_json()
    {
        $this->datatables->select('id_peternakan,namapeternakan,alamat,namapeternak,notelp,nosiup,peternakan.kodepropinsi as kdpro,peternakan.kodekabupaten as kdkab,peternakan.kodekecamatan as kdkec,tglberdiri,wil_propinsi.namapropinsi as nmpropinsi,wil_kabupaten.namakabupaten as nmkab,wil_kecamatan.namakecamatan as nmkec');
        $this->datatables->from('peternakan');
        $this->datatables->join('wil_propinsi','wil_propinsi.kodepropinsi = peternakan.kodepropinsi','left');
        $this->datatables->join('wil_kabupaten','wil_kabupaten.kodepropinsi = peternakan.kodepropinsi AND wil_kabupaten.kodekabupaten = peternakan.kodekabupaten','left');
        $this->datatables->join('wil_kecamatan','wil_kecamatan.kodepropinsi = peternakan.kodepropinsi AND wil_kecamatan.kodekabupaten = peternakan.kodekabupaten AND wil_kecamatan.kodekecamatan = peternakan.kodekecamatan','left');
        $this->datatables->add_column('edit','<form action="'.site_url('/peternakan/edit').'" method="post"> <button class="btn btn-warning" name="id_peternakan" value="$1"><i class="fas fa-pen"></i></button><input type="hidden" value="$2" name="propinsi"><input type="hidden" value="$3" name="kabupaten"><input type="hidden" value="$4" name="kecamatan"></form>','id_peternakan,kdpro,kdkab,kdkec');
        $this->datatables->add_column('cetak','<form action="'.site_url('/peternakan/cetak').'" method="post" target="_blank"> <button class="btn btn-info" name="id_peternakan" value="$1"><i class="fas fa-print"></i></button></form>','id_peternakan,kdpro,kdkab,kdkec');
        $this->datatables->add_column('hapus','<button class="btn btn-danger" id="hapusdata" data-idpeternakan="$1"><i class="fas fa-trash"></i></button>','id_peternakan');
        return $this->datatables->generate();
    }
    public function update($id)
    {
        $data = [
            'kodekoperasi' => htmlspecialchars($this->input->post('kodekoperasi')),
            'kodekelompok' => htmlspecialchars($this->input->post('kodekelompok')),
            'namapeternakan' => htmlspecialchars($this->input->post('nmpeternakan')),
            'alamat' => htmlspecialchars($this->input->post('alpeternakan')),
            'notelp' => htmlspecialchars($this->input->post('notelp')),
            'nosiup' => htmlspecialchars($this->input->post('nosiup')),
            'tglberdiri' => htmlspecialchars($this->input->post('tglberdiri')),
            'namapeternak' => htmlspecialchars($this->input->post('pemilik')),
            'kodekecamatan' => htmlspecialchars($this->input->post('kecamatan')),
            'kodekabupaten' => htmlspecialchars($this->input->post('kabupaten')),
            'kodepropinsi' => htmlspecialchars($this->input->post('propinsi')),
            'user_id' => $this->input->post('user_id')
        ];
        $this->db->where('id_peternakan',$id);
        $this->db->update('peternakan',$data);

    }
    public function delete($id)
    {
        $this->db->where('id_peternakan',$id);
        $this->db->delete('peternakan');
    }
    public function datasingel($id)
    {
        $this->db->where('id_peternakan',$id);
        $this->db->select('peternakan.*,kelompok.namakelompok,koperasi.namakoperasi');
        $this->db->from('peternakan');
        $this->db->join('kelompok','kelompok.kodekelompok = peternakan.kodekelompok');
        $this->db->join('koperasi','koperasi.kodekoperasi = peternakan.kodekoperasi');
         $hasil = $this->db->get();
         return $hasil->row();
    }
    public function datacetak($id = null)
    {
        $this->db->select('peternakan.*,koperasi.namakoperasi,kelompok.namakelompok,wil_propinsi.namapropinsi,wil_kabupaten.namakabupaten,wil_kecamatan.namakecamatan');
        $this->db->from('peternakan');
        if($id != null){
            $this->db->where('id_peternakan',$id);
        }
        $this->db->join('kelompok','kelompok.kodekelompok = peternakan.kodekelompok');
        $this->db->join('koperasi','koperasi.kodekoperasi = peternakan.kodekoperasi');
        $this->db->join('wil_propinsi','wil_propinsi.kodepropinsi = peternakan.kodepropinsi','left');
        $this->db->join('wil_kabupaten','wil_kabupaten.kodepropinsi = peternakan.kodepropinsi AND wil_kabupaten.kodekabupaten = peternakan.kodekabupaten','left');
        $this->db->join('wil_kecamatan','wil_kecamatan.kodepropinsi = peternakan.kodepropinsi AND wil_kecamatan.kodekabupaten = peternakan.kodekabupaten AND wil_kecamatan.kodekecamatan = peternakan.kodekecamatan','left');
        $hasil = $this->db->get();
        return $hasil;
    }
}