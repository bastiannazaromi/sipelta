<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_About extends CI_Model
{

    public function getAll()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('tb_about')->result_array();
    }

    public function getOne($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tb_about')->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert('tb_about', $data);
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_about', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_about', ['id' => $id]);
    }
}