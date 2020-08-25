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

        $this->load->model('M_Mahasiswa', 'mahasiswa');
        $this->load->model('M_Dosen', 'dosen');
    }

    public function index()
    {
        $data['title'] = 'List Mahasiswa';
        $data['page'] = 'admin/backend/mahasiswa';

        $data['mahasiswa'] = $this->mahasiswa->getAll();
        $data['dosen'] = $this->dosen->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function tambah()
    {
        $data = [
            "nim" => htmlspecialchars($this->input->post('nim', TRUE)),
            "password" => password_hash($this->input->post('nim', TRUE), PASSWORD_DEFAULT),
            "nama" => htmlspecialchars($this->input->post('nama', TRUE)),
            "judul" => htmlspecialchars($this->input->post('judul', TRUE)),
            "kategori" => htmlspecialchars($this->input->post('kategori', TRUE)),
            "dosbing_1" => htmlspecialchars($this->input->post('dosbing_1', TRUE)),
            "dosbing_2" => htmlspecialchars($this->input->post('dosbing_2', TRUE)),
            "foto" => 'default.jpg'
        ];

        $this->mahasiswa->tambah($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil ditambahkan');
        redirect('admin/mahasiswa');
    }

    public function edit()
    {
        $data = [
            "nim" => htmlspecialchars($this->input->post('nim', TRUE)),
            "nama" => htmlspecialchars($this->input->post('nama', TRUE)),
            "judul" => htmlspecialchars($this->input->post('judul', TRUE)),
            "kategori" => htmlspecialchars($this->input->post('kategori', TRUE)),
            "dosbing_1" => htmlspecialchars($this->input->post('dosbing_1', TRUE)),
            "dosbing_2" => htmlspecialchars($this->input->post('dosbing_2', TRUE))
        ];

        $this->mahasiswa->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');
        redirect('admin/mahasiswa');
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
        redirect('admin/mahasiswa');
    }

    public function hapus($id)
    {
        $this->mahasiswa->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/mahasiswa');
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
                    array_push($data, array(
                        'nim' => htmlspecialchars(str_replace('\'', '', $row['B'])),
                        'password' => password_hash(str_replace('\'', '',  $row['B']), PASSWORD_DEFAULT),
                        'nama' => htmlspecialchars($row['C']),
                        'judul' => htmlspecialchars($row['F']),
                        'dosbing_1' => htmlspecialchars($row['D']),
                        'dosbing_2' => htmlspecialchars($row['E']),
                        'foto' => 'default.jpg'
                    ));
                }
                $numrow++;
            }
            $this->db->insert_batch('tb_mahasiswa', $data);
            //delete file from server
            unlink(realpath('excel/' . $data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('flash-sukses', 'Data berhasil di import');
            //redirect halaman
            redirect('admin/mahasiswa');
        }
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('flash-error', 'Pilih data yang akan dihapus !');
            redirect('admin/mahasiswa');
        } else {
            $this->mahasiswa->multiple_delete($id);

            $this->session->set_flashdata('flash-sukses', 'Data berhasil di hapus');
            redirect('admin/mahasiswa');
        }
    }
}