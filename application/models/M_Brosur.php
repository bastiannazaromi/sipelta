<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Brosur extends CI_Model
{

    public function getAll($where)
    {
        $this->db->select('tb_brosur.id, tb_brosur.nim, tb_brosur.nama_file, tb_brosur.status, tb_brosur.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_brosur');
        $this->db->join('tb_mahasiswa', 'tb_brosur.nim = tb_mahasiswa.nim', 'left');
        if ($where)
        {
            $this->db->where($where);
        }
        $this->db->order_by('tb_brosur.create_at', 'desc');

        return $this->db->get()->result_array();
    }

    public function getOne($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get('tb_brosur')->result_array();
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_brosur', $data);
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        $this->db->where('id', $id);
        $data = $this->db->get('tb_brosur')->result_array();

        unlink(FCPATH . 'assets/uploads/brosur/' . $data[0]['nama_file']);

        $this->db->delete('tb_brosur', ['id' => $id]);
    }

    public function multiple_delete($id)
    {
        foreach ($id as $id_new) {
            $this->db->where('id', $id_new);
            $data = $this->db->get('tb_brosur')->result_array();

            unlink(FCPATH . 'assets/uploads/brosur/' . $data[0]['nama_file']);
        }

        $this->db->where_in('id', $id);
        $this->db->delete('tb_brosur');
    }

    public function gruptahun()
    {
        $this->db->select('tahun');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'ASC');
        
        return $this->db->get('tb_mahasiswa')->result_array();
        
    }
}