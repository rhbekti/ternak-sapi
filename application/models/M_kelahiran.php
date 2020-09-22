<?php defined('BASEPATH') or exit('No direct script access allowed');
class M_kelahiran extends CI_Model
{

    public function get_data_json()
    {
        $this->datatables->select('idkelahiran,reproduksi_kelahiran.idfarm as kdpeternak,reproduksi_kelahiran.idsapi,sapi.namasapi,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,xlaktasi,statuslahir,keterangan,peternakan.namapeternakan,petugas.idpetugas as kdpetugas,petugas.nama');
        $this->datatables->from('reproduksi_kelahiran');
        $this->datatables->join('sapi', 'reproduksi_kelahiran.idsapi = sapi.idsapi');
        $this->datatables->join('petugas', 'petugas.idpetugas = reproduksi_kelahiran.idpetugas', 'left');
        $this->datatables->join('peternakan', 'peternakan.id_peternakan = reproduksi_kelahiran.idfarm', 'left');
        $this->datatables->add_column('edit', '<form action="' . site_url('/Kelahiran/edit') . '" method="post"><button class="btn btn-warning" name="idkelahiran" value="$1"><i class="fas fa-edit"></i></button></form>', 'idkelahiran');
        $this->datatables->add_column('hapus', '<button class="btn-hapus btn btn-danger" data-idkelahiran="$1"><i class="fas fa-trash"></i></button>', 'idkelahiran');
        return $this->datatables->generate();
    }
    public function delete($post)
    {
        $this->db->delete('reproduksi_kelahiran', ['idkelahiran' => $post]);
    }
    public function insert_data($post)
    {
        $this->db->insert('reproduksi_kelahiran', $post);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil di simpan');
        } else {
            $this->session->set_flashdata('info', 'Data gagal di simpan');
        }
    }
    public function get($id = null)
    {
        if ($id != null) {
            $this->db->select('idkelahiran,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,keterangan,reproduksi_kelahiran.idsapi,xlaktasi,reproduksi_kelahiran.idfarm,sapi.namasapi,statuslahir,reproduksi_kelahiran.idpetugas,petugas.nama as namapetugas,idib');
            $this->db->join('sapi', 'sapi.idsapi = reproduksi_kelahiran.idsapi');
            $this->db->join('petugas', 'petugas.idpetugas = reproduksi_kelahiran.idpetugas', 'left');
            return $this->db->get_where('reproduksi_kelahiran', ['idkelahiran' => $id]);
        } else {
            return $this->db->get('reproduksi_kelahiran');
        }
    }
    public function update_data($post)
    {
        $data = [
            'tanggal' => htmlspecialchars(date('Y-m-d', strtotime($post['tanggal']))),
            'idsapi' => htmlspecialchars($post['idsapi']),
            'statuslahir' => htmlspecialchars($post['statuslahir']),
            'xlaktasi' => htmlspecialchars($post['xlaktasi']),
            'tglinput' => htmlspecialchars($post['tglinput']),
            'keterangan' => htmlspecialchars($post['keterangan']),
            'idpetugas' => htmlspecialchars($post['idpetugas']),
            'idib' => htmlspecialchars($post['idib'])
        ];
        $this->db->where('idkelahiran', $post['idkelahiran']);
        $this->db->update('reproduksi_kelahiran', $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('info', 'Data Berhasil di perbarui');
        } else {
            $this->session->set_flashdata('info', 'Data gagal di perbarui');
        }
    }
    public function update_status($post)
    {
        $data = [
            'status' => 3
        ];
        $this->db->where('idpkb', $post);
        $this->db->update('reproduksi_pkb', $data);
    }
}
