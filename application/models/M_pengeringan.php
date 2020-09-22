<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pengeringan extends CI_Model
{
    public function get_all()
    {
        $sql = $this->db->query('SELECT reproduksi_pkb.idpkb,reproduksi_pkb.status,reproduksi_pkb.idib,DATE_ADD(tanggal,INTERVAL 280 DAY) as tanggal,reproduksi_pkb.idsapi,sapi.tagsapi,sapi.namasapi FROM reproduksi_pkb JOIN sapi ON reproduksi_pkb.idsapi = sapi.idsapi WHERE DATE_ADD(tanggal,INTERVAL 280 DAY) <= DATE(NOW()) AND hasil = "P"');
        return $sql->result();
    }
    public function get_json()
    {
        $this->datatables->select('idpengeringan,concat(substr(tglmulai,9,2),"-",substr(tglmulai,6,2),"-",substr(tglmulai,1,4)) as tglmulai,concat(substr(tglakhir,9,2),"-",substr(tglakhir,6,2),"-",substr(tglakhir,1,4)) as tglakhir,keterangan,sapi.tagsapi');
        $this->datatables->from('reproduksi_pengeringan');
        $this->datatables->join('sapi', 'sapi.idsapi = reproduksi_pengeringan.idsapi');
        return $this->datatables->generate();
    }
    public function insert_pengeringan($post, $pkb)
    {
        $sql = $this->db->insert('reproduksi_pengeringan', $post);
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Berhasil di Input');
            // $this->db->where('idpkb', $pkb);
            // $this->db->delete('reproduksi_pkb');
        } else {
            $this->session->set_flashdata('info', 'Gagal di Input');
        }
    }
    public function set_pengeringan($post)
    {
        $data = [
            'awal_pengeringan' => htmlspecialchars($post['tglawal']),
            'akhir_pengeringan' => htmlspecialchars($post['tglakhir'])
        ];
        $this->db->where('id', 1);
        $sql = $this->db->update('set_pengeringan', $data);
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Berhasil di Perbarui');
        } else {
            $this->session->set_flashdata('info', 'Gagal di Perbarui');
        }
    }
    public function update_status($post)
    {
        $data = [
            'status' => 2
        ];
        $this->db->where('idpkb', $post['idpkb']);
        $this->db->update('reproduksi_pkb', $data);
    }
}
