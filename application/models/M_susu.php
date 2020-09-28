<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_susu extends CI_Model
{
    public function get_json()
    {
        $this->datatables->select('idpengukuran,pengukuran_produksisusu.idsapi as kdsapi,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,pagi,sore,kandang.idkandang,kandang.namakandang,xlaktasi,sapi.namasapi,sapi.tagsapi');
        $this->datatables->from('pengukuran_produksisusu');
        $this->datatables->join('sapi', 'sapi.idsapi = pengukuran_produksisusu.idsapi', 'left');
        $this->datatables->join('kandang', 'kandang.idkandang = pengukuran_produksisusu.kandang', 'left');
        $this->datatables->add_column('edit', '<button type="button" class="btn-edit btn btn-warning btn-sm" data-idpengukuran="$1" data-tagsapi="$2" data-idsapi="$3" data-idkandang="$4" data-tglsusu="$5" data-xlaktasi="$6" data-pagi="$7" data-sore="$8"><i class="fas fa-pen"></i></button>', 'idpengukuran,tagsapi,kdsapi,idkandang,tanggal,xlaktasi,pagi,sore');
        $this->datatables->add_column('hapus', '<button type="button" class="btn btn-danger btn-sm" id="btnhapus" data-idpengukuran="$1"><i class="fas fa-trash"></i></button>', 'idpengukuran');
        return $this->datatables->generate();
    }
    public function get($id = null)
    {
        if ($id != null) {
            $this->db->where('idpengukuran', $id);
        }
        $this->db->join('kandang', 'pengukuran_produksisusu.kandang = kandang.idkandang', 'left');
        $this->db->join('sapi', 'sapi.idsapi = pengukuran_produksisusu.idpengukuran', 'left');
        return $this->db->get('pengukuran_produksisusu');
    }
    public function insert($post)
    {
        $data = [
            'idsapi' => htmlspecialchars($post['idsapi']),
            'tanggal' => date('Y-m-d', strtotime($post['tanggal'])),
            'pagi' => htmlspecialchars($post['pagi']),
            'sore' => htmlspecialchars($post['sore']),
            'kandang' => htmlspecialchars($post['kandang']),
            'xlaktasi' => htmlspecialchars($post['xlaktasi']),
            'tglinput' => date('Y-m-d H:i:s')
        ];
        $sql = $this->db->insert('pengukuran_produksisusu', $data);
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Berhasil di Tambah');
        } else {
            $this->session->set_flashdata('info', 'Gagal Ditambah');
        }
    }
    public function update($post)
    {
        $data = [
            'idsapi' => htmlspecialchars($post['idsapi_edit']),
            'tanggal' => date('Y-m-d', strtotime($post['tanggal_edit'])),
            'pagi' => htmlspecialchars($post['pagi_edit']),
            'sore' => htmlspecialchars($post['sore_edit']),
            'kandang' => htmlspecialchars($post['kandang_edit']),
            'xlaktasi' => htmlspecialchars($post['xlaktasi_edit']),
            'tglinput' => date('Y-m-d H:i:s')
        ];
        $this->db->where('idpengukuran', $post['idpengukuran']);
        $sql = $this->db->update('pengukuran_produksisusu', $data);
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Berhasil di Perbarui');
        } else {
            $this->session->set_flashdata('info', 'Gagal di Perbarui');
        }
    }
    public function delete($post)
    {
        $this->db->where('idpengukuran', $post);
        $sql = $this->db->delete('pengukuran_produksisusu');
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Berhasil di Dihapus');
        } else {
            $this->session->set_flashdata('info', 'Gagal DiHapus');
        }
    }
}
