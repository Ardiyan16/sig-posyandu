<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_map extends CI_Model
{
    public function lokasi_user($id)
    {
        $this->db->where('id', $id);
        $this->db->get('user')->row();
    }
}