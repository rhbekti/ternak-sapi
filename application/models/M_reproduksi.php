<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_reproduksi extends CI_Model
{
    public function get_json_ib()
    {
        $this->datatables->select('idib,tanggal,kodesemen,ibke,keterangan,intensitas_birahi as intensitas,petugas.nama as namapetugas,sapi.namasapi');
        $this->datatables->from('reproduksi_ib');
        $this->datatables->add_column('edit','<form action="'.site_url('/Reproduksi_IB/edit').'" method="post"><button class="btn btn-warning" name="idib" value="$1"><i class="fas fa-pen"></i></button></form>','idib');
        $this->datatables->add_column('hapus','<button id="btnHapus" class="btn btn-danger" data-idib="$1"><i class="fas fa-trash"></i></button>','idib');
        $this->datatables->join('sapi','sapi.idsapi = reproduksi_ib.idsapi','left');
        $this->datatables->join('petugas','petugas.idpetugas = reproduksi_ib.idpetugas','left');
        return $this->datatables->generate();
    }
}