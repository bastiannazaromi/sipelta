<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_File extends CI_Model
{

    public function insert($data)
    {
        $this->db->insert('tbfile', $data);
    }
}