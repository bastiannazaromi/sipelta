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

        $data['mahasiswa'] = $this->mahasiswa->getAll(dekrip($this->u4), 'tb_mahasiswa');
        $data['dosen'] = $this->dosen->getAll();

        $this->session->set_userdata('previous_url', current_url());

        $this->load->view('admin/backend/index', $data);
    }

    public function tambah()
    {
        $semester = htmlspecialchars($this->input->post('semester', TRUE));
        if ($semester == 4)
        {
            $dosbing2 = null;
            $kategori = null;
        }
        else
        {
            $dosbing2 = htmlspecialchars($this->input->post('dosbing_2', TRUE));
            $kategori = htmlspecialchars($this->input->post('kategori', TRUE));
        }
        $data = [
            "nim" => htmlspecialchars($this->input->post('nim', TRUE)),
            "password" => password_hash($this->input->post('nim', TRUE), PASSWORD_DEFAULT),
            "nama" => htmlspecialchars($this->input->post('nama', TRUE)),
            "semester" => $semester,
            "judul" => htmlspecialchars($this->input->post('judul', TRUE)),
            "kategori" => $kategori,
            "dosbing_1" => htmlspecialchars($this->input->post('dosbing_1', TRUE)),
            "dosbing_2" => $dosbing2,
            "foto" => 'default.jpg'
        ];

        $this->mahasiswa->tambah($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil ditambahkan');
        $previous_url = $this->session->userdata('previous_url');
        redirect($previous_url);
    }

    public function edit()
    {
        $semester = htmlspecialchars($this->input->post('semester', TRUE));
        if ($semester == 4)
        {
            $dosbing2 = null;
            $kategori = null;
        }
        else
        {
            $dosbing2 = htmlspecialchars($this->input->post('dosbing_2', TRUE));
            $kategori = htmlspecialchars($this->input->post('kategori', TRUE));
        }
        $data = [
            "nim" => htmlspecialchars($this->input->post('nim', TRUE)),
            "nama" => htmlspecialchars($this->input->post('nama', TRUE)),
            "semester" => $semester,
            "judul" => htmlspecialchars($this->input->post('judul', TRUE)),
            "kategori" => $kategori,
            "dosbing_1" => htmlspecialchars($this->input->post('dosbing_1', TRUE)),
            "dosbing_2" => $dosbing2
        ];

        $this->mahasiswa->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');
        $previous_url = $this->session->userdata('previous_url');
        redirect($previous_url);
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
            redirect('admin/mahasiswa');
        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

            $data = array();

            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    
                    $cek = $this->db->get_where('tb_mahasiswa', ['nim' => str_replace('\'', '', $row['B'])])->result_array();

                    if ($row['A'] != null) {
                        if (!$cek) {
                            array_push($data, array(
                                'nim' => htmlspecialchars(str_replace('\'', '', $row['B'])),
                                'password' => password_hash(str_replace('\'', '', $row['B']), PASSWORD_DEFAULT),
                                'nama' => htmlspecialchars($row['C']),
                                'semester' => htmlspecialchars(str_replace('\'', '', $row['D'])),
                                'judul' => htmlspecialchars($row['G']),
                                'kategori' => htmlspecialchars($row['H']),
                                'dosbing_1' => htmlspecialchars($row['E']),
                                'dosbing_2' => htmlspecialchars($row['F']),
                                'foto' => 'default.jpg'
                            ));
                        }
                    }
                }
                $numrow++;
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