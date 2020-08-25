<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Mahasiswa', 'mahasiswa');
        $this->load->model('M_Jurnal', 'jurnal');
        $this->load->model('M_Laporan_pdf', 'laporan_pdf');
        $this->load->model('M_Lembar_produk', 'lembar_produk');
        $this->load->model('M_Pengesahan', 'pengesahan');
        $this->load->model('M_Persetujuan', 'persetujuan');
        $this->load->model('M_Brosur', 'brosur');

        $this->load->model('M_Admin', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Verifikasi File';
        $data['page'] = 'admin/backend/verifikasi';

        $data['mahasiswa'] = $this->mahasiswa->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function cek_file($nim)
    {
        $data['title'] = 'Verifikasi File';
        $data['page'] = 'admin/backend/cek_file';

        $jurnal = $this->jurnal->getOne($nim);
        $laporan_pdf = $this->laporan_pdf->getOne($nim);
        $lembar_produk = $this->lembar_produk->getOne($nim);
        $pengesahan = $this->pengesahan->getOne($nim);
        $persetujuan = $this->persetujuan->getOne($nim);
        $brosur = $this->brosur->getOne($nim);

        if ($jurnal) {
            $j_jurnal = $jurnal[0]['nama_jurnal'];
            $s_jurnal = $jurnal[0]['status'];
        } else {
            $j_jurnal = null;
            $s_jurnal = null;
        }
        if ($laporan_pdf) {
            $j_lap_pdf = $laporan_pdf[0]['nama_laporan_pdf'];
            $s_lap_pdf = $laporan_pdf[0]['status'];
        } else {
            $j_lap_pdf = null;
            $s_lap_pdf = null;
        }
        if ($lembar_produk) {
            $j_produk = $lembar_produk[0]['nama_file'];
            $s_produk = $lembar_produk[0]['status'];
        } else {
            $j_produk = null;
            $s_produk = null;
        }
        if ($pengesahan) {
            $j_pengesahan = $pengesahan[0]['nama_file'];
            $s_pengesahan = $pengesahan[0]['status'];
        } else {
            $j_pengesahan = null;
            $s_pengesahan = null;
        }
        if ($persetujuan) {
            $j_persetujuan = $persetujuan[0]['nama_file'];
            $s_persetujuan = $persetujuan[0]['status'];
        } else {
            $j_persetujuan = null;
            $s_persetujuan = null;
        }
        if ($brosur) {
            $j_brosur = $brosur[0]['nama_file'];
            $s_brosur = $brosur[0]['status'];
        } else {
            $j_brosur = null;
            $s_brosur = null;
        }

        $data['berkas'] = [
            "0" => [
                "berkas" => 'jurnal',
                "judul"  => $j_jurnal,
                "status" => $s_jurnal
            ],
            "1" => [
                "berkas" => 'laporan_pdf',
                "judul"  => $j_lap_pdf,
                "status" => $s_lap_pdf
            ],
            "2" => [
                "berkas" => 'lembar_produk',
                "judul"  => $j_produk,
                "status" => $s_produk
            ],
            "3" => [
                "berkas" => 'pengesahan',
                "judul"  => $j_pengesahan,
                "status" => $s_pengesahan
            ],
            "4" => [
                "berkas" => 'persetujuan',
                "judul"  => $j_persetujuan,
                "status" => $s_persetujuan
            ],
            "5" => [
                "berkas" => 'brosur',
                "judul"  => $j_brosur,
                "status" => $s_brosur
            ]
        ];

        $data['nim'] = $nim;

        $this->load->view('admin/backend/index', $data);
    }

    public function update()
    {
        $nim = $this->input->post('nim');
        $tabel = $this->input->post('tabel');
        $status = $this->input->post('status');

        $data = [
            'status' => $status
        ];

        $this->db->where('nim', $nim);
        $this->db->update($tabel, $data);
    }
}