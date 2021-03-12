<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dapur extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('user_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('user/login', 'refresh');
        }

        $this->load->model('M_Mahasiswa', 'mahasiswa');
        $this->load->model('M_Jurnal', 'jurnal');
        $this->load->model('M_Laporan_pdf', 'laporan_pdf');
        $this->load->model('M_Lembar_produk', 'lembar_produk');
        $this->load->model('M_Pengesahan', 'pengesahan');
        $this->load->model('M_Persetujuan', 'persetujuan');
        $this->load->model('M_Brosur', 'brosur');

        $this->load->library('pdf');
    }

    public function index()
    {
        $nim = $this->session->userdata('nim');
        cek_biodata($nim);

        $this->data['title'] = 'SIKAPTA UPLOAD';

        $this->data['mahasiswa'] = $this->mahasiswa->getOne($nim);

        if ($this->session->userdata('semester') == 6) {
            $this->_homeTA();
        } else {
            $this->_homeKP();
        }

        $this->load->view('user/frontend/index', $this->data);
    }

    private function _homeTA()
    {
        $nim = $this->session->userdata('nim');

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
                "berkas" => 'Jurnal',
                "judul"  => $j_jurnal,
                "status" => $s_jurnal
            ],
            "1" => [
                "berkas" => 'Laporan PDF',
                "judul"  => $j_lap_pdf,
                "status" => $s_lap_pdf
            ],
            "2" => [
                "berkas" => 'Lembar Penyerahan Produk',
                "judul"  => $j_produk,
                "status" => $s_produk
            ],
            "3" => [
                "berkas" => 'Lembar Pengesahan',
                "judul"  => $j_pengesahan,
                "status" => $s_pengesahan
            ],
            "4" => [
                "berkas" => 'Lembar Persetujuan',
                "judul"  => $j_persetujuan,
                "status" => $s_persetujuan
            ],
            "5" => [
                "berkas" => 'Brosur',
                "judul"  => $j_brosur,
                "status" => $s_brosur
            ]
        ];

        $this->data['page'] = 'user/frontend/uploadTA';
    }

    private function _homeKP()
    {
        $nim = $this->session->userdata('nim');

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
                "berkas" => 'Laporan PDF',
                "judul"  => $j_lap_pdf,
                "status" => $s_lap_pdf
            ],
            "1" => [
                "berkas" => 'Lembar Pengesahan',
                "judul"  => $j_pengesahan,
                "status" => $s_pengesahan
            ]
        ];

        $this->data['page'] = 'user/frontend/uploadKP';
    }

    public function profile()
    {
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|min_length[10]|numeric', [
            'required' => 'No telepon tidak boleh kosong !',
            'min_length' => 'No telepon kurang dari 10 digit !',
            'numeric' => 'Harus menggunakan angka !'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email tidak boleh kosong !',
            'valid_email' => 'Gunakan email yang valid !'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Profil Mahasiswa';

            $nim = $this->session->userdata('nim');
            $data['mahasiswa'] = $this->mahasiswa->getOne($nim);

            $data['page'] = 'user/frontend/profile';

            $this->load->view('user/frontend/index', $data);
        } else {
            $this->_update();
        }
    }

    private function _update()
    {
        $nim = $this->input->post('nim');
        $mahasiswa = $this->mahasiswa->getOne($nim);

        $config['upload_path']          = './assets/uploads/profile';
        $config['allowed_types']        = 'png|jpg|jpeg';
        $config['max_size']             = 2048; // 2 mb
        $config['remove_spaces']        = TRUE;
        $config['file_name']            = $nim . "_" . $_FILES["foto_profil"]['name'];;
        // $config['max_width']            = 390; //354
        // $config['max_height']           = 500; // 472

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto_profil')) {
            $data = [
                "no_telepon" => $this->input->post('no_telepon'),
                "email" => $this->input->post('email')
            ];

            $this->db->where('nim', $nim);
            $this->db->update('tb_mahasiswa', $data);

            $this->session->set_flashdata('foto', $this->upload->display_errors());

            redirect('user/dapur/profile', 'refresh');
        } else {
            $upload_data = $this->upload->data();

            $data = [
                "no_telepon" => $this->input->post('no_telepon'),
                "email" => $this->input->post('email'),
                "foto" => $upload_data['file_name']
            ];

            if ($mahasiswa[0]['foto'] != "default.jpg") {
                unlink(FCPATH . 'assets/uploads/profile/' . $mahasiswa[0]['foto']);
            }

            $this->db->where('nim', $nim);
            $this->db->update('tb_mahasiswa', $data);

            $this->session->set_flashdata('flash-sukses', 'Profile berhasil diupdate');

            redirect('user/dapur/profile', 'refresh');
        }
    }

    public function updatePass()
    {
        $this->form_validation->set_rules('pas_lama', 'Password Baru', 'required', [
            'required' => 'Password lama harap di isi !'
        ]);
        $this->form_validation->set_rules('pas_baru', 'Password Baru', 'required|trim|min_length[8]', [
            'required' => 'Password baru harap di isi !',
            'min_length' => 'Password kurang dari 8'
        ]);
        $this->form_validation->set_rules('pas_konfir', 'Password Konfirmasi', 'required|trim|min_length[8]|matches[pas_baru]', [
            'required' => 'Password konfirmasi harap di isi !',
            'matches' => 'Password konfirmasi salah !',
            'min_length' => 'Password kurang dari 8'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Profil Mahasiswa';

            $nim = $this->session->userdata('nim');
            $data['mahasiswa'] = $this->mahasiswa->getOne($nim);

            $data['page'] = 'user/frontend/profile';

            $this->load->view('user/frontend/index', $data);
        } else {
            $nim = $this->session->userdata('nim');
            $mahasiswa = $this->mahasiswa->getOne($nim);

            $pas_lama = $this->input->post('pas_lama', TRUE);
            $pas_baru = $this->input->post('pas_baru', TRUE);

            if (password_verify($pas_lama, $mahasiswa[0]['password'])) {
                $data = [
                    "password" =>  password_hash($pas_baru, PASSWORD_DEFAULT)
                ];

                $this->mahasiswa->resetPassword($data, $mahasiswa[0]['id']);

                $this->session->set_flashdata('flash-sukses', 'Password berhasil diupdate');

                redirect('user/dapur/profile', 'refresh');
            } else {
                $this->session->set_flashdata('flash-error', 'Password lama salah');

                redirect('user/dapur/profile', 'refresh');
            }
        }
    }

    public function uploadBerkas()
    {
        $nim = $this->session->userdata('nim');
        cek_biodata($nim);

        if ($this->session->userdata('nim') == 6) {
            $this->_berkasTA($nim);
        } else {
            $this->_berkasKP($nim);
        }

        redirect('user/dapur', 'refresh');
    }

    private function _berkasTA($nim)
    {
        $upload_jurnal = $_FILES['jurnal']['name'];
        $upload_lap_pdf = $_FILES['lap_pdf']['name'];
        $upload_produk = $_FILES['lembar_produk']['name'];
        $upload_pengesahan = $_FILES['pengesahan']['name'];
        $upload_persetujuan = $_FILES['persetujuan']['name'];
        $upload_brosur = $_FILES['brosur']['name'];

        // jurnal
        if ($upload_jurnal) {
            $this->load->library('upload');

            $config['upload_path']          = './assets/uploads/jurnal';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 2048; // 2 mb
            $config['remove_spaces']        = TRUE;
            $config['file_name']            = $nim . "_" . $_FILES["jurnal"]['name'];;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('jurnal')) {
                $this->session->set_flashdata('jurnal', $this->upload->display_errors());
            } else {

                $upload_data = $this->upload->data();
                $jurnal = $this->jurnal->getOne($nim);

                if ($jurnal) {
                    $data = [
                        "nama_jurnal" => $upload_data['file_name'],
                        "status" => "Menunggu"
                    ];

                    unlink(FCPATH . 'assets/uploads/jurnal/' . $jurnal[0]['nama_jurnal']);

                    $this->db->where('nim', $nim);
                    $this->db->update('tb_jurnal', $data);
                } else {
                    $data = [
                        "nim" => $nim,
                        "nama_jurnal" => $upload_data['file_name'],
                        "status" => "Menunggu"
                    ];

                    $this->db->insert('tb_jurnal', $data);
                }

                $this->session->set_flashdata('jurnal', 'Jurnal sukses terupload');
            }
        }

        // laporan pdf
        if ($upload_lap_pdf) {

            $this->load->library('upload');

            $config['upload_path']          = './assets/uploads/laporan_pdf';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10240; // 10 mb
            $config['remove_spaces']        = TRUE;
            $config['file_name']            = $nim . "_" . $_FILES["lap_pdf"]['name'];;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('lap_pdf')) {
                $this->session->set_flashdata('lap_pdf', $this->upload->display_errors());
            } else {
                $upload_data = $this->upload->data();
                $laporan_pdf = $this->laporan_pdf->getOne($nim);

                if ($laporan_pdf) {
                    $data = [
                        "nama_laporan_pdf"  => $upload_data['file_name'],
                        "kategori"          => "ta",
                        "status" => "Menunggu"
                    ];

                    unlink(FCPATH . 'assets/uploads/laporan_pdf/' . $laporan_pdf[0]['nama_laporan_pdf']);

                    $this->db->where('nim', $nim);
                    $this->db->update('tb_laporan_pdf', $data);
                } else {
                    $data = [
                        "nim" => $nim,
                        "nama_laporan_pdf" => $upload_data['file_name'],
                        "kategori"          => "ta",
                        "status" => "Menunggu"
                    ];

                    $this->db->insert('tb_laporan_pdf', $data);
                }
                $this->session->set_flashdata('lap_pdf', 'Laporan PDF sukses terupload');
            }
        }

        // penyerahan produk
        if ($upload_produk) {
            $this->load->library('upload');

            $config['upload_path']          = './assets/uploads/lembar_produk';
            $config['allowed_types']        = 'pdf|png|jpeg|jpg';
            $config['max_size']             = 5210; // 5 mb
            $config['remove_spaces']        = TRUE;
            $config['file_name']            = $nim . "_" . $_FILES["lembar_produk"]['name'];;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('lembar_produk')) {
                $this->session->set_flashdata('lembar_produk', $this->upload->display_errors());
            } else {

                $upload_data = $this->upload->data();
                $lembar_produk = $this->lembar_produk->getOne($nim);

                if ($lembar_produk) {
                    $data = [
                        "lembar_produk" => $upload_data['file_name'],
                        "status" => "Menunggu"
                    ];

                    unlink(FCPATH . 'assets/uploads/lembar_produk/' . $lembar_produk[0]['nama_file']);

                    $this->db->where('nim', $nim);
                    $this->db->update('tb_produk', $data);
                } else {
                    $data = [
                        "nim" => $nim,
                        "nama_file" => $upload_data['file_name'],
                        "status" => "Menunggu"
                    ];

                    $this->db->insert('tb_produk', $data);
                }

                $this->session->set_flashdata('lembar_produk', 'Lembar penyerahan produk sukses terupload');
            }
        }

        // pengesahan
        if ($upload_pengesahan) {
            $this->load->library('upload');

            $config['upload_path']          = './assets/uploads/pengesahan';
            $config['allowed_types']        = 'pdf|jpg|jpeg|png';
            $config['max_size']             = 5120; // 5 mb
            $config['remove_spaces']        = TRUE;
            $config['file_name']            = $nim . "_" . $_FILES["pengesahan"]['name'];;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('pengesahan')) {
                $this->session->set_flashdata('pengesahan', $this->upload->display_errors());
            } else {

                $upload_data = $this->upload->data();
                $pengesahan = $this->pengesahan->getOne($nim);

                if ($pengesahan) {
                    $data = [
                        "nama_file" => $upload_data['file_name'],
                        "kategori"          => "ta",
                        "status" => "Menunggu"
                    ];

                    unlink(FCPATH . 'assets/uploads/pengesahan/' . $pengesahan[0]['nama_file']);

                    $this->db->where('nim', $nim);
                    $this->db->update('tb_pengesahan', $data);
                } else {
                    $data = [
                        "nim" => $nim,
                        "nama_file" => $upload_data['file_name'],
                        "kategori"          => "ta",
                        "status" => "Menunggu"
                    ];

                    $this->db->insert('tb_pengesahan', $data);
                }

                $this->session->set_flashdata('pengesahan', 'Lembar pengesahan sukses terupload');
            }
        }

        // persetujuan
        if ($upload_persetujuan) {
            $this->load->library('upload');

            $config['upload_path']          = './assets/uploads/persetujuan';
            $config['allowed_types']        = 'pdf|jpg|jpeg|png';
            $config['max_size']             = 5210; // 5 mb
            $config['remove_spaces']        = TRUE;
            $config['file_name']            = $nim . "_" . $_FILES["persetujuan"]['name'];;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('persetujuan')) {
                $this->session->set_flashdata('persetujuan', $this->upload->display_errors());
            } else {

                $upload_data = $this->upload->data();
                $persetujuan = $this->persetujuan->getOne($nim);

                if ($persetujuan) {
                    $data = [
                        "nama_file" => $upload_data['file_name'],
                        "status" => "Menunggu"
                    ];

                    unlink(FCPATH . 'assets/uploads/persetujuan/' . $persetujuan[0]['nama_file']);

                    $this->db->where('nim', $nim);
                    $this->db->update('tb_persetujuan', $data);
                } else {
                    $data = [
                        "nim" => $nim,
                        "nama_file" => $upload_data['file_name'],
                        "status" => "Menunggu"
                    ];

                    $this->db->insert('tb_persetujuan', $data);
                }

                $this->session->set_flashdata('persetujuan', 'Lembar persetujuan sukses terupload');
            }
        }

        // brosur
        if ($upload_brosur) {
            $this->load->library('upload');

            $config['upload_path']          = './assets/uploads/brosur';
            $config['allowed_types']        = 'pdf|jpg|jpeg|png';
            $config['max_size']             = 5120; // 5 mb
            $config['remove_spaces']        = TRUE;
            $config['file_name']            = $nim . "_" . $_FILES["brosur"]['name'];;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('brosur')) {
                $this->session->set_flashdata('brosur', $this->upload->display_errors());
            } else {

                $upload_data = $this->upload->data();
                $brosur = $this->brosur->getOne($nim);

                if ($brosur) {
                    $data = [
                        "nama_file" => $upload_data['file_name'],
                        "status" => "Menunggu"
                    ];

                    unlink(FCPATH . 'assets/uploads/brosur/' . $brosur[0]['nama_file']);

                    $this->db->where('nim', $nim);
                    $this->db->update('tb_brosur', $data);
                } else {
                    $data = [
                        "nim" => $nim,
                        "nama_file" => $upload_data['file_name'],
                        "status" => "Menunggu"
                    ];

                    $this->db->insert('tb_brosur', $data);
                }

                $this->session->set_flashdata('brosur', 'Brosur sukses terupload');
            }
        }
    }

    private function _berkasKP($nim)
    {
        $upload_lap_pdf = $_FILES['lap_pdf']['name'];
        $upload_pengesahan = $_FILES['pengesahan']['name'];

        // laporan pdf
        if ($upload_lap_pdf) {

            $this->load->library('upload');

            $config['upload_path']          = './assets/uploads/laporan_pdf';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10240; // 10 mb
            $config['remove_spaces']        = TRUE;
            $config['file_name']            = $nim . "_" . $_FILES["lap_pdf"]['name'];;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('lap_pdf')) {
                $this->session->set_flashdata('lap_pdf', $this->upload->display_errors());
            } else {
                $upload_data = $this->upload->data();
                $laporan_pdf = $this->laporan_pdf->getOne($nim);

                if ($laporan_pdf) {
                    $data = [
                        "nama_laporan_pdf"  => $upload_data['file_name'],
                        "kategori"          => "kp",
                        "status"            => "Menunggu"
                    ];

                    unlink(FCPATH . 'assets/uploads/laporan_pdf/' . $laporan_pdf[0]['nama_laporan_pdf']);

                    $this->db->where('nim', $nim);
                    $this->db->update('tb_laporan_pdf', $data);
                } else {
                    $data = [
                        "nim" => $nim,
                        "nama_laporan_pdf"  => $upload_data['file_name'],
                        "kategori"          => "kp",
                        "status"            => "Menunggu"
                    ];

                    $this->db->insert('tb_laporan_pdf', $data);
                }
                $this->session->set_flashdata('lap_pdf', 'Laporan PDF sukses terupload');
            }
        }

        // pengesahan
        if ($upload_pengesahan) {
            $this->load->library('upload');

            $config['upload_path']          = './assets/uploads/pengesahan';
            $config['allowed_types']        = 'pdf|jpg|jpeg|png';
            $config['max_size']             = 5120; // 5 mb
            $config['remove_spaces']        = TRUE;
            $config['file_name']            = $nim . "_" . $_FILES["pengesahan"]['name'];;
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('pengesahan')) {
                $this->session->set_flashdata('pengesahan', $this->upload->display_errors());
            } else {

                $upload_data = $this->upload->data();
                $pengesahan = $this->pengesahan->getOne($nim);

                if ($pengesahan) {
                    $data = [
                        "nama_file"         => $upload_data['file_name'],
                        "kategori"          => "kp",
                        "status"            => "Menunggu"
                    ];

                    unlink(FCPATH . 'assets/uploads/pengesahan/' . $pengesahan[0]['nama_file']);

                    $this->db->where('nim', $nim);
                    $this->db->update('tb_pengesahan', $data);
                } else {
                    $data = [
                        "nim" => $nim,
                        "nama_file"         => $upload_data['file_name'],
                        "kategori"          => "kp",
                        "status"            => "Menunggu"
                    ];

                    $this->db->insert('tb_pengesahan', $data);
                }

                $this->session->set_flashdata('pengesahan', 'Lembar pengesahan sukses terupload');
            }
        }
    }

    public function download()
    {
        $nim = $this->session->userdata('nim');

        if ($this->session->userdata('semester') == 6) {
            $this->_downloadTA($nim);
        } else {
            $this->_downloadKP($nim);
        }
    }

    private function _downloadTA($nim)
    {
        $mahasiswa = $this->mahasiswa->getOne($nim);
        $jurnal = $this->jurnal->getOne($nim);
        $laporan_pdf = $this->laporan_pdf->getOne($nim);
        $lembar_produk = $this->lembar_produk->getOne($nim);
        $pengesahan = $this->pengesahan->getOne($nim);
        $persetujuan = $this->persetujuan->getOne($nim);
        $brosur = $this->brosur->getOne($nim);

        if (!$jurnal) {
            $jurnal = [
                "tanggal" => "-",
                "status" => "-"
            ];
        } else {
            $jurnal = [
                "tanggal" => date('d-m-Y', strtotime($jurnal[0]['create_at'])),
                "status" => $jurnal[0]['status']
            ];
        }
        if (!$laporan_pdf) {
            $laporan_pdf = [
                "tanggal" => "-",
                "status" => "-"
            ];
        } else {
            $laporan_pdf = [
                "tanggal" => date('d-m-Y', strtotime($laporan_pdf[0]['create_at'])),
                "status" => $laporan_pdf[0]['status']
            ];
        }
        if (!$lembar_produk) {
            $lembar_produk = [
                "tanggal" => "-",
                "status" => "-"
            ];
        } else {
            $lembar_produk = [
                "tanggal" => date('d-m-Y', strtotime($lembar_produk[0]['create_at'])),
                "status" => $lembar_produk[0]['status']
            ];
        }
        if (!$pengesahan) {
            $pengesahan = [
                "tanggal" => "-",
                "status" => "-"
            ];
        } else {
            $pengesahan = [
                "tanggal" => date('d-m-Y', strtotime($pengesahan[0]['create_at'])),
                "status" => $pengesahan[0]['status']
            ];
        }

        if (!$persetujuan) {
            $persetujuan = [
                "tanggal" => "-",
                "status" => "-"
            ];
        } else {
            $persetujuan = [
                "tanggal" => date('d-m-Y', strtotime($persetujuan[0]['create_at'])),
                "status" => $persetujuan[0]['status']
            ];
        }
        if (!$brosur) {
            $brosur = [
                "tanggal" => "-",
                "status" => "-"
            ];
        } else {
            $brosur = [
                "tanggal" => date('d-m-Y', strtotime($brosur[0]['create_at'])),
                "status" => $brosur[0]['status']
            ];
        }
        $pdf = new FPDF('p', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Times', '', 10);

        $pdf->Image('assets/uploads/poltek.png', 11, 17, 24, 24);

        $pdf->Image('assets/uploads/poltek_blur.png', 20, 65, 170, 170);
        $pdf->Image('assets/uploads/profile/' . $mahasiswa[0]['foto'], 165, 52, 28, 38);

        $pdf->Cell(135, 6, '', 0, 0);
        $pdf->Cell(10, 6, 'PM', 1, 0, 'C');
        $pdf->Cell(10, 6, 'P2M', 1, 0, 'C');
        $pdf->Cell(10, 6, 'PHB', 1, 0, 'C');
        $pdf->Cell(25, 6, '02.06.G.7.i.1', 1, 1, 'C');

        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(190, 5, 'Yayasan Pendidikan Harapan Bersama', 0, 1, 'C');

        $pdf->SetFont('Times', 'B', 14);
        $pdf->SetTextColor(220, 50, 50);

        $pdf->Cell(61, 6, '', 0, 0);
        $pdf->Cell(26, 5, 'PoliTeknik', 0, 0);
        $pdf->SetTextColor(0, 0, 255);
        $pdf->Cell(35, 5, 'Harapan Bersama', 0, 1);
        $pdf->SetTextColor(0);
        $pdf->Cell(190, 5, 'PROGRAM STUDI DIII TEKNIK KOMPUTER', 0, 1, 'C');
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(190, 5, 'Kampus I : Jl. Mataram No.9 Tegal 52142 Telp. 0283-352000 Fax. 00283353353', 0, 1, 'C');
        $pdf->Cell(190, 5, 'Website : www.poltektegal.ac.id       Email : komputer@poltektegal.ac.id', 0, 1, 'C');

        $pdf->SetLineWidth(1);
        $pdf->Line(10, 43, 200, 43);
        $pdf->SetLineWidth(0);
        $pdf->Line(10, 44, 200, 44);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetTextColor(0);

        $pdf->Ln(4);

        $pdf->Cell(190, 7, 'FORM VALIDASI PENYERAHAN LAPORAN TUGAS AKHIR', 0, 1, 'C');

        $pdf->Cell(10, 2, '', 0, 1);

        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(1, 6, 'Admin akan mengecek berkas yang dikirim oleh user/mahasiswa', 0, 1);
        $pdf->Cell(35, 6, 'Nama', 0, 0);
        $pdf->Cell(4, 6, ':', 0, 0);
        $pdf->Cell(2, 6, $mahasiswa[0]['nama'], 0, 1);

        $pdf->Cell(35, 6, 'NIM', 0, 0);
        $pdf->Cell(4, 6, ': ', 0, 0);
        $pdf->Cell(2, 6, $mahasiswa[0]['nim'], 0, 1);

        $pdf->Cell(35, 6, 'Program Studi', 0, 0);
        $pdf->Cell(4, 6, ':', 0, 0);
        $pdf->Cell(2, 6, 'Teknik komputer', 0, 1);

        $pdf->Cell(35, 6, 'Pembimbing 1', 0, 0);
        $pdf->Cell(4, 6, ':', 0, 0);
        $pdf->Cell(2, 6, $mahasiswa[0]['dosbing_1'], 0, 1);

        $pdf->Cell(35, 6, 'Pembimbing 2', 0, 0);
        $pdf->Cell(4, 6, ':', 0, 0);
        $pdf->Cell(2, 6, $mahasiswa[0]['dosbing_2'], 0, 1);

        $pdf->Cell(35, 6, 'Judul', 0, 0);
        $pdf->Cell(4, 6, ':', 0, 0);

        $judul = $mahasiswa[0]['judul'];

        $cellWidth = 155;
        $cellHeight = 6;

        if ($pdf->GetStringWidth($judul) < $cellWidth) {
            $line = 1;
        } else {

            $textLength = strlen($judul);
            $errMargin = 5;
            $startChar = 0;
            $maxChar = 0;
            $textArray = array();
            $tmpString = "";

            while ($startChar < $textLength) {
                while (
                    $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
                    ($startChar + $maxChar) < $textLength
                ) {
                    $maxChar++;
                    $tmpString = substr($judul, $startChar, $maxChar);
                }

                $startChar = $startChar + $maxChar;

                array_push($textArray, $tmpString);

                $maxChar = 0;
                $tmpString = '';
            }

            $line = count($textArray);
        }

        $pdf->MultiCell($cellWidth, $cellHeight, $judul, 0, 1);

        $xPos = $pdf->GetX();
        $yPos = $pdf->GetY();

        $pdf->SetXY($xPos, $yPos);

        $pdf->Cell(35, ($line * $cellHeight), 'Kategori', 0, 0);
        $pdf->Cell(4, ($line * $cellHeight), ':', 0, 0);
        $pdf->Cell(2, ($line * $cellHeight), $mahasiswa[0]['kategori'], 0, 1);

        $pdf->Cell(35, 6, 'Penerima Laporan Tugas Akhir : ', 0, 1);

        $pdf->Ln(1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 12, 'Keterangan', 1, 0, 'C');
        $pdf->Cell(65, 12, 'Instansi / Jabatan', 1, 0, 'C');
        $pdf->Cell(25, 12, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(40, 12, 'Validasi/action', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(60, 10, 'Laporan TA (pdf)', 1, 0);
        $pdf->Cell(65, 10, 'Admin Prodi', 1, 0, 'C');
        $pdf->Cell(25, 10, $laporan_pdf['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 10, $laporan_pdf['status'], 1, 1, 'C');

        $pdf->Cell(60, 10, 'Lembar Penyerahan Produk', 1, 0);
        $pdf->Cell(65, 10, 'Admin Prodi', 1, 0, 'C');
        $pdf->Cell(25, 10, $lembar_produk['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 10, $lembar_produk['status'], 1, 1, 'C');

        $pdf->Cell(60, 10, 'Jurnal TA (pdf)', 1, 0);
        $pdf->Cell(65, 10, 'Admin Prodi', 1, 0, 'C');
        $pdf->Cell(25, 10, $jurnal['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 10, $jurnal['status'], 1, 1, 'C');

        $pdf->Cell(60, 10, 'Lembar Pengesahan', 1, 0);
        $pdf->Cell(65, 10, 'Admin Prodi', 1, 0, 'C');
        $pdf->Cell(25, 10, $pengesahan['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 10, $pengesahan['status'], 1, 1, 'C');

        $pdf->Cell(60, 10, 'Lembar Persetujuan', 1, 0);
        $pdf->Cell(65, 10, 'Admin Prodi', 1, 0, 'C');
        $pdf->Cell(25, 10, $persetujuan['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 10, $persetujuan['status'], 1, 1, 'C');

        $pdf->Cell(60, 10, 'Brosur Project Tugas Akhir', 1, 0);
        $pdf->Cell(65, 10, 'Admin Prodi', 1, 0, 'C');
        $pdf->Cell(25, 10, $brosur['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 10, $brosur['status'], 1, 1, 'C');

        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 5, 'Demikianlah tanda terima ini dibuat agar dapat digunakan sebagaimana mestinya.', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(13, 5, 'Tegal, ', 0, 0);
        $pdf->Cell(1, 5, tanggal_indo(), 0, 1);

        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(1, 5, 'Mengetahui,', 0, 1);
        $pdf->Cell(135, 5, 'Kepala Program Studi DIII Teknik Komputer', 0, 0);
        $pdf->Cell(1, 6, 'Mahasiswa', 0, 1);
        $pdf->Cell(1, 6, 'Politeknik Harapan Bersama Tegal', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(135, 5, 'Rais, S.Pd., M.Kom', 0, 0);
        $pdf->Cell(1, 6, $mahasiswa[0]['nama'], 0, 1);
        $pdf->Cell(135, 5, 'NIPY. 07.011.083', 0, 0);
        $pdf->Cell(10, 6, 'NIM. ', 0, 0);
        $pdf->Cell(1, 6, $mahasiswa[0]['nim'], 0, 1);


        $pdf->Output($mahasiswa[0]['nim'] . '_form_validasi.pdf', 'I');
    }

    private function _downloadKP($nim)
    {
        $mahasiswa = $this->mahasiswa->getOne($nim);
        $laporan_pdf = $this->laporan_pdf->getOne($nim);
        $pengesahan = $this->pengesahan->getOne($nim);

        if (!$laporan_pdf) {
            $laporan_pdf = [
                "tanggal" => "-",
                "status" => "-"
            ];
        } else {
            $laporan_pdf = [
                "tanggal" => date('d-m-Y', strtotime($laporan_pdf[0]['create_at'])),
                "status" => $laporan_pdf[0]['status']
            ];
        }

        if (!$pengesahan) {
            $pengesahan = [
                "tanggal" => "-",
                "status" => "-"
            ];
        } else {
            $pengesahan = [
                "tanggal" => date('d-m-Y', strtotime($pengesahan[0]['create_at'])),
                "status" => $pengesahan[0]['status']
            ];
        }

        $pdf = new FPDF('p', 'mm', 'A4');

        $pdf->AddPage();
        $pdf->SetFont('Times', '', 10);

        $pdf->Image('assets/uploads/poltek.png', 11, 17, 24, 24);

        $pdf->Image('assets/uploads/poltek_blur.png', 20, 65, 170, 170);
        $pdf->Image('assets/uploads/profile/' . $mahasiswa[0]['foto'], 165, 52, 28, 38);

        $pdf->Cell(135, 6, '', 0, 0);
        $pdf->Cell(10, 6, 'PM', 1, 0, 'C');
        $pdf->Cell(10, 6, 'P2M', 1, 0, 'C');
        $pdf->Cell(10, 6, 'PHB', 1, 0, 'C');
        $pdf->Cell(25, 6, '02.06.G.7.i.1', 1, 1, 'C');

        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(190, 5, 'Yayasan Pendidikan Harapan Bersama', 0, 1, 'C');

        $pdf->SetFont('Times', 'B', 14);
        $pdf->SetTextColor(220, 50, 50);

        $pdf->Cell(61, 6, '', 0, 0);
        $pdf->Cell(26, 5, 'PoliTeknik', 0, 0);
        $pdf->SetTextColor(0, 0, 255);
        $pdf->Cell(35, 5, 'Harapan Bersama', 0, 1);
        $pdf->SetTextColor(0);
        $pdf->Cell(190, 5, 'PROGRAM STUDI DIII TEKNIK KOMPUTER', 0, 1, 'C');
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(190, 5, 'Kampus I : Jl. Mataram No.9 Tegal 52142 Telp. 0283-352000 Fax. 00283353353', 0, 1, 'C');
        $pdf->Cell(190, 5, 'Website : www.poltektegal.ac.id       Email : komputer@poltektegal.ac.id', 0, 1, 'C');

        $pdf->SetLineWidth(1);
        $pdf->Line(10, 43, 200, 43);
        $pdf->SetLineWidth(0);
        $pdf->Line(10, 44, 200, 44);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetTextColor(0);

        $pdf->Ln(4);

        $pdf->Cell(190, 7, 'FORM VALIDASI PENYERAHAN LAPORAN KERJA PRAKTIK', 0, 1, 'C');

        $pdf->Cell(10, 2, '', 0, 1);

        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(1, 6, 'Admin akan mengecek berkas yang dikirim oleh user/mahasiswa', 0, 1);
        $pdf->Cell(35, 6, 'Nama', 0, 0);
        $pdf->Cell(4, 6, ':', 0, 0);
        $pdf->Cell(2, 6, $mahasiswa[0]['nama'], 0, 1);

        $pdf->Cell(35, 6, 'NIM', 0, 0);
        $pdf->Cell(4, 6, ': ', 0, 0);
        $pdf->Cell(2, 6, $mahasiswa[0]['nim'], 0, 1);

        $pdf->Cell(35, 6, 'Program Studi', 0, 0);
        $pdf->Cell(4, 6, ':', 0, 0);
        $pdf->Cell(2, 6, 'Teknik komputer', 0, 1);

        $pdf->Cell(35, 6, 'Pembimbing', 0, 0);
        $pdf->Cell(4, 6, ':', 0, 0);
        $pdf->Cell(2, 6, $mahasiswa[0]['dosbing_1'], 0, 1);

        $pdf->Ln(3);
        $pdf->Cell(35, 6, 'Penerima Laporan Kerja Praktik : ', 0, 1);

        $pdf->Ln(1);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(60, 12, 'Keterangan', 1, 0, 'C');
        $pdf->Cell(65, 12, 'Instansi / Jabatan', 1, 0, 'C');
        $pdf->Cell(25, 12, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(40, 12, 'Validasi/action', 1, 1, 'C');

        $pdf->SetFont('Arial', '', 12);

        $pdf->Cell(60, 10, 'Laporan KP (pdf)', 1, 0);
        $pdf->Cell(65, 10, 'Admin Prodi', 1, 0, 'C');
        $pdf->Cell(25, 10, $laporan_pdf['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 10, $laporan_pdf['status'], 1, 1, 'C');

        $pdf->Cell(60, 10, 'Lembar Pengesahan', 1, 0);
        $pdf->Cell(65, 10, 'Admin Prodi', 1, 0, 'C');
        $pdf->Cell(25, 10, $pengesahan['tanggal'], 1, 0, 'C');
        $pdf->Cell(40, 10, $pengesahan['status'], 1, 1, 'C');

        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 5, 'Demikianlah tanda terima ini dibuat agar dapat digunakan sebagaimana mestinya.', 0, 1);
        $pdf->Cell(1, 20, '', 0, 1);
        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(13, 5, 'Tegal, ', 0, 0);
        $pdf->Cell(1, 5, tanggal_indo(), 0, 1);

        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(1, 5, 'Mengetahui,', 0, 1);
        $pdf->Cell(135, 5, 'Kepala Program Studi DIII Teknik Komputer', 0, 0);
        $pdf->Cell(1, 6, 'Mahasiswa', 0, 1);
        $pdf->Cell(1, 6, 'Politeknik Harapan Bersama Tegal', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(1, 5, '', 0, 1);
        $pdf->Cell(135, 5, 'Rais, S.Pd., M.Kom', 0, 0);
        $pdf->Cell(1, 6, $mahasiswa[0]['nama'], 0, 1);
        $pdf->Cell(135, 5, 'NIPY. 07.011.083', 0, 0);
        $pdf->Cell(10, 6, 'NIM. ', 0, 0);
        $pdf->Cell(1, 6, $mahasiswa[0]['nim'], 0, 1);


        $pdf->Output($mahasiswa[0]['nim'] . '_form_validasi.pdf', 'I');
    }
}
        
    /* End of file  Dapur.php */