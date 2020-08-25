<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Galery extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Galery', 'galery');
    }

    public function index()
    {
        $data['title'] = 'Galery Beranda';
        $data['page'] = 'admin/backend/galery';

        $data['galery'] = $this->galery->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function tambah()
    {
        $config['upload_path']          = './assets/uploads/galery';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 5120; // 5 mb
        $config['remove_spaces']        = TRUE;
        $config['file_name']            = $_FILES["filegalery"]['name'];
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filegalery')) {

            $this->session->set_flashdata('flash-error', $this->upload->display_errors());

            redirect('admin/galery', 'refresh');
        } else {
            $upload_data = $this->upload->data();

            $data = [
                "galery" => $upload_data['file_name']
            ];

            $this->db->insert('tb_galery', $data);

            $this->session->set_flashdata('flash-sukses', 'Gambar berhasil ditambahkan');

            redirect('admin/galery', 'refresh');
        }
    }

    public function hapus($id)
    {
        $this->galery->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/galery');
    }
}