<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Dosen extends CI_Model
{

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('tb_dosen');
        $this->db->order_by('nama');

        return $this->db->get()->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert('tb_dosen', $data);
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_dosen', $data);
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('tb_dosen', ['id' => $id]);
    }

    public function multiple_delete($id)
    {
        $this->db->where_in('id', $id);
        $this->db->delete('tb_dosen');
    }
}