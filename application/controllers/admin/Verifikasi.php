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

        $this->u2		= $this->uri->segment(2);
        $this->u3		= $this->uri->segment(3);
        $this->u4		= $this->uri->segment(4);
        $this->u5		= $this->uri->segment(5);
        $this->u6		= $this->uri->segment(6);
        $this->u7		= $this->uri->segment(7);

        $this->load->model('M_Mahasiswa', 'mahasiswa');
        $this->load->model('M_Jurnal', 'jurnal');
        $this->load->model('M_Laporan_pdf', 'laporan_pdf');
        $this->load->model('M_Lembar_produk', 'lembar_produk');
        $this->load->model('M_Pengesahan', 'pengesahan');
        $this->load->model('M_Persetujuan', 'persetujuan');
        $this->load->model('M_Brosur', 'brosur');
        $this->load->model('M_Mahasiswa', 'mahasiswa');
        $this->load->model('M_Verifikasi', 'verifikasi');

        $this->load->model('M_Admin', 'admin');
    }

    public function index()
    {
        if ($this->u5 == '')
        {
            $tahun = $this->_tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u5);
        }

        $semester = dekrip($this->u4);

        $data['title'] = 'Verifikasi File';
        $data['page'] = 'admin/backend/verifikasi';
        $data['semester']   = $this->u4;
        $data['tahun']      = $this->verifikasi->grupTahun();

        if ($semester == 4)
        {
            $data['mahasiswa'] = $this->verifikasi->getKP($tahun);
        }
        else{
            $data['mahasiswa'] = $this->verifikasi->getTA($tahun);
        }

        $this->load->view('admin/backend/index', $data);
    }

    public function cek_file($nim)
    {
        $this->data['title'] = 'Verifikasi File';
        $this->data['page'] = 'admin/backend/cek_file';
        $this->data['nim'] = $nim;

        $mhs = $this->mahasiswa->getOne(dekrip($nim));

        if ($mhs[0]['semester'] == 6)
        {
            $this->_cekfileTA(dekrip($nim));
        }

        else
        {
            $this->_cekfileKP(dekrip($nim));
        }

        $this->load->view('admin/backend/index', $this->data);
    }

    private function _cekfileTA($nim)
    {
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

        $this->data['berkas'] = [
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
    }

    private function _cekfileKP($nim)
    {
        $laporan_pdf = $this->laporan_pdf->getOne($nim);
        $pengesahan = $this->pengesahan->getOne($nim);
        
        if ($laporan_pdf) {
            $j_lap_pdf = $laporan_pdf[0]['nama_laporan_pdf'];
            $s_lap_pdf = $laporan_pdf[0]['status'];
        } else {
            $j_lap_pdf = null;
            $s_lap_pdf = null;
        }
        if ($pengesahan) {
            $j_pengesahan = $pengesahan[0]['nama_file'];
            $s_pengesahan = $pengesahan[0]['status'];
        } else {
            $j_pengesahan = null;
            $s_pengesahan = null;
        }
        
        $this->data['berkas'] = [
            "0" => [
                "berkas" => 'laporan_pdf',
                "judul"  => $j_lap_pdf,
                "status" => $s_lap_pdf
            ],
            "1" => [
                "berkas" => 'pengesahan',
                "judul"  => $j_pengesahan,
                "status" => $s_pengesahan
            ]
        ];
    }

    public function update()
    {
        $nim = dekrip($this->input->post('nim'));
        $tabel = $this->input->post('tabel');
        $status = $this->input->post('status');

        $data = [
            'status' => $status
        ];

        $update = [
            'nim' => $nim,
            'tabel' => $tabel,
            'status' => $status
        ];

        $this->db->where('nim', $nim);
        $this->db->update($tabel, $data);

        echo json_encode($this->security->get_csrf_hash());
    }

    private function _tahunAkademik()
    {
        $time = strtotime("-1 year", time());
        $date = date("Y", $time);

        return $date . "/" . date('Y');
    }
}