<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_reproduksi extends CI_Model
{
    public function get_ib($id = null)
    {
        if ($id != null) {
            $this->db->where('idib', $id);
        }
        return $this->db->get('reproduksi_pkb');
    }
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
    public function get_all_pkb($post)
    {
        $sql = $this->db->query('SELECT DATE_ADD(tanggal, INTERVAL "' . $post . '" DAY) as tanggal,DATE_ADD(tanggal,INTERVAL 10 DAY) as tglakhir,idib,reproduksi_ib.idsapi as kdsapi,status_ternak,ibke,sapi.namasapi,sapi.tagsapi FROM reproduksi_ib JOIN sapi ON reproduksi_ib.idsapi = sapi.idsapi WHERE DATE_ADD(tanggal,INTERVAL "' . $post . '" DAY) <= DATE(NOW())');
        return $sql;
    }
    public function get_json_pkb()
    {
        $this->datatables->select('idpkb,reproduksi_pkb.idsapi,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,hasil,reproduksi_pkb.status,sapi.tagsapi,reproduksi_pkb.idpetugas,petugas.nama,sapi.idfarm,peternakan.namapeternakan,reproduksi_pkb.idib');
        $this->datatables->from('reproduksi_pkb');
        $this->datatables->join('sapi', 'sapi.idsapi = reproduksi_pkb.idsapi');
        $this->datatables->join('petugas', 'petugas.idpetugas = reproduksi_pkb.idpetugas', 'left');
        $this->datatables->join('peternakan', 'sapi.idfarm = peternakan.id_peternakan');
        return $this->datatables->generate();
    }
    public function get_data_lahir()
    {
        $this->db->select('idpkb,reproduksi_pkb.idsapi,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,hasil,reproduksi_pkb.status as stsapi,sapi.tagsapi,reproduksi_pkb.idpetugas,petugas.nama,sapi.idfarm,peternakan.namapeternakan,reproduksi_pkb.idib,concat(substr(tglmulai,9,2),"-",substr(tglmulai,6,2),"-",substr(tglmulai,1,4)) as tglmulai,concat(substr(tglakhir,9,2),"-",substr(tglakhir,6,2),"-",substr(tglakhir,1,4)) as tglakhir');
        $this->db->from('reproduksi_pkb');
        $this->db->join('sapi', 'sapi.idsapi = reproduksi_pkb.idsapi');
        $this->db->join('petugas', 'petugas.idpetugas = reproduksi_pkb.idpetugas', 'left');
        $this->db->join('peternakan', 'sapi.idfarm = peternakan.id_peternakan');
        $this->db->join('reproduksi_pengeringan', 'reproduksi_pengeringan.idsapi = reproduksi_pkb.idsapi', 'left');
        $this->db->where('reproduksi_pkb.status', 2);
        return $this->db->get();
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
            $this->session->set_flashdata('info', ' Berhasil Ditambahkan');
        } else {
            $this->session->set_flashdata('pesan', ' Gagal Ditambahkan');
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
            $this->session->set_flashdata('info', ' Berhasil diHapus');
        } else {
            $this->session->set_flashdata('info', ' Gagal diHapus');
        }
    }
    public function delete_et($post)
    {
        $this->db->where('idtransfer', $post);
        $sql = $this->db->delete('reproduksi_et');
        if ($this->db->affected_rows($sql) > 0) {
            $this->session->set_flashdata('info', ' Berhasil diHapus');
        } else {
            $this->session->set_flashdata('info', ' Gagal diHapus');
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
    public function update_ib($post)
    {
        $data = [
            'status_ternak' => 1
        ];
        $this->db->where('idib', $post);
        $this->db->update('reproduksi_ib', $data);
    }
    public function insert_pkb($post)
    {
        if ($post['hasil'] == 'P') {
            $post['status'] = 1;
            $data = [
                'is_bunting' => 1
            ];
            $this->db->where('idib', $post['idib']);
            $this->db->update('reproduksi_ib', $data);
        } else {
            $post['status'] = 0;
        }
        $data = [
            'idpkb' => '',
            'idsapi' => htmlspecialchars($post['idsapi']),
            'tanggal' => date('Y-m-d H:i:s', strtotime($post['tanggal'])),
            'idpetugas' => htmlspecialchars($post['idpetugas']),
            'hasil' => $post['hasil'],
            'tglinput' => $post['tglinput'],
            'idib' => $post['idib'],
            'status' => $post['status'],
            'keterangan' => htmlspecialchars($post['keterangan'])
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
