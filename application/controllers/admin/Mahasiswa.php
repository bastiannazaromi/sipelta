<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
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
        $this->load->model('M_Dosen', 'dosen');
    }

    public function index()
    {
        $data['title'] = 'List Mahasiswa';
        $data['page'] = 'admin/backend/mahasiswa';

        if ($this->u5 != '')
        {
            $tahun = dekrip($this->u5);
        }
        else
        {
            $tahun = $this->_tahunAkademik();
        }

        $data['mahasiswa'] = $this->mahasiswa->getAll(['semester' => dekrip($this->u4), 'tahun' => $tahun], 'tb_mahasiswa');
        $data['dosen'] = $this->dosen->getAll();
        $data['semester'] = $this->u4;
        $data['tahun']    = $this->mahasiswa->gruptahun();

        $this->session->set_userdata('previous_url', current_url());
        $this->load->view('admin/backend/index', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nim', 'NIM', 'required|trim|numeric|min_length[8]|max_length[8]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required|numeric|max_length[1]');
        $this->form_validation->set_rules('dosbing_1', 'Dosbing 1', 'required');

        $semester = htmlspecialchars($this->input->post('semester', TRUE));

        if ($semester == 4)
        {
            $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        }
        else
        {
            $this->form_validation->set_rules('dosbing_2', 'Dosbing 2', 'required');
            $this->form_validation->set_rules('kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('judul', 'Judul', 'required');
        }

        if ($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('toastr-error', validation_errors());
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        else
        {
            if ($semester == 4)
            {
                $dosbing2   = null;
                $kategori   = null;
                $judul      = null;
                $nama_instansi     = htmlspecialchars($this->input->post('nama_instansi', TRUE));
                $alamat     = htmlspecialchars($this->input->post('alamat', TRUE));
                $tahun      = $this->_tahunAkademik();
            }
            else
            {
                $dosbing2 = htmlspecialchars($this->input->post('dosbing_2', TRUE));
                $kategori = htmlspecialchars($this->input->post('kategori', TRUE));
                $judul    = htmlspecialchars($this->input->post('judul', TRUE));
                $nama_instansi   = null;
                $alamat   = null;
                $tahun    = $this->_tahunAkademik();
            }
            $data = [
                "nim"               => htmlspecialchars($this->input->post('nim', TRUE)),
                "password"          => password_hash($this->input->post('nim', TRUE), PASSWORD_DEFAULT),
                "nama"              => htmlspecialchars($this->input->post('nama', TRUE)),
                "semester"          => $semester,
                "judul"             => $judul,
                "kategori"          => $kategori,
                "dosbing_1"         => htmlspecialchars($this->input->post('dosbing_1', TRUE)),
                "dosbing_2"         => $dosbing2,
                "nama_instansi"     => $nama_instansi,
                "alamat"            => $alamat,
                "tahun"             => $tahun,
                "foto"              => 'default.jpg'
            ];
    
            $this->mahasiswa->tambah($data);
    
            $this->session->set_flashdata('toastr-sukses', 'Data berhasil ditambahkan');
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('nim', 'NIM', 'required|trim|numeric|min_length[8]|max_length[8]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required|numeric|max_length[1]');
        $this->form_validation->set_rules('dosbing_1', 'Dosbing 1', 'required');

        $semester = htmlspecialchars($this->input->post('semester', TRUE));

        if ($semester == 4)
        {
            $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        }
        else
        {
            $this->form_validation->set_rules('dosbing_2', 'Dosbing 2', 'required');
            $this->form_validation->set_rules('kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('judul', 'Judul', 'required');
        }

        if ($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('toastr-error', validation_errors());
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        else
        {
            if ($semester == 4)
            {
                $dosbing2 = null;
                $kategori = null;
                $judul = null;
                $nama_instansi     = htmlspecialchars($this->input->post('nama_instansi', TRUE));
                $alamat     = htmlspecialchars($this->input->post('alamat', TRUE));
            }
            else
            {
                $dosbing2 = htmlspecialchars($this->input->post('dosbing_2', TRUE));
                $kategori = htmlspecialchars($this->input->post('kategori', TRUE));
                $judul    = htmlspecialchars($this->input->post('judul', TRUE));
                $nama_instansi   = null;
                $alamat   = null;
            }
            $data = [
                "nim"               => htmlspecialchars($this->input->post('nim', TRUE)),
                "nama"              => htmlspecialchars($this->input->post('nama', TRUE)),
                "semester"          => $semester,
                "judul"             => $judul,
                "kategori"          => $kategori,
                "dosbing_1"         => htmlspecialchars($this->input->post('dosbing_1', TRUE)),
                "dosbing_2"         => $dosbing2,
                "nama_instansi"     => $nama_instansi,
                "alamat"            => $alamat
            ];

            $this->mahasiswa->edit($data);

            $this->session->set_flashdata('toastr-sukses', 'Data berhasil diupdate');
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);   
        }
    }

    private function _tahunAkademik()
    {
        $time = strtotime("-1 year", time());
        $date = date("Y", $time);

        return $date . "/" . date('Y');
    }

    public function resetPassword($id)
    {
        $this->db->where('id', $id);

        $data = $this->db->get('tb_mahasiswa')->result_array();

        $data = [
            "password" => password_hash($data[0]['nim'], PASSWORD_DEFAULT)
        ];

        $this->mahasiswa->resetPassword($data, $id);

        $this->session->set_flashdata('flash-sukses', 'Password berhasil direset');
        $previous_url = $this->session->userdata('previous_url');
        redirect($previous_url);
    }

    public function hapus($id)
    {
        $this->mahasiswa->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        $previous_url = $this->session->userdata('previous_url');
        redirect($previous_url);
    }

    public function import()
    {
        $this->form_validation->set_rules('ktgr', 'kategori', 'required|min_length[2]|max_length[2]');
        if ($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('toastr-error', validation_errors());
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        else {
            // Load plugin PHPExcel nya
            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

            $config['upload_path'] = realpath('excel');
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['max_size'] = '10000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('fileExcel')) {

                //upload gagal
                $this->session->set_flashdata('flash-error', 'Import gagal - ' . $this->upload->display_errors());
                //redirect halaman
                $previous_url = $this->session->userdata('previous_url');
                redirect($previous_url);
            } else {

                $data_upload = $this->upload->data();

                $excelreader     = new PHPExcel_Reader_Excel2007();
                $loadexcel         = $excelreader->load('excel/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
                $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

                $data = array();

                $kategori = $this->input->post('ktgr');

                if ($kategori == 'TA')
                {
                    $numrow = 1;
                    foreach ($sheet as $row) {
                        if ($numrow > 1) {
                            
                            $cek = $this->db->get_where('tb_mahasiswa', ['nim' => str_replace('\'', '', $row['B'])])->result_array();

                            if ($row['A'] != null) {
                                if (!$cek) {
                                    array_push($data, array(
                                        'nim' => htmlspecialchars(str_replace('\'', '', $row['B'])),
                                        'password' => password_hash(str_replace('\'', '', $row['B']), PASSWORD_DEFAULT),
                                        'nama'      => htmlspecialchars($row['C']),
                                        'semester'  => htmlspecialchars(str_replace('\'', '', $row['D'])),
                                        'judul'     => htmlspecialchars($row['G']),
                                        'kategori'  => htmlspecialchars($row['H']),
                                        'dosbing_1' => htmlspecialchars($row['E']),
                                        'dosbing_2' => htmlspecialchars($row['F']),
                                        'tahun'     => $this->_tahunAkademik(),
                                        'foto'      => 'default.jpg'
                                    ));
                                }
                            }
                        }
                        $numrow++;
                    }
                }
                elseif ($kategori == 'KP')
                {
                    $numrow = 1;
                    foreach ($sheet as $row) {
                        if ($numrow > 1) {
                            
                            $cek = $this->db->get_where('tb_mahasiswa', ['nim' => str_replace('\'', '', $row['B'])])->result_array();

                            if ($row['A'] != null) {
                                if (!$cek) {
                                    array_push($data, array(
                                        'nim' => htmlspecialchars(str_replace('\'', '', $row['B'])),
                                        'password' => password_hash(str_replace('\'', '', $row['B']), PASSWORD_DEFAULT),
                                        'nama'          => htmlspecialchars($row['C']),
                                        'semester'      => htmlspecialchars(str_replace('\'', '', $row['D'])),
                                        'dosbing_1'     => htmlspecialchars($row['E']),
                                        'nama_instansi' => htmlspecialchars($row['F']),
                                        'alamat'        => htmlspecialchars($row['G']),
                                        'tahun'         => $this->_tahunAkademik(),
                                        'foto'          => 'default.jpg'
                                    ));
                                }
                            }
                        }
                        $numrow++;
                    }
                }

                if (count($data) != 0) {
                    $this->db->insert_batch('tb_mahasiswa', $data);

                    $this->session->set_flashdata('flash-sukses', 'Data berhasil di import');
                }
                else
                {
                    $this->session->set_flashdata('flash-error', 'Gagal import ! Data kosong / sudah ada dalam database');
                }

                //delete file from server
                unlink(realpath('excel/' . $data_upload['file_name']));

                //redirect halaman
                $previous_url = $this->session->userdata('previous_url');
                redirect($previous_url);
            }
        }
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('flash-error', 'Pilih data yang akan dihapus !');
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        } else {
            $this->mahasiswa->multiple_delete($id);

            $this->session->set_flashdata('flash-sukses', 'Data berhasil di hapus');
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
    }
}