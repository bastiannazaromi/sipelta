<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Lembar_produk extends CI_Model
{
    public function getAll()
    {
        $this->db->select('tb_produk.id, tb_produk.nim, tb_produk.nama_file, tb_produk.status, tb_produk.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_produk');
        $this->db->join('tb_mahasiswa', 'tb_produk.nim = tb_mahasiswa.nim', 'left');
        $this->db->order_by('status', 'desc');

        return $this->db->get()->result_array();
    }

    public function getOne($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get('tb_produk')->result_array();
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_produk', $data);
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        $this->db->where('id', $id);
        $data = $this->db->get('tb_produk')->result_array();

        unlink(FCPATH . 'assets/uploads/lembar_produk/' . $data[0]['nama_file']);

        $this->db->delete('tb_produk', ['id' => $id]);
    }

    public function multiple_delete($id)
    {
        foreach ($id as $id_new) {
            $this->db->where('id', $id_new);
            $data = $this->db->get('tb_produk')->result_array();

            unlink(FCPATH . 'assets/uploads/lembar_produk/' . $data[0]['nama_file']);
        }

        $this->db->where_in('id', $id);
        $this->db->delete('tb_produk');
    }
}