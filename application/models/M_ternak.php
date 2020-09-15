<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ternak extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('idsapi,tagsapi,namasapi,kelamin,tgllahir,bobotlahir,idbangsa,is_uzur,is_kso,is_balai,is_vbc,tipesapi,status,sapi.idfarm,sapi.idkandang,bangsa.nama_bangsa,peternakan.namapeternakan,kandang.namakandang');
        if($id != null){
            $this->db->where('idsapi',$id);
        }
        $this->db->join('bangsa','bangsa.id_bangsa = sapi.idbangsa');
        $this->db->join('peternakan','peternakan.id_peternakan = sapi.idfarm','left');
        $this->db->join('kandang','kandang.idkandang = sapi.idkandang','left');
        return $this->db->get('sapi');
    }
    public function get_sapi_betina()
    {
        // SELECT * FROM sapi join reproduksi_ib ON sapi.idsapi = reproduksi_ib.idsapi WHERE kelamin = 'betina'
        // $data = $this->db->query("SELECT * FROM sapi join reproduksi_ib ON sapi.idsapi = reproduksi_ib.idsapi WHERE kelamin = 'betina'");
        $this->db->select('sapi.idsapi as kdsapi,namasapi,tagsapi,kelamin,idib,ibke,peternakan.namapeternakan');
        $this->db->join('reproduksi_ib','sapi.idsapi = reproduksi_ib.idsapi','left');
        $this->db->join('peternakan','peternakan.id_peternakan = sapi.idfarm','left');
        return $this->db->get_where('sapi',['kelamin' => 'Betina'])->result();
    }
    public function get_sapi_jantan()
    {
        // SELECT * FROM sapi join reproduksi_ib ON sapi.idsapi = reproduksi_ib.idsapi WHERE kelamin = 'betina'
        // $data = $this->db->query("SELECT * FROM sapi join reproduksi_ib ON sapi.idsapi = reproduksi_ib.idsapi WHERE kelamin = 'betina'");
        $this->db->select('sapi.idsapi as kdsapi,namasapi,tagsapi,kelamin,peternakan.namapeternakan');
        $this->db->join('peternakan','peternakan.id_peternakan = sapi.idfarm','left');
        return $this->db->get_where('sapi',['kelamin' => 'Jantan'])->result();
    }
    public function get_json()
    {
        $this->datatables->select('idsapi,tagsapi,namasapi,kelamin,tipesapi,status,sapi.idfarm,sapi.idkandang,bangsa.nama_bangsa,peternakan.namapeternakan,kandang.namakandang');
        $this->datatables->from('sapi');
        $this->datatables->add_column('edit','<form action="'.site_url('/Sapi/edit').'" method="post"><button name="idsapi" class="btn btn-warning" value="$1"><i class="fas fa-pen"></i></button></form>','idsapi');
        $this->datatables->add_column('hapus','<button id="btnHapus" class="btn btn-danger" data-idsapi="$1"><i class="fas fa-trash"></i></button>','idsapi');
        $this->datatables->add_column('tambah','<button id="pilihternak" class="btn btn-success" data-idsapi="$1" data-nmsapi="$4" data-idpeternakan="$2" data-namapeternakan="$3" data-idkandang="$6" data-nmkandang="$5"><i class="fas fa-plus-circle"></i></button>','idsapi,idfarm,namapeternakan,namasapi,namakandang,idkandang');
        $this->datatables->add_column('tambahjantan','<button id="pilihternakjantan" class="btn btn-success" data-idsapi="$1" data-nmsapi="$4" data-idpeternakan="$2" data-namapeternakan="$3" data-idkandang="$6" data-nmkandang="$5"><i class="fas fa-plus-circle"></i></button>','idsapi,idfarm,namapeternakan,namasapi,namakandang,idkandang');
        $this->datatables->join('bangsa','bangsa.id_bangsa = sapi.idbangsa');
        $this->datatables->join('kandang','kandang.idkandang = sapi.idkandang','left');
        $this->datatables->join('peternakan','peternakan.id_peternakan = sapi.idfarm','left');
        return $this->datatables->generate();
    }
    // fungsi mendapatkan bangsa ternak
    public function get_bangsa()
    {
      return $this->db->get('bangsa');
    }
    public function insert()
    {
        $data = [
            'idsapi' => '',
            'idfarm' => htmlspecialchars($this->input->post('idpeternakan')),
            'tagsapi' => htmlspecialchars($this->input->post('tagsapi')),
            'idbangsa' => htmlspecialchars($this->input->post('bangsa')),
            'kelamin' => htmlspecialchars($this->input->post('kelamin')),
            'tipesapi' => htmlspecialchars($this->input->post('tipeternak')),
            'namasapi' => htmlspecialchars($this->input->post('namasapi')),
            'tgllahir' => htmlspecialchars(date('Y-m-d',strtotime($this->input->post('tgllahir')))).' ' .htmlspecialchars(date('H:i:s',strtotime($this->input->post('waktulahir')))),
            'bobotlahir' => htmlspecialchars($this->input->post('bobotlahir')),
            'status' => htmlspecialchars($this->input->post('status')),
            'idkandang' => htmlspecialchars($this->input->post('idkandang')),
            'is_uzur' => htmlspecialchars($this->input->post('uzur')),
            'is_kso' => htmlspecialchars($this->input->post('kso')),
            'is_balai' => htmlspecialchars($this->input->post('balai')),
            'is_vbc' => htmlspecialchars($this->input->post('vbc')),
            'statuspc' => htmlspecialchars($this->input->post('statuspc')),
            'statuspc' => htmlspecialchars($this->input->post('statuspc')),
            'tglinput' => htmlspecialchars($this->input->post('tglinput'))
        ];
        $sql = $this->db->insert('sapi',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Simpan');
        }else{
            $this->session->set_flashdata('info','Gagal di Simpan');
        }
    }
    public function delete($id)
    {
        $this->db->where('idsapi',$id);
        $sql =$this->db->delete('sapi');
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Hapus');
        }else{
            $this->session->set_flashdata('info','Gagal di Hapus');
        }
    } 
    public function update($id)
    {
       
        $data = [
            'tagsapi' => $this->input->post('tagsapi'),
            'namasapi' => $this->input->post('namasapi'),
            'tgllahir' => htmlspecialchars(date('Y-m-d',strtotime($this->input->post('tgllahirternak')))).' ' .htmlspecialchars(date('H:i:s',strtotime($this->input->post('waktulahirsapi')))),
            'kelamin' => $this->input->post('kelamin'),
            'idbangsa' => $this->input->post('bangsa'),
            'tipesapi' => $this->input->post('tipeternak'),
            'status' => $this->input->post('status'),
            'is_uzur' => $this->input->post('uzur'),
            'is_balai' => $this->input->post('balai'),
            'bobotlahir' => $this->input->post('bobot'),
            'tglinput' => $this->input->post('tglinput'),
            'idfarm' => $this->input->post('idpeternakan'),
            'idkandang' => $this->input->post('idkandang'),
        ];
        
        $this->db->where('idsapi',$id);
        $sql = $this->db->update('sapi',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Perbarui');
        }else{
            $this->session->set_flashdata('info','Gagal di Perbarui');
        }
    }
    public function get_pilih($id)
    {
        $this->db->where('idfarm',$id);
        return $this->db->get('sapi');
    }
    public function validasi_tag($post)
    {
        $this->db->like('tagsapi',$post,'both');
        return $this->db->get('sapi');
    }
} 