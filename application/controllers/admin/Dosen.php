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
        $this->load->model('M_Universal', 'universal');
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
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nipy', 'NIPY', 'required');
        $this->form_validation->set_rules('nidn', 'NIDN', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('toastr-error', validation_errors());
            redirect('admin/dosen');
        } else {
            $data = [
                "nama"          => htmlspecialchars($this->input->post('nama', TRUE)),
                "nipy"          => htmlspecialchars($this->input->post('nipy', TRUE)),
                "nidn"          => htmlspecialchars($this->input->post('nidn', TRUE)),
                "username"      => htmlspecialchars($this->input->post('username', TRUE)),
                "password"      => password_hash('dosen', PASSWORD_DEFAULT),
                'foto'          => 'default.jpg'
            ];

            $this->dosen->tambah($data);

            $this->session->set_flashdata('toastr-sukses', 'Data berhasil ditambahkan');
            redirect('admin/dosen');
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nipy', 'NIPY', 'required');
        $this->form_validation->set_rules('nidn', 'NIDN', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('toastr-error', validation_errors());
            redirect('admin/dosen');
        } else {
            $data = [
                "nama"          => htmlspecialchars($this->input->post('nama', TRUE)),
                "nipy"          => htmlspecialchars($this->input->post('nipy', TRUE)),
                "nidn"          => htmlspecialchars($this->input->post('nidn', TRUE)),
                "username"      => htmlspecialchars($this->input->post('username', TRUE))
            ];

            $this->dosen->edit($data);

            $this->session->set_flashdata('toastr-sukses', 'Data berhasil diupdate');
            redirect('admin/dosen');
        }
    }

    public function resetPassword($id)
    {
        $id = dekrip($id);

        $data = ['password' => password_hash('dosen', PASSWORD_DEFAULT)];

        $update = $this->universal->update($data, ['id' => $id], 'tb_dosen');

        if ($update) {
            $this->session->set_flashdata('toastr-sukses', 'Password berhasil direset');
            redirect('admin/dosen');
        } else {
            $this->session->set_flashdata('toastr-error', 'Password gagal direset');
            redirect('admin/dosen');
        }
    }

    public function hapus($id)
    {
        $this->dosen->hapus($id);
        $this->session->set_flashdata('toastr-sukses', 'Data berhasil dihapus');
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
                                'username' => htmlspecialchars(str_replace('\'', '', $row['E'])),
                                'password' => password_hash(str_replace('\'', '', 'dosen'), PASSWORD_DEFAULT),
                                'foto'          => 'default.jpg'
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
            $this->session->set_flashdata('toastr-sukses', 'Data berhasil di import');
            //redirect halaman
            redirect('admin/dosen');
        }
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('toastr-error', 'Pilih data yang akan dihapus !');
            redirect('admin/dosen');
        } else {
            $this->dosen->multiple_delete($id);

            $this->session->set_flashdata('toastr-sukses', 'Data berhasil di hapus');
            redirect('admin/dosen');
        }
    }
}