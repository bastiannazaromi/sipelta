<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Jurnal extends CI_Model
{

    public function getAll()
    {
        $this->db->select('tb_jurnal.id, tb_jurnal.nim, tb_jurnal.nama_jurnal, tb_jurnal.status, tb_jurnal.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_jurnal');
        $this->db->join('tb_mahasiswa', 'tb_jurnal.nim = tb_mahasiswa.nim', 'left');
        $this->db->order_by('status', 'desc');

        return $this->db->get()->result_array();
    }

    public function getOne($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get('tb_jurnal')->result_array();
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_jurnal', $data);
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        $this->db->where('id', $id);
        $data = $this->db->get('tb_jurnal')->result_array();

        unlink(FCPATH . 'assets/uploads/jurnal/' . $data[0]['nama_jurnal']);

        $this->db->delete('tb_jurnal', ['id' => $id]);
    }

    public function multiple_delete($id)
    {
        foreach ($id as $id_new) {
            $this->db->where('id', $id_new);
            $data = $this->db->get('tb_jurnal')->result_array();

            unlink(FCPATH . 'assets/uploads/jurnal/' . $data[0]['nama_jurnal']);
        }

        $this->db->where_in('id', $id);
        $this->db->delete('tb_jurnal');
    }
}