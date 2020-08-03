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
            'nosiup' => htmlspecialchars($this->input->post('nosiup'))+date("H:m:s"),
            'tglberdiri' => htmlspecialchars($this->input->post('tglberdiri')),
            'namapeternak' => htmlspecialchars($this->input->post('pemilik')),
            'kodekecamatan' => htmlspecialchars($this->input->post('kecamatan')),
            'kodekabupaten' => htmlspecialchars($this->input->post('kabupaten')),
            'kodepropinsi' => htmlspecialchars($this->input->post('propinsi')),
            'user_id' => $this->input->post('user_id')
        ];
        $this->db->insert('peternakan',$data);
    }
}