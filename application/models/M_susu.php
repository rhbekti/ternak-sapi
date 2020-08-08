<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_susu extends CI_Model
{
    // public function get_json()
    // {
    //     $this->datatables->select('id_susu,id_sapi,tgl_produksi,pagi,sore,kandang,xlaktasi');
    //     $this->datatables->from('susu');
    //     $this->datatables->add_column('edit','<form action="'.site_url('/peternakan/edit').'" method="post"> <button class="btn btn-warning" name="id_susu" value="$1"><i class="fas fa-pen"></i></button></form>','id_susu');
    //     $this->datatables->add_column('qrcode','s','id_susu');
    //     $this->datatables->add_column('hapus','<button class="btn btn-danger" id="hapusdata" data-idsusu="$1"><i class="fas fa-trash"></i></button>','id_susu');
    //     return $this->datatables->generate();
    // }
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('id_susu',$id);
        }
        $this->db->join('peternakan','peternakan.id_peternakan = susu.peternakan','left');
        $this->db->join('sapi','sapi.idsapi = susu.id_sapi','left');
        return $this->db->get('susu');
    }
}