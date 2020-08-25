<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Persetujuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Persetujuan', 'persetujuan');
    }

    public function index()
    {
        $data['title'] = 'List Lembar Persetujuan';
        $data['page'] = 'admin/backend/persetujuan';

        $data['persetujuan'] = $this->persetujuan->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function edit()
    {
        $data = [
            "status" => $this->input->post('status', TRUE)
        ];

        $this->persetujuan->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');
        redirect('admin/persetujuan');
    }

    public function hapus($id)
    {
        $this->persetujuan->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/persetujuan');
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('flash-error', 'Pilih data yang akan dihapus !');
            redirect('admin/persetujuan');
        } else {
            $this->persetujuan->multiple_delete($id);

            $this->session->set_flashdata('flash-sukses', 'Data berhasil di hapus');
            redirect('admin/persetujuan');
        }
    }
}