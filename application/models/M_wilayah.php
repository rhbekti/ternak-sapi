<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_wilayah extends CI_Model
{
    public function get_propinsi($id = null)
    {
        if($id != null){
            $this->db->where('kodepropinsi',$id);
        }
        return $this->db->get('wil_propinsi');
    }
    public function get_kabupaten($id)
    {
        $this->db->where('kodepropinsi',$id);
        $hasil = $this->db->get('wil_kabupaten');
        return $hasil->result();
    }
    public function get_kecamatan($id)
    {
        $this->db->where('kodepropinsi',$id);
        $hasil = $this->db->get('wil_kecamatan');
        return $hasil->result();
    }
    public function get_kecubah($id,$rh)
    {
        // $this->db->query("SELECT * FROM wil_kecamatan WHERE kodepropinsi='$id' AND kodekabupaten='$rh'");
        $data = ['kodepropinsi'=> $id,'kodekabupaten' => $rh];
        $this->db->where($data);
        $hasil = $this->db->get('wil_kecamatan');
        return $hasil->result();
    }
}