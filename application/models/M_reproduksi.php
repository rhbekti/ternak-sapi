<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_reproduksi extends CI_Model
{
    public function get_json_ib()
    {
        $this->datatables->select('idib,tanggal,reproduksi_ib.idsapi as kodesapi,ibke,keterangan,intensitas_birahi as intensitas,petugas.nama as namapetugas,sapi.namasapi,semen.namasemen');
        $this->datatables->from('reproduksi_ib');
        $this->datatables->add_column('edit','<form action="'.site_url('/Reproduksi_IB/edit').'" method="post"><button class="btn btn-warning" name="idib" value="$1"><i class="fas fa-pen"></i></button></form>','idib');
        $this->datatables->add_column('hapus','<button id="btnHapus" class="btn btn-danger" data-idib="$1"><i class="fas fa-trash"></i></button>','idib');
        $this->datatables->add_column('tambah','<button class="btn-tambah btn btn-success" data-idib="$1" data-idsapi="$2" data-namasapi="$3"><i class="fas fa-plus"></i></button>','idib,kodesapi,namasapi');
        $this->datatables->join('sapi','sapi.idsapi = reproduksi_ib.idsapi','left');
        $this->datatables->join('semen','semen.kodesemen = reproduksi_ib.kodesemen','left');
        $this->datatables->join('petugas','petugas.idpetugas = reproduksi_ib.idpetugas','left');
        return $this->datatables->generate();
    }
    public function get_json_et()
    {
        $this->datatables->select('idtransfer,idsapidonor,tanggal,keterangan,petugas.nama as namapetugas,sapi.namasapi as betina');
        $this->datatables->from('reproduksi_et');
        $this->datatables->join('sapi','sapi.idsapi = reproduksi_et.idsapirecipient');
        $this->datatables->join('petugas','petugas.idpetugas = reproduksi_et.idpetugas','left');
        $this->datatables->add_column('hapus','<button id="btnHapus" class="btn btn-danger" data-idtransfer="$1"><i class="fas fa-trash"></i></button>','idtransfer');
        return $this->datatables->generate();
    }
    public function get_pkb($id = null)
    {
        $this->db->select('idpkb,idib,reproduksi_pkb.idsapi as kdsapi,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,reproduksi_pkb.idpetugas as kdpetugas,hasil,keterangan,reproduksi_pkb.status as st,sapi.namasapi,petugas as nama');
        if($id != null){
            $this->db->where('idpkb',$id);
        }
        $this->db->join('sapi','sapi.idsapi = reproduksi_pkb.idsapi','left');
        // $this->db->join('petugas','petugas.idpetugas = reproduksi_pkb.idpetugas','left');
        return $this->db->get('reproduksi_pkb');
    }
    public function get_json_pkb()
    {
        $this->datatables->select('idpkb,petugas,concat(substr(tanggal,9,2),"-",substr(tanggal,6,2),"-",substr(tanggal,1,4)) as tanggal,hasil,keterangan,reproduksi_pkb.status as st,sapi.namasapi');
        $this->datatables->from('reproduksi_pkb');
        $this->datatables->join('sapi','sapi.idsapi = reproduksi_pkb.idsapi','left');
        $this->datatables->add_column('edit','<form action="'.site_url('/Pkb/edit').'" method="post"><button name="idpkb" value="$1" class="btn btn-warning"><i class="fas fa-edit"></i></button></form>','idpkb');
        $this->datatables->add_column('hapus','<button class="btn-hapus btn btn-danger" data-idpkb="$1"><i class="fas fa-trash"></i></button>','idpkb');
        $this->datatables->add_column('tambah','<button class="btn-tambah btn btn-primary" data-idpkb="$1" data-namasapi="$2"><i class="fas fa-plus"></i></button>','idpkb,namasapi');
        return $this->datatables->generate();
    }
    public function insert($idpetugas)
    {
        $jenis = htmlspecialchars($this->input->post('jenisreproduksi'));
        if($jenis == 'IB'){
            $data = [
                'idib' => '',
                'idsapi' => htmlspecialchars($this->input->post('idsapi')),
                'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
                'ibke' => htmlspecialchars($this->input->post('ibke')),
                'kodesemen' => htmlspecialchars($this->input->post('kodesemen')),
                'intensitas_birahi' => htmlspecialchars($this->input->post('intensitas')),
                'is_bunting' => 0,
                'is_lahir' => 0,
                'idpetugas' => $idpetugas,
                'keterangan' => htmlspecialchars($this->input->post('keterangan'))
            ];
            $sql = $this->db->insert('reproduksi_ib',$data);
            if($this->db->affected_rows($sql) > 0){
                $this->session->set_flashdata('info','Data Berhasil Ditambahkan');
            }else{
                $this->session->set_flashdata('pesan','Data Gagal Ditambahkan');
            }
            redirect('/Reproduksi_IB');
        }else{
            $data = [
                'idtransfer' => '',
                'idsapirecipient' => htmlspecialchars($this->input->post('idsapi')),
                'idsapidonor' => htmlspecialchars($this->input->post('idsapijantan')),
                'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
                'keterangan' => htmlspecialchars($this->input->post('keterangan')),
                'idpetugas' => $idpetugas
            ];
            $sql = $this->db->insert('reproduksi_et',$data);
            if($this->db->affected_rows($sql) > 0){
                $this->session->set_flashdata('info','Data Berhasil Ditambahkan');
            }else{
                $this->session->set_flashdata('pesan','Data Gagal Ditambahkan');
            }
            redirect('/Reproduksi_ET');
        }
    }
    public function delete_ib($post)
    {
        $this->db->where('idib',$post);
        $sql = $this->db->delete('reproduksi_ib');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Data Berhasil diHapus');
        }else{
            $this->session->set_flashdata('info','Data Gagal diHapus');
        }
    }
    public function delete_et($post)
    {
        $this->db->where('idtransfer',$post);
        $sql = $this->db->delete('reproduksi_et');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Data Berhasil diHapus');
        }else{
            $this->session->set_flashdata('info','Data Gagal diHapus');
        }
    }
    public function delete_pkb($post)
    {
        $this->db->where('idpkb',$post['idpkb']);
        $sql = $this->db->delete('reproduksi_pkb');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Data Berhasil diHapus');
        }else{
            $this->session->set_flashdata('info','Data Gagal diHapus');
        }
    }
    public function insert_pkb($post)
    {
        $data = [
            'idpkb' => '',
            'idsapi' => htmlspecialchars($this->input->post('idsapi')),
            'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
            'idpetugas' => htmlspecialchars($this->input->post('idpetugas')),
            'hasil' => $this->input->post('hasil'),
            'tglinput' => date('Y-m-d'),
            'idib' => $this->input->post('idib'),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        ];
        $sql = $this->db->insert('reproduksi_pkb',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Data Berhasil Ditambahkan');
        }else{
            $this->session->set_flashdata('pesan','Data Gagal Ditambahkan');
        }
        
    }
    public function edit_pkb($post)
    {
        $data = [
            'idsapi' => htmlspecialchars($this->input->post('idsapi')),
            'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
            'idpetugas' => htmlspecialchars($this->input->post('idpetugas')),
            'hasil' => $this->input->post('hasil'),
            'tglinput' => date('Y-m-d'),
            'idib' => $this->input->post('idib'),
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        ];
        $this->db->where('idpkb',$post['idpkb']);
        $sql = $this->db->update('reproduksi_pkb',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Data Berhasil Di Perbarui');
        }else{
            $this->session->set_flashdata('pesan','Data Gagal Di Perbarui');
        }
    }
}