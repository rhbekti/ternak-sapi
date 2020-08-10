<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ternak extends CI_Model
{
    public function get($id = null)
    {
        if($id != null){
            $this->db->where('idsapi',$id);
        }
        // $this->db->join('bangsa');
        return $this->db->get('sapi');
    }
    public function get_json()
    {
        $this->datatables->select('idsapi,tagsapi,namasapi,kelamin,idfarm,tipesapi,status,bangsa.nama_bangsa');
        $this->datatables->from('sapi');
        $this->datatables->add_column('edit','<form action="'.site_url('/Sapi/edit').'" method="post"><button name="idsapi" class="btn btn-warning" value="$1"><i class="fas fa-pen"></i></button></form>','idsapi');
        $this->datatables->add_column('hapus','<button id="btnHapus" class="btn btn-danger" data-idsapi="$1"><i class="fas fa-trash"></i></button>','idsapi');
        $this->datatables->join('bangsa','bangsa.id_bangsa = sapi.idbangsa');
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
            'kelamin' => $this->input->post('kelamin'),
            'idbangsa' => $this->input->post('bangsa'),
            'tipesapi' => $this->input->post('tipeternak'),
            'status' => $this->input->post('status'),
            'is_uzur' => $this->input->post('uzur'),
            'is_balai' => $this->input->post('balai'),
            'bobotlahir' => $this->input->post('bobot'),
            'tglinput' => $this->input->post('tglinput')
        ];
        $this->db->where('idsapi',$id);
        $sql = $this->db->update('sapi',$data);
        if($this->db->affected_rows($sql) > 0){
            $this->session->set_flashdata('info','Berhasil di Perbarui');
        }else{
            $this->session->set_flashdata('info','Gagal di Perbarui');
        }
    }
} 