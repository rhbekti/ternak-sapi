<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ternak extends CI_Model
{
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('idsapi');
        }
        return $this->db->get('sapi');
    }
    public function get_json()
    {
        $this->datatables->select('idsapi,tagsapi,namasapi,kelamin,idfarm,status,bangsa.nama_bangsa');
        $this->datatables->from('sapi');
        $this->datatables->add_column('edit','<form action="'.site_url('/Sapi/edit').'" method="post"><button name="idsapi" class="btn btn-warning" value="$1"><i class="fas fa-pen"></i></button></form>','idsapi');
        $this->datatables->add_column('hapus','<button id="btnHapus" class="btn btn-danger" data-idsapi="$1"><i class="fas fa-trash"></i></button>','idsapi');
        $this->datatables->join('bangsa','bangsa.id_bangsa = sapi.idbangsa');
        return $this->datatables->generate();
    }
} 