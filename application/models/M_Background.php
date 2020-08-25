<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Background extends CI_Model
{

    public function getAll()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('tb_bg')->result_array();
    }

    public function getHeader()
    {
        $this->db->where('id', 1);
        return $this->db->get('tb_bg')->result_array();
    }

    public function getContent()
    {
        $this->db->where('id !=', 1);

        return $this->db->get('tb_bg')->result_array();
    }

    public function getOne($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tb_bg')->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert('tb_bg', $data);
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_bg', $data);
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        $this->db->where('id', $id);
        $bg = $this->db->get('tb_bg')->result_array();

        unlink(FCPATH . 'assets/uploads/bg/' . $bg[0]['bg']);

        $this->db->delete('tb_bg', ['id' => $id]);
    }
}