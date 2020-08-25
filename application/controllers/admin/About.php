<?php

defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_About', 'about');
    }

    public function index()
    {
        $data['title'] = 'About';
        $data['page'] = 'admin/backend/about';

        $data['about'] = $this->about->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function tambah()
    {
        $data = [
            "deskripsi" => htmlspecialchars($this->input->post('deskripsi', TRUE))
        ];

        $this->about->tambah($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil ditambahkan');

        redirect('admin/about', 'refresh');
    }

    public function edit()
    {
        $data = [
            "deskripsi" => htmlspecialchars($this->input->post('deskripsi', TRUE))
        ];

        $this->about->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');

        redirect('admin/about', 'refresh');
    }

    public function hapus($id)
    {
        $this->about->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/about');
    }
}