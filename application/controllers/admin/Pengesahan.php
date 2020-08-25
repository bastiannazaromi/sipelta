<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengesahan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Pengesahan', 'pengesahan');
    }

    public function index()
    {
        $data['title'] = 'List Lembar Pengesahan';
        $data['page'] = 'admin/backend/pengesahan';

        $data['pengesahan'] = $this->pengesahan->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function edit()
    {
        $data = [
            "status" => $this->input->post('status', TRUE)
        ];

        $this->pengesahan->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');
        redirect('admin/pengesahan');
    }

    public function hapus($id)
    {
        $this->pengesahan->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/pengesahan');
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('flash-error', 'Pilih data yang akan dihapus !');
            redirect('admin/pengesahan');
        } else {
            $this->pengesahan->multiple_delete($id);

            $this->session->set_flashdata('flash-sukses', 'Data berhasil di hapus');
            redirect('admin/pengesahan');
        }
    }
}