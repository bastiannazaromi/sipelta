<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Laporan_pdf extends CI_Model
{

    public function getAll($where)
    {
        $this->db->select('tb_laporan_pdf.id, tb_laporan_pdf.nim, tb_laporan_pdf.nama_laporan_pdf, tb_laporan_pdf.status, tb_laporan_pdf.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_laporan_pdf');
        $this->db->join('tb_mahasiswa', 'tb_laporan_pdf.nim = tb_mahasiswa.nim', 'left');
        if ($where)
        {
            $this->db->where($where);
        }
        
        $this->db->order_by('tb_laporan_pdf.create_at', 'desc');

        return $this->db->get()->result_array();
    }

    public function getOne($nim)
    {
        $this->db->where('nim', $nim);
        return $this->db->get('tb_laporan_pdf')->result_array();
    }

    public function edit($data)
    {
        $this->db->where('id', $this->input->post('id', TRUE));
        $this->db->update('tb_laporan_pdf', $data);
    }

    public function hapus($id)
    {
        // $this->db->where('id', $id);
        $this->db->where('id', $id);
        $data = $this->db->get('tb_laporan_pdf')->result_array();

        unlink(FCPATH . 'assets/uploads/laporan_pdf/' . $data[0]['nama_laporan_pdf']);

        $this->db->delete('tb_laporan_pdf', ['id' => $id]);
    }

    public function multiple_delete($id)
    {
        foreach ($id as $id_new) {
            $this->db->where('id', $id_new);
            $data = $this->db->get('tb_laporan_pdf')->result_array();

            unlink(FCPATH . 'assets/uploads/laporan_pdf/' . $data[0]['nama_laporan_pdf']);
        }
        $this->db->where_in('id', $id);
        $this->db->delete('tb_laporan_pdf');
    }

    public function gruptahun()
    {
        $this->db->select('tahun');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'ASC');
        
        return $this->db->get('tb_mahasiswa')->result_array();
        
    }
}