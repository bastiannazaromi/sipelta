<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jurnal extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Jurnal', 'jurnal');
    }

    public function index()
    {
        $data['title'] = 'List Jurnal PDF';
        $data['page'] = 'admin/backend/jurnal';

        $data['jurnal'] = $this->jurnal->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function edit()
    {
        $data = [
            "status" => $this->input->post('status', TRUE)
        ];

        $this->jurnal->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');
        redirect('admin/jurnal');
    }

    public function hapus($id)
    {
        $this->jurnal->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/jurnal');
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('flash-error', 'Pilih data yang akan dihapus !');
            redirect('admin/jurnal');
        } else {
            $this->jurnal->multiple_delete($id);

            $this->session->set_flashdata('flash-sukses', 'Data berhasil di hapus');
            redirect('admin/jurnal');
        }
    }
}