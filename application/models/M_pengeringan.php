<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pengeringan extends CI_Model
{
    public function get_json()
    {
        $this->datatables->select('idpengeringan,reproduksi_pengeringan.idsapi,concat(substr(tglmulai,9,2),"-",substr(tglmulai,6,2),"-",substr(tglmulai,1,4)) as tanggalmulai,concat(substr(tglakhir,9,2),"-",substr(tglakhir,6,2),"-",substr(tglakhir,1,4)) as tanggalakhir,idib,sapi.namasapi');
        $this->datatables->from('reproduksi_pengeringan');
        $this->datatables->join('sapi','sapi.idsapi = reproduksi_pengeringan.idsapi');
        return $this->datatables->generate();
    }
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('idpengeringan',$id);
        }
        $this->db->get('reproduksi_pengeringan');
    }
    public function insert_pengeringan($post)
    {
        $this->db->select('reproduksi_pkb.idsapi,reproduksi_pkb.idib as kdib,reproduksi_ib.tanggal');
        $this->db->from('reproduksi_pkb');
        $this->db->join('reproduksi_ib','reproduksi_ib.idib = reproduksi_pkb.idib');
        $data = $this->db->get()->row();
        $tgl = strtotime($data->tanggal);
        $set = $this->db->get('setting_pengeringan')->result();
        foreach($set as $row){
            $arr[] = $row->awal_pengeringan;
        }
        $tgl_pengeringan = 280 - $arr[0];
        $hasil = strtotime('+'.$tgl_pengeringan.' day',$tgl);
        $data = [
            'idsapi' => $data->idsapi,
            'tglmulai' =>  date('Y-m-d',$hasil),
            'idib' => $data->kdib
        ];
        $this->db->insert('reproduksi_pengeringan',$data);
    }
    public function delete_pk($post)
    {
        $this->db->where('idib',$post['idib']);
        $this->db->delete('reproduksi_pengeringan');
    }
}