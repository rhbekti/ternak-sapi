<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_level extends CI_Model
{
    public function get()
    {
        return $this->db->get('level');
    }
}