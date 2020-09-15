<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_reproduksi extends CI_Model
{
    public function get_json_ib()
    {
        $this->datatables->select('idib,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,reproduksi_ib.idsapi as kodesapi,ibke,keterangan,intensitas_birahi as intensitas,petugas.nama as namapetugas,sapi.namasapi,semen.namasemen');
        $this->datatables->from('reproduksi_ib');
        $this->datatables->add_column('edit', '<form action="' . site_url('/Reproduksi_IB/edit') . '" method="post"><button class="btn btn-warning" name="idib" value="$1"><i class="fas fa-pen"></i></button></form>', 'idib');
        $this->datatables->add_column('hapus', '<button id="btnHapus" class="btn btn-danger" data-idib="$1"><i class="fas fa-trash"></i></button>', 'idib');
        $this->datatables->add_column('tambah', '<button class="btn-tambah btn btn-success" data-idib="$1" data-idsapi="$2" data-namasapi="$3"><i class="fas fa-plus"></i></button>', 'idib,kodesapi,namasapi');
        $this->datatables->join('sapi', 'sapi.idsapi = reproduksi_ib.idsapi', 'left');
        $this->datatables->join('semen', 'semen.kodesemen = reproduksi_ib.kodesemen', 'left');
        $this->datatables->join('petugas', 'petugas.idpetugas = reproduksi_ib.idpetugas', 'left');
        return $this->datatables->generate();
    }
    public function get_json_et()
    {
        $this->datatables->select('idtransfer,idsapidonor,tanggal,keterangan,sapi.namasapi as betina');
        $this->datatables->from('reproduksi_et');
        $this->datatables->join('sapi', 'sapi.idsapi = reproduksi_et.idsapirecipient', 'left');
        $this->datatables->add_column('hapus', '<button class="btnHapus btn btn-danger" data-idtransfer="$1"><i class="fas fa-trash"></i></button>', 'idtransfer');
        return $this->datatables->generate();
    }
    public function get_pkb($id = null)
    {
        $this->db->select('idpkb,idib,reproduksi_pkb.idsapi as kdsapi,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,reproduksi_pkb.idpetugas as kdpetugas,hasil,keterangan,reproduksi_pkb.status as st,sapi.namasapi,petugas as nama');
        if ($id != null) {
            $this->db->where('idpkb', $id);
        }
        $this->db->join('sapi', 'sapi.idsapi = reproduksi_pkb.idsapi', 'left');
        // $this->db->join('petugas','petugas.idpetugas = reproduksi_pkb.idpetugas','left');
        return $this->db->get('reproduksi_pkb');
    }
    public function get_json_pkb()
    {
        $sql = $this->db->query('SELECT DATE_ADD(tanggal, INTERVAL 60 DAY) as tanggal,idib,reproduksi_ib.idsapi as kdsapi,status_ternak,ibke,sapi.namasapi,sapi.tagsapi FROM reproduksi_ib JOIN sapi ON reproduksi_ib.idsapi = sapi.idsapi WHERE DATE_ADD(tanggal,INTERVAL 60 DAY) <= DATE(NOW())');
        return $sql;
    }
    public function insert_ib($idpetugas, $post)
    {

        $data = [
            'idib' => '',
            'idsapi' => htmlspecialchars($post['sapibetina']),
            'tanggal' => date('Y-m-d', strtotime($post['tanggal'])),
            'ibke' => htmlspecialchars($post['ibke']),
            'kodesemen' => htmlspecialchars($post['kodesemen']),
            'intensitas_birahi' => htmlspecialchars($post['intensitas']),
            'is_bunting' => 0,
            'status_ternak' => 0,
            'is_lahir' => 0,
            'idpetugas' => $idpetugas,
            'keterangan' => htmlspecialchars($post['keterangan'])
        ];
        $sql = $this->db->insert('reproduksi_ib', $data);
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil Ditambahkan');
        } else {
            $this->session->set_flashdata('pesan', 'Data Gagal Ditambahkan');
        }
    }
    public function insert_et()
    {
        $data = [
            'idtransfer' => '',
            'idsapirecipient' => htmlspecialchars($this->input->post('idsapibetina')),
            'idsapidonor' => htmlspecialchars($this->input->post('idsapijantan')),
            'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
            'keterangan' => htmlspecialchars($this->input->post('keterangan')),
            'idpetugas' => htmlspecialchars($this->input->post('idpetugas'))
        ];
        $sql = $this->db->insert('reproduksi_et', $data);
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil Ditambahkan');
        } else {
            $this->session->set_flashdata('pesan', 'Data Gagal Ditambahkan');
        }
    }
    public function delete_ib($post)
    {
        $this->db->where('idib', $post);
        $sql = $this->db->delete('reproduksi_ib');
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil diHapus');
        } else {
            $this->session->set_flashdata('info', 'Data Gagal diHapus');
        }
    }
    public function delete_et($post)
    {
        $this->db->where('idtransfer', $post);
        $sql = $this->db->delete('reproduksi_et');
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil diHapus');
        } else {
            $this->session->set_flashdata('info', 'Data Gagal diHapus');
        }
    }
    public function delete_pkb($post)
    {
        $this->db->where('idpkb', $post['idpkb']);
        $sql = $this->db->delete('reproduksi_pkb');
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil diHapus');
        } else {
            $this->session->set_flashdata('info', 'Data Gagal diHapus');
        }
    }
    public function insert_pkb($post)
    {
        $data = [
            'idpkb' => '',
            'idsapi' => htmlspecialchars($this->input->post('idsapi')),
            'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
            'idpetugas' => htmlspecialchars($this->input->post('idpetugas')),
            'hasil' => $this->input->post('hasil'),
            'tglinput' => date('Y-m-d'),
            'idib' => $this->input->post('idib'),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        ];
        $sql = $this->db->insert('reproduksi_pkb', $data);
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil Ditambahkan');
        } else {
            $this->session->set_flashdata('pesan', 'Data Gagal Ditambahkan');
        }
    }
    public function update_status_sapi($post)
    {
        $data = [
            'is_bunting' => 1
        ];
        $this->db->where('idib', $post['idib']);
        $this->db->update('reproduksi_ib', $data);
    }
    public function edit_pkb($post)
    {
        $data = [
            'idsapi' => htmlspecialchars($this->input->post('idsapi')),
            'tanggal' => date('Y-m-d', strtotime($this->input->post('tanggal'))),
            'idpetugas' => htmlspecialchars($this->input->post('idpetugas')),
            'hasil' => $this->input->post('hasil'),
            'tglinput' => date('Y-m-d'),
            'idib' => $this->input->post('idib'),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        ];
        $this->db->where('idpkb', $post['idpkb']);
        $sql = $this->db->update('reproduksi_pkb', $data);
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil Di Perbarui');
        } else {
            $this->session->set_flashdata('pesan', 'Data Gagal Di Perbarui');
        }
    }
}
