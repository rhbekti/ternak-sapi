<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_pengeringan extends CI_Model
{
    public function get_all()
    {
        $sql = $this->db->query('SELECT reproduksi_pkb.idpkb,reproduksi_pkb.idsapi,sapi.tagsapi,sapi.namasapi FROM reproduksi_pkb JOIN sapi ON reproduksi_pkb.idsapi = sapi.idsapi WHERE DATE_ADD(tanggal,INTERVAL 280 DAY) <= DATE(NOW()) AND hasil = "P"');
        return $sql->result();
    }
}
