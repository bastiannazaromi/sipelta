<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Verifikasi extends CI_Model {

    public function getKP($tahun)
    {
        $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama, tb_mahasiswa.no_telepon, tb_mahasiswa.email, tb_mahasiswa.semester, tb_mahasiswa.nama_instansi, tb_laporan_pdf.nama_laporan_pdf, tb_pengesahan.nama_file as pengesahan');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_laporan_pdf', 'tb_laporan_pdf.nim = tb_mahasiswa.nim', 'inner');
        $this->db->join('tb_pengesahan', 'tb_pengesahan.nim = tb_mahasiswa.nim', 'inner');
        $this->db->where(['semester' => 4, 'tahun' => $tahun]);
        $this->db->order_by('tb_pengesahan.create_at', 'DESC');

        return $this->db->get()->result_array();
    }

    public function getTA($tahun)
    {
        $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama, tb_mahasiswa.no_telepon, tb_mahasiswa.email, tb_mahasiswa.semester, tb_mahasiswa.judul, tb_laporan_pdf.nama_laporan_pdf, tb_pengesahan.nama_file as pengesahan, tb_persetujuan.nama_file as persetujuan, tb_brosur.nama_file as brosur, tb_produk.nama_file as produk, tb_jurnal.nama_jurnal as jurnal');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_laporan_pdf', 'tb_laporan_pdf.nim = tb_mahasiswa.nim', 'inner');
        $this->db->join('tb_pengesahan', 'tb_pengesahan.nim = tb_mahasiswa.nim', 'inner');
        $this->db->join('tb_persetujuan', 'tb_persetujuan.nim = tb_mahasiswa.nim', 'inner');
        $this->db->join('tb_produk', 'tb_produk.nim = tb_mahasiswa.nim', 'inner');
        $this->db->join('tb_brosur', 'tb_brosur.nim = tb_mahasiswa.nim', 'inner');
        $this->db->join('tb_jurnal', 'tb_jurnal.nim = tb_mahasiswa.nim', 'inner');
        $this->db->where(['semester' => 6, 'tahun' => $tahun]);
        $this->db->order_by('tb_jurnal.create_at', 'DESC');

        return $this->db->get()->result_array();
    }

    public function gruptahun()
    {
        $this->db->select('tahun');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'ASC');
        
        return $this->db->get('tb_mahasiswa')->result_array();
        
    }

}

/* End of file M_verifikasi.php */