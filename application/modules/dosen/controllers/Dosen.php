<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('dosen_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('dosen/login', 'refresh');
        }

        $this->u2		= $this->uri->segment(2);
        $this->u3		= $this->uri->segment(3);
        $this->u4		= $this->uri->segment(4);
        $this->u5		= $this->uri->segment(5);
        $this->u6		= $this->uri->segment(6);
        $this->u7		= $this->uri->segment(7);

        $this->load->model('M_Jurnal', 'jurnal');
        $this->load->model('M_Laporan_pdf', 'laporan_pdf');
        $this->load->model('M_Lembar_produk', 'lembar_produk');
        $this->load->model('M_Pengesahan', 'pengesahan');
        $this->load->model('M_Persetujuan', 'persetujuan');
        $this->load->model('M_Brosur', 'brosur');
        $this->load->model('M_Dsn', 'dosen');
        $this->load->model('M_Universal', 'universal');

        $this->nama = $this->session->userdata('nama');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Dosen';
        $data['page'] = 'dashboard';

        $data['mahasiswa'] = count($this->dosen->getMhs($this->nama, ''));
        $data['jurnal'] = count($this->dosen->getJurnal($this->nama, ''));
        $data['laporan_pdf'] = count($this->dosen->getLapPdf($this->nama, ''));
        $data['lembar_produk'] = count($this->dosen->getProduk($this->nama, ''));
        $data['pengesahan'] = count($this->dosen->getPengesahan($this->nama, ''));
        $data['persetujuan'] = count($this->dosen->getPersetujuan($this->nama, ''));
        $data['brosur'] = count($this->dosen->getBrosur($this->nama, ''));

        // echo $this->nama; die();

        $this->load->view('index', $data);   
    }

    public function mahasiswa()
    {
        $data['title'] = 'List Mahasiswa';
        $data['page'] = 'mahasiswa';

        if ($this->u4 != '')
        {
            $tahun = dekrip($this->u4);
        }
        else
        {
            $tahun = tahunAkademik();
        }
        
        $data['mahasiswa'] = $this->dosen->getMhs($this->nama, ['semester' => dekrip($this->u3), 'tahun' => $tahun]);
        $data['dosen'] = $this->dosen->getAll();
        $data['semester'] = $this->u3;
        $data['tahun']    = $this->dosen->gruptahun();

        $this->session->set_userdata('previous_url', current_url());
        $this->load->view('index', $data);
    }

    public function jurnal()
    {
        $data['title']      = 'List Jurnal PDF';
        $data['page']       = 'jurnal';
        $data['tahun']      = $this->dosen->gruptahun();

        if ($this->u3 == '')
        {
            $tahun = tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u3);
        }

        $data['jurnal'] = $this->dosen->getJurnal($this->nama, ['tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function laporan_pdf()
    {
        $data['title']      = 'List Laporan PDF';
        $data['page']       = 'laporan_pdf';
        $data['tahun']      = $this->dosen->gruptahun();
        $data['kategori']   = $this->u3;

        if ($this->u4 == '')
        {
            $tahun = tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u4);
        }

        $data['laporan_pdf'] = $this->dosen->getLapPdf($this->nama, ['tb_laporan_pdf.kategori' => $this->u3, 'tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function lembar_produk()
    {
        $data['title']      = 'List Lembar Produk';
        $data['page']       = 'lembar_produk';
        $data['tahun']      = $this->dosen->gruptahun();

        if ($this->u3 == '')
        {
            $tahun = tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u3);
        }

        $data['lembar_produk'] = $this->dosen->getProduk($this->nama, ['tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function pengesahan()
    {
        $data['title']      = 'List Lembar Pengesahan';
        $data['page']       = 'pengesahan';
        $data['tahun']      = $this->dosen->gruptahun();
        $data['kategori']   = $this->u3;

        if ($this->u4 == '')
        {
            $tahun = tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u4);
        }

        $data['pengesahan'] = $this->dosen->getPengesahan($this->nama, ['tb_pengesahan.kategori' => $this->u3, 'tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function persetujuan()
    {
        $data['title']      = 'List Lembar Persetujuan';
        $data['page']       = 'persetujuan';
        $data['tahun']      = $this->dosen->gruptahun();

        if ($this->u3 == '')
        {
            $tahun = tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u3);
        }

        $data['persetujuan'] = $this->dosen->getPersetujuan($this->nama, ['tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function brosur()
    {
        $data['title']      = 'List Brosur';
        $data['page']       = 'brosur';
        $data['tahun']      = $this->dosen->gruptahun();

        if ($this->u3 == '')
        {
            $tahun = tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u3);
        }

        $data['brosur'] = $this->dosen->getbrosur($this->nama, ['tb_mahasiswa.tahun' => $tahun]);

        $this->load->view('index', $data);
    }

    public function rekap()
    {
        $semester = dekrip($this->u3);
        if ($this->u4 == '')
        {
            $tahun  = tahunAkademik();
        }
        else
        {
            $tahun  = dekrip($this->u4);  
        }

        $data['title']      = 'Rekap data upload berkas';
        $data['page']       = 'rekap';
        $data['semester']   = $this->u3;
        $data['tahun']      = $this->dosen->grupTahun();

        if ($semester == 4)
        {
            $data['rekap']      = $this->dosen->getKP($tahun, $this->nama);
        }
        else
        {
            $data['rekap']      = $this->dosen->getTA($tahun, $this->nama);
        }

        $this->session->set_userdata('previous_url', current_url());
        $this->load->view('index', $data);
    }

    public function verifikasi()
    {
        if ($this->u4 == '')
        {
            $tahun = tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u4);
        }

        $semester = dekrip($this->u3);

        $data['title']      = 'Verifikasi File';
        $data['page']       = 'verifikasi';
        $data['semester']   = $this->u3;
        $data['tahun']      = $this->dosen->grupTahun();

        if ($semester == 4)
        {
            $data['mahasiswa'] = $this->dosen->getKPVerifikasi($tahun, $this->nama);
        }
        else{
            $data['mahasiswa'] = $this->dosen->getTAVerifikasi($tahun, $this->nama);
        }

        $this->load->view('index', $data);
    }

    public function cek_file($nim)
    {
        $this->data['title'] = 'Verifikasi File';
        $this->data['page'] = 'cek_file';

        $mhs = $this->universal->getOne(['nim' => dekrip($nim)], 'tb_mahasiswa');

        if ($mhs->semester == 6)
        {
            $this->_cekfileTA(dekrip($nim));
        }

        else
        {
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

?>