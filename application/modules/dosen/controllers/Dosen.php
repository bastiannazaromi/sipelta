<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('dosen_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('dosen/login', 'refresh');
        }

        $this->u2        = $this->uri->segment(2);
        $this->u3        = $this->uri->segment(3);
        $this->u4        = $this->uri->segment(4);
        $this->u5        = $this->uri->segment(5);
        $this->u6        = $this->uri->segment(6);
        $this->u7        = $this->uri->segment(7);

        $this->load->model('M_Jurnal', 'jurnal');
        $this->load->model('M_Laporan_pdf', 'laporan_pdf');
        $this->load->model('M_Lembar_produk', 'lembar_produk');
        $this->load->model('M_Pengesahan', 'pengesahan');
        $this->load->model('M_Persetujuan', 'persetujuan');
        $this->load->model('M_Mahasiswa', 'mahasiswa');
        $this->load->model('M_Brosur', 'brosur');
        $this->load->model('M_Dsn', 'dosen');
        $this->load->model('M_Universal', 'universal');

        $this->load->library('pdf');

        $this->nama = $this->session->userdata('nama');
        $this->nipy = $this->session->userdata('nipy');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Dosen';
        $data['page'] = 'dashboard';

        $data['mahasiswa'] = count($this->dosen->getMhs($this->nama, ['semester' => 4]));

        // echo $this->nama; die();

        $this->load->view('index', $data);
    }

    public function mahasiswa()
    {
        $data['title'] = 'List Mahasiswa';
        $data['page'] = 'mahasiswa';

        if ($this->u4 != '') {
            $tahun = dekrip($this->u4);
        } else {
            $tahun = tahunAkademik();
        }

        $data['mahasiswa'] = $this->dosen->getMhs($this->nama, ['semester' => dekrip($this->u3), 'tahun' => $tahun]);
        $data['semester'] = $this->u3;
        $data['tahun']    = $this->dosen->gruptahun($this->nama);
        $data['th_ini'] = $tahun;

        $this->session->set_userdata('previous_url', current_url());
        $this->load->view('index', $data);
    }

    public function jurnal()
    {
        $data['title']      = 'List Jurnal PDF';
        $data['page']       = 'jurnal';
        $data['tahun']      = $this->dosen->gruptahun($this->nama);

        if ($this->u3 == '') {
            $tahun = tahunAkademik();
        } else {
            $tahun = dekrip($this->u3);
        }

        $data['jurnal'] = $this->dosen->getJurnal($this->nama, ['tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function laporan_pdf()
    {
        $data['title']      = 'List Laporan PDF';
        $data['page']       = 'laporan_pdf';
        $data['tahun']      = $this->dosen->gruptahun($this->nama);
        $data['kategori']   = $this->u3;

        if ($this->u4 == '') {
            $tahun = tahunAkademik();
        } else {
            $tahun = dekrip($this->u4);
        }

        $data['laporan_pdf'] = $this->dosen->getLapPdf($this->nama, ['tb_laporan_pdf.kategori' => $this->u3, 'tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function lembar_produk()
    {
        $data['title']      = 'List Lembar Produk';
        $data['page']       = 'lembar_produk';
        $data['tahun']      = $this->dosen->gruptahun($this->nama);

        if ($this->u3 == '') {
            $tahun = tahunAkademik();
        } else {
            $tahun = dekrip($this->u3);
        }

        $data['lembar_produk'] = $this->dosen->getProduk($this->nama, ['tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function pengesahan()
    {
        $data['title']      = 'List Lembar Pengesahan';
        $data['page']       = 'pengesahan';
        $data['tahun']      = $this->dosen->gruptahun($this->nama);
        $data['kategori']   = $this->u3;

        if ($this->u4 == '') {
            $tahun = tahunAkademik();
        } else {
            $tahun = dekrip($this->u4);
        }

        $data['pengesahan'] = $this->dosen->getPengesahan($this->nama, ['tb_pengesahan.kategori' => $this->u3, 'tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function persetujuan()
    {
        $data['title']      = 'List Lembar Persetujuan';
        $data['page']       = 'persetujuan';
        $data['tahun']      = $this->dosen->gruptahun($this->nama);

        if ($this->u3 == '') {
            $tahun = tahunAkademik();
        } else {
            $tahun = dekrip($this->u3);
        }

        $data['persetujuan'] = $this->dosen->getPersetujuan($this->nama, ['tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function brosur()
    {
        $data['title']      = 'List Brosur';
        $data['page']       = 'brosur';
        $data['tahun']      = $this->dosen->gruptahun($this->nama);

        if ($this->u3 == '') {
            $tahun = tahunAkademik();
        } else {
            $tahun = dekrip($this->u3);
        }

        $data['brosur'] = $this->dosen->getbrosur($this->nama, ['tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function rekap()
    {
        $semester = dekrip($this->u3);
        if ($this->u4 == '') {
            $tahun  = tahunAkademik();
        } else {
            $tahun  = dekrip($this->u4);
        }

        $data['title']      = 'Rekap data upload berkas';
        $data['page']       = 'rekap';
        $data['semester']   = $this->u3;
        $data['tahun']      = $this->dosen->gruptahun($this->nama);

        if ($semester == 4) {
            $data['rekap']      = $this->dosen->getKP($tahun, $this->nama);
        } else {
            $data['rekap']      = $this->dosen->getTA($tahun, $this->nama);
        }

        $this->session->set_userdata('previous_url', current_url());
        $this->load->view('index', $data);
    }

    public function verifikasi()
    {
        if ($this->u4 == '') {
            $tahun = tahunAkademik();
        } else {
            $tahun = dekrip($this->u4);
        }

        $semester = dekrip($this->u3);

        $data['title']      = 'Verifikasi File';
        $data['page']       = 'verifikasi';
        $data['semester']   = $this->u3;
        $data['tahun']      = $this->dosen->gruptahun($this->nama);

        if ($semester == 4) {
            $data['mahasiswa'] = $this->dosen->getKPVerifikasi($tahun, $this->nama);
        } else {
            $data['mahasiswa'] = $this->dosen->getTAVerifikasi($tahun, $this->nama);
        }

        $this->load->view('index', $data);
    }

    public function cek_file($nim)
    {
        $this->data['title'] = 'Verifikasi File';
        $this->data['page'] = 'cek_file';

        $mhs = $this->universal->getOne(['nim' => dekrip($nim)], 'tb_mahasiswa');

        if ($mhs->semester == 6) {
            $this->_cekfileTA(dekrip($nim));
        } else {
            $this->_cekfileKP(dekrip($nim));
        }

        $this->load->view('index', $this->data);
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

    public function form()
    {
        $data['title'] = 'Form Download Berkas';
        $data['page'] = 'form';

        if ($this->u4 != '') {
            $tahun = dekrip($this->u4);
        } else {
            $tahun = tahunAkademik();
        }

        $data['mahasiswa'] = $this->dosen->getMhs($this->nama, ['semester' => dekrip($this->u3), 'tahun' => $tahun]);
        $data['semester'] = $this->u3;
        $data['tahun']    = $this->dosen->gruptahun($this->nama);
        $data['th_ini'] = $tahun;

        $this->load->view('index', $data);
    }

    public function beritaAcara()
    {
        $nim = dekrip($this->u3);

        if ($nim) {
            $mahasiswa = $this->universal->getOne(['nim' => $nim], 'tb_mahasiswa');

            $pdf = new FPDF('p', 'mm', 'A4');
            $pdf = new PDF_Dash();

            $pdf->AddPage();

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(190, 6, 'BERITA ACARA', 0, 1, 'C');
            $pdf->Cell(190, 6, 'PENYELENGGARAAN SUPERVISI KERJA PRAKTIK', 0, 1, 'C');
            $pdf->Cell(190, 6, 'TAHUN AKADEMIK ' . $mahasiswa->tahun, 0, 1, 'C');
            $pdf->Cell(190, 6, 'MAHASISWA POLITEKNIK HARAPAN BERSAMA TEGAL', 0, 1, 'C');

            $pdf->SetLineWidth(1);
            $pdf->Line(10, 35, 200, 35);
            $pdf->SetLineWidth(0);
            $pdf->Line(10, 36, 200, 36);

            $pdf->Ln(8);

            $pdf->SetFont('Times', '', 12);
            $deskripsi = 'Berdasarkan kalender akademik Prodi D-III Teknik Komputer Politeknik Harapan Bersama Tegal tahun akademik ' . $mahasiswa->tahun .  ' Telah diselenggarakan Supervisi Kerja Praktek';

            $pdf->MultiCell(193, 6, $deskripsi, 0, 1);

            $pdf->Ln(5);

            $pdf->Cell(35, 6, 'Pada instansi', 0, 0);
            $pdf->Cell(4, 6, ':', 0, 0);
            $pdf->Cell(2, 6, $mahasiswa->nama_instansi, 0, 1);
            $pdf->Cell(35, 6, 'Alamat', 0, 0);
            $pdf->Cell(4, 6, ':', 0, 0);
            $pdf->Cell(2, 6, $mahasiswa->alamat, 0, 1);
            $pdf->Cell(1, 13, 'Oleh Pembimbing KP D-III Teknik Komputer Politeknik Harapan Bersama Tegal.', 0, 1);
            $pdf->Cell(1, 5, 'Catatan selama pelaksanaan Kegiatan : ', 0, 1);

            $pdf->SetLineWidth(0.4);
            $pdf->SetDash(1, 1); //5mm on, 5mm off
            $pdf->Line(12, 94, 198, 94);
            $pdf->Line(12, 101, 198, 100);
            $pdf->Line(12, 108, 198, 108);
            $pdf->Line(12, 115, 198, 115);
            $pdf->Line(12, 122, 198, 122);
            $pdf->Line(12, 129, 198, 129);
            $pdf->Line(12, 136, 198, 136);

            $pdf->Ln(55);
            $demikian = 'Demikianlah berita acara ini kami buat dengan sebenar-benarnya dan dapat dipergunakan sebagaimana mestinya.';

            $pdf->MultiCell(193, 6, $demikian, 0, 1);

            $pdf->Ln(15);
            $pdf->Cell(125, 5, '', 0, 0);
            $pdf->Cell(13, 5, 'Tegal, ', 0, 0);
            $pdf->Cell(1, 5, tanggal_indo(), 0, 1);

            $pdf->Cell(125, 5, 'Perwakilan Mahasiswa', 0, 0);
            $pdf->Cell(1, 6, 'Pembimbing', 0, 1);
            $pdf->Cell(1, 5, '', 0, 1);
            $pdf->Cell(1, 5, '', 0, 1);
            $pdf->Cell(1, 5, '', 0, 1);
            $pdf->Cell(1, 5, '', 0, 1);
            $pdf->Cell(125, 5, $mahasiswa->nama, 0, 0);
            $pdf->Cell(1, 6, $mahasiswa->dosbing_1, 0, 1);

            $pdf->Ln(7);
            $pdf->Cell(70, 5, '', 0, 0);
            $pdf->Cell(1, 5, 'Mengetahui,', 0, 1);
            $pdf->Cell(70, 5, '', 0, 0);
            $pdf->Cell(1, 5, 'Kepala Instansi Kerja Praktek', 0, 1);
            $pdf->Ln(25);
            $pdf->Cell(70, 5, '', 0, 0);
            $pdf->Cell(1, 5, '(.............................................)', 0, 1);

            $pdf->Output($mahasiswa->nim . '_berita_acara.pdf', 'I');
        }
    }

    public function k_kp()
    {
        $nim = dekrip($this->u3);

        if ($nim) {
            $mahasiswa = $this->universal->getOne(['nim' => $nim], 'tb_mahasiswa');

            $pdf = new FPDF('p', 'mm', 'A4');
            $pdf = new PDF_Dash();

            $pdf->AddPage();

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Image('assets/uploads/poltek.png', 11, 10, 20, 20);

            $pdf->Cell(30, 6, '');
            $pdf->Cell(1, 6, 'SUPERVISI KERJA PRAKTIK', 0, 1);
            $pdf->Cell(30, 6, '');
            $pdf->Cell(1, 6, 'SEMESTER GANJIL THN. AKADEMIK 2017/2018', 0, 1);
            $pdf->Cell(30, 6, '');
            $pdf->Cell(105, 6, 'POLITEKNIK HARAPAN BERSAMA TEGAL', 0, 0);
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(10, 6, 'PM', 1, 0, 'C');
            $pdf->Cell(10, 6, 'P2M', 1, 0, 'C');
            $pdf->Cell(10, 6, 'PHB', 1, 0, 'C');
            $pdf->Cell(25, 6, '02.02.C.5.11', 1, 1, 'C');

            $pdf->SetLineWidth(1);
            $pdf->Line(41, 30, 200, 30);
            $pdf->SetLineWidth(0);
            $pdf->Line(41, 31, 200, 31);

            $pdf->Ln(5);

            $pdf->SetFont('Times', 'B', 12);

            $pdf->Cell(1, 6, '');
            $pdf->Cell(7, 6, '1.', 0, 0);
            $pdf->Cell(1, 6, 'IDENTITAS SUPERVISOR DAN MAHASISWA', 0, 1);

            $pdf->Ln(2);
            $pdf->Cell(8, 6, '');
            $pdf->SetFillColor(204, 204, 204);
            $pdf->MultiCell(91, 6, 'SUPERVISOR', 1, 'C', 1);
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos + 99, $yPos);

            $pdf->MultiCell(91, -6, 'MAHASISWA', 1, 'C', 1);

            $pdf->Cell(1, 6, '', 0, 1);

            $pdf->SetFont('Times', '', 11);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(35, 6, 'Nama Supervisor', 1, 0);
            $pdf->Cell(56, 6, $mahasiswa->dosbing_1, 1, 0);
            $pdf->Cell(35, 6, 'Nama mahasiswa', 1, 0);
            $pdf->Cell(56, 6, $mahasiswa->nama, 1, 1);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(35, 6, 'NIPY', 1, 0);
            $pdf->Cell(56, 6, $this->nipy, 1, 0);
            $pdf->Cell(35, 6, 'NIM', 1, 0);
            $pdf->Cell(56, 6, $mahasiswa->nim, 1, 1);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(35, 6, 'Tanggal Supervisi', 1, 0);
            $pdf->Cell(56, 6, '', 1, 0);
            $pdf->Cell(35, 6, 'Th. Akademik', 1, 0);
            $pdf->Cell(56, 6, $mahasiswa->tahun, 1, 1);

            $pdf->Ln(2);
            $pdf->SetFont('Times', 'B', 12);

            $pdf->Cell(1, 6, '');
            $pdf->Cell(7, 6, '2.', 0, 0);
            $pdf->Cell(1, 6, 'IDENTITAS TEMPAT KERJA PRAKTIK', 0, 1);

            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(8, 6, '', 0, 0);
            $pdf->Cell(50, 6, 'Tempat Kerja Praktik', 0, 0);
            $pdf->Cell(3, 6, ':', 0, 0);
            $pdf->Cell(1, 6, $mahasiswa->nama_instansi, 0, 1);
            $pdf->Cell(8, 6, '', 0, 0);
            $pdf->Cell(50, 6, 'Alamat Kerja Praktik', 0, 0);
            $pdf->Cell(3, 6, ':', 0, 0);
            $pdf->Cell(1, 6, $mahasiswa->alamat, 0, 1);
            $pdf->Cell(8, 6, '', 0, 0);
            $pdf->Cell(50, 6, 'No Telp', 0, 0);
            $pdf->Cell(4, 6, ':', 0, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(5, 6, '', 0, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(5, 6, '', 0, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 1);

            $pdf->Ln(2);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(1, 6, 'KOLOM KUISIONER', 0, 1);
            $pdf->SetFont('Times', '', 11);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(1, 6, 'Sosialisasi dan Pengajuan Surat Kerja Praktek Ke Instansi yang bersangkutan', 0, 1);
            $pdf->Cell(8, 5, '');
            $pdf->Cell(50, 5, '1. Baik', 0, 0);
            $pdf->Cell(50, 5, '1. Cukup Baik', 0, 0);
            $pdf->Cell(50, 5, '1. Kurang Baik', 0, 1);

            $pdf->SetFont('Times', 'B', 11);
            $pdf->Cell(8, 12, '');
            $pdf->Cell(10, 12, 'NO', 1, 0, 'C');
            $pdf->Cell(100, 12, 'ITEM PENILAIAN', 1, 0, 'C');
            $pdf->Cell(30, 6, 'Score', 1, 1, 'C');
            $pdf->Cell(118, 12, '');
            $pdf->Cell(10, 6, '1', 1, 0, 'C');
            $pdf->Cell(10, 6, '2', 1, 0, 'C');
            $pdf->Cell(10, 6, '3', 1, 1, 'C');

            $pdf->Cell(148, 12, '');
            $pdf->Cell(42, -12, 'Keterangan', 1, 1, 'C');

            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(1, 12, '', 0, 1);
            $pdf->Cell(8, 7, '');
            $pdf->SetFillColor(229, 229, 204);
            $pdf->MUltiCell(140, 6, 'PERSIAPAN KERJA PRAKTIK', 1, 'L', 1);
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(10, 6, '1', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Pemilihan tempat kerja praktik', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(25, 6, 'Grading Score', 0, 0);
            $pdf->Cell(3, 6, ':', 0, 1);
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(10, 6, '2', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Penyiapan dokumen yang diperlukan', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(25, 6, 'Bagus', 0, 0);
            $pdf->Cell(3, 6, ':', 0, 1);

            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(8, 6, '');
            $pdf->MultiCell(140, 6, 'PELAKSANAAN KERJA PRAKTIK', 1, 'L', 1);
            $pdf->SetFont('Times', '', 10);
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos + 148, $yPos);
            $pdf->Cell(25, -6, 'Cukup Bagus', 0, 0);
            $pdf->Cell(3, -6, ':', 0, 1);
            $pdf->Cell(1, 6, '', 0, 1);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(10, 6, '3', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Perilaku mahasiswa dari segi kedisiplinan', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(25, 6, 'Kurang Bagus', 0, 0);
            $pdf->Cell(3, 6, ':', 0, 1);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(10, 6, '4', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Perilaku mahasiswa dari segi etika/sopan santun', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 1);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(10, 6, '5', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Perilaku mahasiswa dari segi kejujuran', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 1);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(10, 6, '6', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Perilaku mahasiswa dari segi kerjasama', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 1);
            $pdf->Cell(8, 12, '');
            $pdf->Cell(10, 12, '7', 1, 0, 'C');

            $point_7 = 'Pemahaman dan kemampuan dalam melaksanakan dan menyelesaikan tugas';

            $pdf->MultiCell(100, 6, $point_7, 1, 1);

            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos + 118, $yPos);
            $pdf->Cell(10, -12, '', 1, 0);
            $pdf->Cell(10, -12, '', 1, 0);
            $pdf->Cell(10, -12, '', 1, 1);

            $pdf->Cell(1, 12, '', 0, 1);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(10, 6, '8', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Tanggung jawab mahasiswa saat melakukan kerja praktik', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 1);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(10, 6, '9', 1, 0, 'C');
            $pdf->Cell(100, 6, 'Kepatuhan terhadap kesehatan dan keselamatan kerja', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 1);

            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(8, 6, '');
            $pdf->Cell(110, 6, 'JUMLAH', 1, 0, 'C');
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 0);
            $pdf->Cell(10, 6, '', 1, 1);

            $pdf->Cell(148, 12, '');
            $pdf->Cell(42, -78, '', 1, 1, 'C');

            $pdf->SetFont('Times', 'B', 11);
            $pdf->Cell(1, 78, '', 0, 1);
            $pdf->Ln(1);
            $pdf->Cell(8, 6, '', 0, 0);
            $pdf->Cell(110, 6, 'MASUKAN UNTUK KEGIATAN KERJA PRAKTEK BERIKUTNYA', 0, 1);
            $pdf->Cell(8, 7, '');
            $pdf->Cell(91, 7, 'Permasalahan', 1, 0, 'C');
            $pdf->Cell(91, 7, 'Solusi', 1, 1, 'C');
            $pdf->Cell(8, 7, '');
            $pdf->Cell(91, 20, '', 1, 0, 'C');
            $pdf->Cell(91, 20, '', 1, 1, 'C');

            $pdf->SetFont('Times', '', 11);
            $pdf->Cell(8, 6, '', 0, 0);
            $pdf->Cell(110, 6, 'NB:** Centang (v) score yang sesuai', 0, 1);

            $pdf->Cell(8, 5, '', 0, 0);
            $pdf->Cell(100, 5, 'Mengetahui,', 0, 0);
            $pdf->Cell(1, 5, 'Mengetahui,', 0, 1);
            $pdf->Cell(8, 5, '', 0, 0);
            $pdf->Cell(100, 4, 'Akademik Prodi DIII Teknik Komputer', 0, 0);
            $pdf->Cell(1, 4, 'Instansi', 0, 1);
            $pdf->Ln(17);
            $pdf->Cell(8, 5, '', 0, 0);
            $pdf->Cell(100, 5, '(............................................................)', 0, 0);
            $pdf->Cell(1, 5, '(............................................................)', 0, 1);
            $pdf->Cell(8, 5, '', 0, 0);
            $pdf->Cell(100, 5, 'NIPY....................................................', 0, 0);
            $pdf->Cell(1, 5, 'NIP.......................................................', 0, 1);

            $pdf->Output($mahasiswa->nim . '_kuisioner_monitoring_kp.pdf', 'I');
        }
    }

    public function k_m()
    {
        $nim = dekrip($this->u3);

        if ($nim) {
            $mahasiswa = $this->universal->getOne(['nim' => $nim], 'tb_mahasiswa');

            $pdf = new FPDF('p', 'mm', 'A4');
            $pdf = new PDF_Dash();
            $pdf = new PDF_FJ();

            $pdf->AddPage();

            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(145, 6, '');
            $pdf->Cell(10, 6, 'AS', 1, 0, 'C');
            $pdf->Cell(10, 6, 'P2M', 1, 0, 'C');
            $pdf->Cell(25, 6, 'PHB.02.10.A.8', 1, 1, 'C');

            $pdf->SetLineWidth(0);
            $pdf->Line(9, 18, 200, 18);

            $pdf->Ln(5);
            $pdf->SetFont('Times', 'B', 11);
            $pdf->Image('assets/uploads/poltek.png', 12, 20, 19, 19);

            $pdf->Cell(30, 5, '');
            $pdf->Cell(155, 5, 'KUISIONER DENGAN MITRA', 0, 1, 'C');
            $pdf->Cell(30, 5, '');
            $pdf->Cell(155, 5, 'EVALUASI KERJA SAMA MITRA DENGAN', 0, 1, 'C');
            $pdf->Cell(30, 5, '');
            $pdf->Cell(155, 5, 'PROGRAM STUDI D-III TEKNIK KOMPUTER POLITEKNIK HARAPAN BERSAMA', 0, 0, 'C');


            $pdf->SetLineWidth(1);
            $pdf->Line(35, 37, 201, 37);
            $pdf->SetLineWidth(0);
            $pdf->Line(35, 38, 201, 38);

            $pdf->Ln(10);

            $pdf->SetFont('Times', '', 11);

            $demi = 'Demi meningkatkan kerja sama yang telah dilakukan selama tahun 2010-2014 antara mitra dengan prodi D-III Politeknik Harapan Bersama, maka kami mengharap kesediaan Saudara untuk mengisi kuisioner berikut sesuai dengan keadaan sebenarnya. Lembar penilaian ini ditujukan untuk meningkatkan mutu proses pembelajaran dan lulusannya, sehingga para lulusan dari D-III Teknik komputer Politeknik Harapan Bersama Tegal dapat siap diberdayakan oleh stakeholder/user.';

            $pdf->SetFillColor(255, 255, 255);

            $pdf->MultiCell(192, 5, $demi, 0, 'FJ', 1);

            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos, $yPos);

            $pdf->setFont('Times', 'BIU', '11');
            $pdf->Cell(1, 10, 'DATA IDENTITAS MITRA', 0, 1);

            $pdf->setFont('Times', '', '11');
            $pdf->Cell(60, 5, 'NAMA PERUSAHAAN', 0, 0);
            $pdf->Cell(4, 5, ':', 0, 0);
            $pdf->Cell(1, 5, $mahasiswa->nama_instansi, 0, 1);
            $pdf->Cell(60, 5, 'ALAMAT PERUSAHAAN', 0, 0);
            $pdf->Cell(4, 5, ':', 0, 0);
            $pdf->Cell(1, 5, $mahasiswa->alamat, 0, 1);
            $pdf->Cell(60, 6, 'NO TELEPON/HP', 0, 0);
            $pdf->Cell(5, 6, ':', 0, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(5, 6, '', 0, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(5, 6, '', 0, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 0);
            $pdf->Cell(7, 6, '', 1, 1);

            $pdf->Ln(2);
            $pdf->Cell(1, 6, 'Berilah tanda centang (v) menurut penilaian Saudara sesuai dengan kondisi keadaan :', 0, 1);

            $pdf->Cell(10, 15, 'NO', 1, 0, 'C');
            $pdf->Cell(80, 15, 'PERTANYAAN', 1, 0, 'C');
            $pdf->Cell(100, 5, 'PENILAIAN', 1, 1, 'C');
            $pdf->Cell(90, 5, '');
            $pdf->Cell(21, 10, 'Sangat Baik', 1, 0, 'C');
            $pdf->Cell(15, 10, 'Baik', 1, 0, 'C');
            $pdf->Cell(15, 10, 'Cukup', 1, 0, 'C');
            $pdf->Cell(23, 10, 'Kurang Baik', 1, 0, 'C');
            $pdf->MultiCell(26, 5, 'Sangat Kurang Baik', 1, 'C', 1);

            $pdf->setFont('Times', '', '10');
            $pdf->Cell(10, 15, '1', 1, 0, 'C');
            $pdf->MultiCell(80, 5, "Bagaimana kesiapan D-III politeknik Harapan Bersama dalam menyelenggarakan kerjasama dengan instansi Saudara ?", 1, 1);

            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos + 90, $yPos);
            $pdf->Cell(21, -15, '', 1, 0);
            $pdf->Cell(15, -15, '', 1, 0);
            $pdf->Cell(15, -15, '', 1, 0);
            $pdf->Cell(23, -15, '', 1, 0);
            $pdf->Cell(26, -15, '', 1, 1);

            $pdf->Cell(1, 15, '', 0, 1);

            $pdf->Cell(10, 10, '2', 1, 0, 'C');
            $pdf->MultiCell(80, 5, "Bagaimana kepuasan Saudara selama berkeja sama dengan D-III Politeknik Harapan bersama ?", 1, 1);

            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos + 90, $yPos);
            $pdf->Cell(21, -10, '', 1, 0);
            $pdf->Cell(15, -10, '', 1, 0);
            $pdf->Cell(15, -10, '', 1, 0);
            $pdf->Cell(23, -10, '', 1, 0);
            $pdf->Cell(26, -10, '', 1, 1);

            $pdf->Cell(1, 10, '', 0, 1);

            $pdf->Cell(10, 15, '3', 1, 0, 'C');
            $pdf->MultiCell(80, 5, "Apakah hasil pembelajaran di D-III Politeknik Harapan Bersama teah sesuai dengan spesifiskasi yang dibutuhkan oleh stakeholder/user", 1, 1);

            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos + 90, $yPos);
            $pdf->Cell(21, -15, '', 1, 0);
            $pdf->Cell(15, -15, '', 1, 0);
            $pdf->Cell(15, -15, '', 1, 0);
            $pdf->Cell(23, -15, '', 1, 0);
            $pdf->Cell(26, -15, '', 1, 1);

            $pdf->Cell(1, 15, '', 0, 1);

            $pdf->Cell(10, 15, '4', 1, 0, 'C');
            $pdf->MultiCell(80, 5, "Apakah disiplin ilmu di D-III Politeknik Harapan Bersama telah sesuai dengan spesifiskasi yang dibutuhkan oleh stakeholder/user", 1, 1);

            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos + 90, $yPos);
            $pdf->Cell(21, -15, '', 1, 0);
            $pdf->Cell(15, -15, '', 1, 0);
            $pdf->Cell(15, -15, '', 1, 0);
            $pdf->Cell(23, -15, '', 1, 0);
            $pdf->Cell(26, -15, '', 1, 1);

            $pdf->Cell(1, 15, '', 0, 1);

            $pdf->Cell(10, 15, '4', 1, 0, 'C');
            $pdf->MultiCell(80, 5, "Bagaimana kelancaran atau kemudahan komunikasi  D-III Politeknik Harapan dengan Perusahaan Saudara ?", 1, 1);

            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();

            $pdf->SetXY($xPos + 90, $yPos);
            $pdf->Cell(21, -15, '', 1, 0);
            $pdf->Cell(15, -15, '', 1, 0);
            $pdf->Cell(15, -15, '', 1, 0);
            $pdf->Cell(23, -15, '', 1, 0);
            $pdf->Cell(26, -15, '', 1, 1);

            $pdf->SetFillColor(204, 204, 204);
            $pdf->Cell(1, 15, '', 0, 1);
            $pdf->MultiCell(190, 5, 'PENGEMBANGAN KETRAMPILAN MAHASISWA', 1, 'C', 1);

            $pdf->SetFillColor(255, 255, 255);

            $pdf->Cell(10, 5, 'NO', 1, 0, 'C');
            $pdf->Cell(140, 5, 'PERTANYAAN', 1, 0, 'C');
            $pdf->Cell(20, 5, 'Perlu', 1, 0, 'C');
            $pdf->Cell(20, 5, 'Tidak Perlu', 1, 1, 'C');

            $pdf->Cell(10, 25, '6', 0, 0, 'C');
            $pdf->MultiCell(140, 5, "Apakah perlu dilakukan pertemuan rutin  D-III Politeknik Harapan dengan Perusahaan Saudara? (Jika perlu tolong berikan masukan pertemuan yang diinginkan :", 0, 1);

            $pdf->Cell(10, 5, '');
            $pdf->Cell(2, 5, '');
            $pdf->Cell(4, 4, '', 1, 0);
            $pdf->Cell(132, 5, 'Per Bulan', 0, 1);
            $pdf->Cell(10, 5, '');
            $pdf->Cell(2, 5, '');
            $pdf->Cell(4, 4, '', 1, 0);
            $pdf->Cell(132, 5, 'Per Semester', 0, 1);
            $pdf->Cell(10, 5, '');
            $pdf->Cell(2, 5, '');
            $pdf->Cell(4, 4, '', 1, 0);
            $pdf->Cell(132, 5, 'Per Tahun', 0, 1);

            $pdf->Cell(10, -25, '', 1, 0);
            $pdf->Cell(140, -25, '', 1, 0);
            $pdf->Cell(20, -25, '', 1, 0);
            $pdf->Cell(20, -25, '', 1, 1);

            $pdf->Cell(1, 25, '', 0, 1);
            $pdf->Cell(10, 30, '7', 0, 0, 'C');
            $pdf->MultiCell(140, 5, "Apakah perlu dilakukan pelatihan di D-III Politeknik Harapan tentang software yang digunakan di Perusahaan Saudara?(Jika perlu tuliskan pelatihan yang dibutuhkan :", 0, 1);

            $pdf->Cell(10, 5, '');
            $pdf->Cell(2, 5, '');
            $pdf->Cell(4, 4, '', 1, 0);
            $pdf->Cell(132, 5, 'Java', 0, 1);
            $pdf->Cell(10, 5, '');
            $pdf->Cell(2, 5, '');
            $pdf->Cell(4, 4, '', 1, 0);
            $pdf->Cell(132, 5, 'ERP', 0, 1);
            $pdf->Cell(10, 5, '');
            $pdf->Cell(2, 5, '');
            $pdf->Cell(4, 4, '', 1, 0);
            $pdf->Cell(132, 5, 'Multimedia', 0, 1);
            $pdf->Cell(10, 5, '');
            $pdf->Cell(2, 5, '');
            $pdf->Cell(4, 4, '', 1, 0);
            $pdf->Cell(132, 5, 'Softskill', 0, 1);

            $pdf->Cell(10, -30, '', 1, 0);
            $pdf->Cell(140, -30, '', 1, 0);
            $pdf->Cell(20, -30, '', 1, 0);
            $pdf->Cell(20, -30, '', 1, 1);

            $pdf->Cell(1, 30, '', 0, 1);

            $pdf->Ln(2);
            $pdf->Cell(1, 5, 'Saran untuk peningkatan mutu kerja sama antara D-III Politeknik Harapan bersama dengan Perusahaan Saudara :', 0, 1);

            $pdf->SetDash(1, 1); //5mm on, 5mm off
            $pdf->Line(12, 255, 198, 255);
            $pdf->Line(12, 260, 198, 260);
            $pdf->Line(12, 265, 198, 265);
            $pdf->Line(12, 270, 198, 270);

            $pdf->Output($mahasiswa->nim . '_kuisioner_mitra.pdf', 'I');
        }
    }

    public function profile()
    {
        $data['title'] = 'Profile Dosen';
        $data['page'] = 'profile';
        $data['dosen'] = $this->dosen->getOne($this->session->userdata('id'));

        $this->load->view('index', $data);
    }

    public function updateFoto()
    {
        $id = $this->input->post('id');

        $config['upload_path']          = './assets/uploads/profile';
        $config['allowed_types']        = 'png|jpg|jpeg';
        $config['max_size']             = 2048; // 2 mb
        $config['remove_spaces']        = TRUE;
        $config['file_name']            = date('d-m-Y') . '_' . $_FILES["foto_profil"]['name'];;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto_profil')) {

            $data = [
                "username" => str_replace(' ', '', $this->input->post('username', TRUE))
            ];

            $this->universal->update($data, ['id' => $id], 'tb_dosen');

            $this->session->set_flashdata('toastr-sukses', 'Username berhasil diupdate');

            redirect('dosen/profile', 'refresh');
        } else {
            $upload_data = $this->upload->data();

            $dosen = $this->universal->getOne(['id' => $id], 'tb_dosen');

            $data = [
                "username" => str_replace(' ', '', $this->input->post('username', TRUE)),
                "foto" => $upload_data['file_name']
            ];

            if ($dosen->foto != "default.jpg") {
                unlink(FCPATH . 'assets/uploads/profile/' . $dosen->foto);
            }

            $this->universal->update($data, ['id' => $id], 'tb_dosen');

            $this->session->set_flashdata('toastr-sukses', 'Profil berhasil diupdate');

            redirect('dosen/profile', 'refresh');
        }
    }

    public function updatePass()
    {
        $this->form_validation->set_rules('pas_lama', 'Password Baru', 'required', [
            'required' => 'Password lama harap di isi !'
        ]);
        $this->form_validation->set_rules('pas_baru', 'Password Baru', 'required|trim|min_length[5]', [
            'required' => 'Password baru harap di isi !',
            'min_length' => 'Password kurang dari 5'
        ]);
        $this->form_validation->set_rules('pas_konfir', 'Password Konfirmasi', 'required|trim|min_length[5]|matches[pas_baru]', [
            'required' => 'Password konfirmasi harap di isi !',
            'matches' => 'Password konfirmasi salah !',
            'min_length' => 'Password kurang dari 5'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Profil Dosen';

            $id = $this->input->post('id');
            $data['dosen'] = $this->dosen->getOne($id);

            $data['page'] = 'profile';

            $this->load->view('index', $data);
        } else {
            $id = $this->input->post('id');
            $dosen = $this->universal->getOne(['id' => $id], 'tb_dosen');

            $pas_lama = $this->input->post('pas_lama', TRUE);
            $pas_baru = $this->input->post('pas_baru', TRUE);

            if (password_verify($pas_lama, $dosen->password)) {
                $data = [
                    "password" =>  password_hash($pas_baru, PASSWORD_DEFAULT)
                ];

                $this->universal->update($data, ['id' => $id], 'tb_dosen');

                $this->session->set_flashdata('toastr-sukses', 'Password berhasil diupdate');

                redirect('dosen/profile', 'refresh');
            } else {
                $this->session->set_flashdata('toastr-error', 'Password lama salah');

                redirect('dosen/profile', 'refresh');
            }
        }
    }
}

/* End of file Dosen.php */