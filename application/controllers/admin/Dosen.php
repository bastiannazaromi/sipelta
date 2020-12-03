<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Dosen', 'dosen');
    }

    public function index()
    {
        $data['title'] = 'List Dosen';
        $data['page'] = 'admin/backend/dosen';

        $data['dosen'] = $this->dosen->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function tambah()
    {
        $data = [
            "nama" => htmlspecialchars($this->input->post('nama', TRUE)),
            "nipy" => htmlspecialchars($this->input->post('nipy', TRUE)),
            "nidn" => htmlspecialchars($this->input->post('nidn', TRUE))
        ];

        $this->dosen->tambah($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil ditambahkan');
        redirect('admin/dosen');
    }

    public function edit()
    {
        $data = [
            "nama" => htmlspecialchars($this->input->post('nama', TRUE)),
            "nipy" => htmlspecialchars($this->input->post('nipy', TRUE)),
            "nidn" => htmlspecialchars($this->input->post('nidn', TRUE))
        ];

        $this->dosen->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');
        redirect('admin/dosen');
    }

    public function hapus($id)
    {
        $this->dosen->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/dosen');
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
            redirect('admin/dosen');
        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/' . $data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

            $data = array();

            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    $cek = $this->db->get_where('tb_dosen', ['nama' => str_replace('\'', '', $row['B'])])->result_array();

                    if ($row['A'] != null) {
                        if (!$cek) {
                            array_push($data, array(
                                'nama' => htmlspecialchars($row['B']),
                                'nipy' => htmlspecialchars(str_replace('\'', '', $row['C'])),
                                'nidn' => htmlspecialchars(str_replace('\'', '', $row['D'])),
                            ));
                        }
                    }
                }
                $numrow++;
            }
            $this->db->insert_batch('tb_dosen', $data);
            //delete file from server
            unlink(realpath('excel/' . $data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('flash-sukses', 'Data berhasil di import');
            //redirect halaman
            redirect('admin/dosen');
        }
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('flash-error', 'Pilih data yang akan dihapus !');
            redirect('admin/dosen');
        } else {
            $this->dosen->multiple_delete($id);

            $this->session->set_flashdata('flash-sukses', 'Data berhasil di hapus');
            redirect('admin/dosen');
        }
    }
}