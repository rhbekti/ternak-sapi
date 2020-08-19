<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_reproduksi extends CI_Model
{
    public function get_json_ib()
    {
        $this->datatables->select('idib,tanggal,ibke,keterangan,intensitas_birahi as intensitas,petugas.nama as namapetugas,sapi.namasapi,semen.namasemen');
        $this->datatables->from('reproduksi_ib');
        $this->datatables->add_column('edit','<form action="'.site_url('/Reproduksi_IB/edit').'" method="post"><button class="btn btn-warning" name="idib" value="$1"><i class="fas fa-pen"></i></button></form>','idib');
        $this->datatables->add_column('hapus','<button id="btnHapus" class="btn btn-danger" data-idib="$1"><i class="fas fa-trash"></i></button>','idib');
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
}