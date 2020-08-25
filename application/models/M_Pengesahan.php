<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pengesahan extends CI_Model
{

    public function getAll()
    {
        $this->db->select('tb_pengesahan.id, tb_pengesahan.nim, tb_pengesahan.nama_file, tb_pengesahan.status, tb_pengesahan.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_pengesahan');
        $this->db->join('tb_mahasiswa', 'tb_pengesahan.nim = tb_mahasiswa.nim', 'left');
        $this->db->order_by('status', 'desc');

        return $this->db->get()->result_array();
    }

    public function getOne($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get('tb_pengesahan')->result_array();
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_pengesahan', $data);
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        $this->db->where('id', $id);
        $data = $this->db->get('tb_pengesahan')->result_array();

        unlink(FCPATH . 'assets/uploads/pengesahan/' . $data[0]['nama_file']);

        $this->db->delete('tb_pengesahan', ['id' => $id]);
    }

    public function multiple_delete($id)
    {
        foreach ($id as $id_new) {
            $this->db->where('id', $id_new);
            $data = $this->db->get('tb_pengesahan')->result_array();

            unlink(FCPATH . 'assets/uploads/pengesahan/' . $data[0]['nama_file']);
        }

        $this->db->where_in('id', $id);
        $this->db->delete('tb_pengesahan');
    }
}