<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Mahasiswa extends CI_Model
{

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('tb_mahasiswa');
        $this->db->order_by('nim');

        return $this->db->get()->result_array();
    }

    public function getOne($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get('tb_mahasiswa')->result_array();
    }

    public function tambah($data)
    {
        $this->db->insert('tb_mahasiswa', $data);
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_mahasiswa', $data);
    }

    public function resetPassword($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tb_mahasiswa', $data);
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('tb_mahasiswa', ['id' => $id]);
    }
    public function multiple_delete($id)
    {
        foreach ($id as $id_new) {
            $this->db->where('id', $id_new);
            $data = $this->db->get('tb_mahasiswa')->result_array();

            if ($data[0]['foto'] != "default.jpg") {
                unlink(FCPATH . 'assets/uploads/profile/' . $data[0]['foto']);
            }
        }

        $this->db->where_in('id', $id);
        $this->db->delete('tb_mahasiswa');
    }
}