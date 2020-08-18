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
    public function insert()
    {
        $jenis = htmlspecialchars($this->input->post('jenisreproduksi'));
        if($jenis == 'IB'){
            $sapi = htmlspecialchars($this->input->post('idsapi'));
            $this->db->where('idsapi',$sapi);
            $query = $this->db->get('reproduksi_ib');
            if($query->num_rows() > 0){
                $data = $query->row();
                $perbarui = [
                    'idpetugas' => htmlspecialchars($this->input->post('idpetugas')),
                    'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
                    'ibke' => $data->ibke + 1,
                ];
                $this->db->where('idsapi',$sapi);
                $sql = $this->db->update('reproduksi_ib',$perbarui);
            }else{
            $data = [
                'idib' => '',
                'idsapi' => $sapi,
                'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
                'ibke' => 1,
                'kodesemen' => htmlspecialchars($this->input->post('kodesemen')),
                'is_bunting' => 0,
                'is_lahir' => 0,
                'idpetugas' => htmlspecialchars($this->input->post('idpetugas')),
                'keterangan' => htmlspecialchars($this->input->post('keterangan'))
            ];
            $sql = $this->db->insert('reproduksi_ib',$data);
        }
            if($this->db->affected_rows($sql) > 0){
                $this->session->set_flashdata('info','Data Berhasil Ditambahkan');
            }else{
                $this->session->set_flashdata('info','Data Gagal Ditambahkan');
            }
        }else{
            $data = [
                'idtransfer' => '',
                'idsapirecipient' => htmlspecialchars($this->input->post('idsapi')),
                'idsapidonor' => htmlspecialchars($this->input->post('idsapijantan')),
                'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
                'idpetugas' => htmlspecialchars($this->input->post('idpetugas'))
            ];
            $sql = $this->db->insert('reproduksi_et',$data);
            if($this->db->affected_rows($sql) > 0){
                $this->session->set_flashdata('info','Data Berhasil Ditambahkan');
            }else{
                $this->session->set_flashdata('info','Data Gagal Ditambahkan');
            }
        }
    }
}