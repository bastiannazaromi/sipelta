<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dsn extends CI_Model {

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from('tb_dosen');
        $this->db->order_by('nama');

        return $this->db->get()->result_array();
    }

    public function getOne($id)
    {
        $this->db->select('*');
        $this->db->from('tb_dosen');
        $this->db->where('id', $id);

        return $this->db->get()->row_array();
    }
    
    public function getMhs($nama, $where)
    { 
        if ($where)
        {
            $this->db->where($where);
        }

        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
         
        $this->db->order_by('nim');
        $data = $this->db->get('tb_mahasiswa')->result_array();
        return $data;
    }    

    public function getJurnal($nama, $where)
    {   
        $this->db->select('tb_jurnal.id, tb_jurnal.nim, tb_jurnal.nama_jurnal, tb_jurnal.status, tb_jurnal.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_jurnal');
        $this->db->join('tb_mahasiswa', 'tb_jurnal.nim = tb_mahasiswa.nim', 'inner');
        if ($where)
        {
            $this->db->where($where);
        }
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();   
        $this->db->order_by('tb_jurnal.create_at', 'desc');

        return $this->db->get()->result_array();
    }

    public function getBrosur($nama, $where)
    {
        $this->db->select('tb_brosur.id, tb_brosur.nim, tb_brosur.nama_file, tb_brosur.status, tb_brosur.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_brosur');
        $this->db->join('tb_mahasiswa', 'tb_brosur.nim = tb_mahasiswa.nim', 'left');
        if ($where)
        {
            $this->db->where($where);
        }
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('tb_brosur.create_at', 'desc');

        return $this->db->get()->result_array();
    }

    public function getPersetujuan($nama, $where)
    {
        $this->db->select('tb_persetujuan.id, tb_persetujuan.nim, tb_persetujuan.nama_file, tb_persetujuan.status, tb_persetujuan.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_persetujuan');
        $this->db->join('tb_mahasiswa', 'tb_persetujuan.nim = tb_mahasiswa.nim', 'left');
        if ($where)
        {
            $this->db->where($where);
        }
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('tb_persetujuan.create_at', 'desc');

        return $this->db->get()->result_array();
    }

    public function getPengesahan($nama, $where)
    {
        $this->db->select('tb_pengesahan.id, tb_pengesahan.nim, tb_pengesahan.nama_file, tb_pengesahan.status, tb_pengesahan.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_pengesahan');
        $this->db->join('tb_mahasiswa', 'tb_pengesahan.nim = tb_mahasiswa.nim', 'left');
        if ($where)
        {
            $this->db->where($where);
        }
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('tb_pengesahan.create_at', 'desc');

        return $this->db->get()->result_array();
    }

    public function getProduk($nama, $where)
    {
        $this->db->select('tb_produk.id, tb_produk.nim, tb_produk.nama_file, tb_produk.status, tb_produk.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_produk');
        $this->db->join('tb_mahasiswa', 'tb_produk.nim = tb_mahasiswa.nim', 'left');
        if ($where)
        {
            $this->db->where($where);
        }
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('tb_produk.create_at', 'desc');

        return $this->db->get()->result_array();
    }

    public function getLapPdf($nama, $where)
    {
        $this->db->select('tb_laporan_pdf.id, tb_laporan_pdf.nim, tb_laporan_pdf.nama_laporan_pdf, tb_laporan_pdf.status, tb_laporan_pdf.create_at, tb_mahasiswa.nama, tb_mahasiswa.judul');
        $this->db->from('tb_laporan_pdf');
        $this->db->join('tb_mahasiswa', 'tb_laporan_pdf.nim = tb_mahasiswa.nim', 'left');
        if ($where)
        {
            $this->db->where($where);
        }
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('tb_laporan_pdf.create_at', 'desc');

        return $this->db->get()->result_array();
    }

    public function gruptahun()
    {
        $this->db->select('tahun');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'ASC');
        
        return $this->db->get('tb_mahasiswa')->result_array();
        
    }

    public function getKP($tahun, $nama)
    {
        $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama, tb_mahasiswa.no_telepon, tb_mahasiswa.email, tb_mahasiswa.semester, tb_laporan_pdf.nama_laporan_pdf, tb_pengesahan.nama_file as pengesahan');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_laporan_pdf', 'tb_laporan_pdf.nim = tb_mahasiswa.nim', 'left');
        $this->db->join('tb_pengesahan', 'tb_pengesahan.nim = tb_mahasiswa.nim', 'left');
        $this->db->where(['semester' => 4, 'tahun' => $tahun]);
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('nim', 'ASC');

        return $this->db->get()->result_array();
    }

    public function getTA($tahun, $nama)
    {
        $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama, tb_mahasiswa.no_telepon, tb_mahasiswa.email, tb_mahasiswa.semester, tb_laporan_pdf.nama_laporan_pdf, tb_pengesahan.nama_file as pengesahan, tb_persetujuan.nama_file as persetujuan, tb_brosur.nama_file as brosur, tb_produk.nama_file as produk, tb_jurnal.nama_jurnal as jurnal');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_laporan_pdf', 'tb_laporan_pdf.nim = tb_mahasiswa.nim', 'left');
        $this->db->join('tb_pengesahan', 'tb_pengesahan.nim = tb_mahasiswa.nim', 'left');
        $this->db->join('tb_persetujuan', 'tb_persetujuan.nim = tb_mahasiswa.nim', 'left');
        $this->db->join('tb_produk', 'tb_produk.nim = tb_mahasiswa.nim', 'left');
        $this->db->join('tb_brosur', 'tb_brosur.nim = tb_mahasiswa.nim', 'left');
        $this->db->join('tb_jurnal', 'tb_jurnal.nim = tb_mahasiswa.nim', 'left');
        $this->db->where(['semester' => 6, 'tahun' => $tahun]);
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('nim', 'ASC');

        return $this->db->get()->result_array();
    }

    public function getKPVerifikasi($tahun, $nama)
    {
        $this->db->select('tb_mahasiswa.nim, tb_mahasiswa.nama, tb_mahasiswa.no_telepon, tb_mahasiswa.email, tb_mahasiswa.semester, tb_mahasiswa.nama_instansi, tb_laporan_pdf.nama_laporan_pdf, tb_pengesahan.nama_file as pengesahan');
        $this->db->from('tb_mahasiswa');
        $this->db->join('tb_laporan_pdf', 'tb_laporan_pdf.nim = tb_mahasiswa.nim', 'inner');
        $this->db->join('tb_pengesahan', 'tb_pengesahan.nim = tb_mahasiswa.nim', 'inner');
        $this->db->where(['semester' => 4, 'tahun' => $tahun]);
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('tb_pengesahan.create_at', 'DESC');

        return $this->db->get()->result_array();
    }

    public function getTAverifikasi($tahun, $nama)
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
        $this->db->group_start();
        $this->db->where('dosbing_1', $nama);
        $this->db->or_where('dosbing_2', $nama);
        $this->db->group_end();
        $this->db->order_by('tb_jurnal.create_at', 'DESC');

        return $this->db->get()->result_array();
    }

}

/* End of file M_Dsn.php */