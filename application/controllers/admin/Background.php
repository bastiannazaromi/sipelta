<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Background extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Background', 'background');
    }

    public function index()
    {
        $data['title'] = 'Background Frontend';
        $data['page'] = 'admin/backend/background';

        $data['background'] = $this->background->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function tambah()
    {
        $config['upload_path']          = './assets/uploads/bg';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 5120; // 5 mb
        $config['remove_spaces']        = TRUE;
        $config['file_name']            = $_FILES["filebg"]['name'];
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filebg')) {

            $this->session->set_flashdata('flash-error', $this->upload->display_errors());

            redirect('admin/background', 'refresh');
        } else {
            $upload_data = $this->upload->data();

            $data = [
                "bg" => $upload_data['file_name'],
                "deskripsi" => htmlspecialchars($this->input->post('deskripsi', TRUE))
            ];

            $this->db->insert('tb_bg', $data);

            $this->session->set_flashdata('flash-sukses', 'Gambar berhasil ditambahkan');

            redirect('admin/background', 'refresh');
        }
    }

    public function edit()
    {
        $config['upload_path']          = './assets/uploads/bg';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 5120; // 5 mb
        $config['remove_spaces']        = TRUE;
        $config['file_name']            = $_FILES["filebg"]['name'];
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('filebg')) {

            $data = [
                "deskripsi" => htmlspecialchars($this->input->post('deskripsi', TRUE))
            ];

            $this->background->edit($data);

            $this->session->set_flashdata('flash-sukses', 'Edit deskripsi berhasil');

            redirect('admin/background', 'refresh');
        } else {
            $upload_data = $this->upload->data();

            $bg = $this->background->getOne($this->input->post('id', TRUE));

            $data = [
                "bg" => $upload_data['file_name'],
                "deskripsi" => htmlspecialchars($this->input->post('deskripsi', TRUE))
            ];

            unlink(FCPATH . 'assets/uploads/bg/' . $bg[0]['bg']);

            $this->background->edit($data);

            $this->session->set_flashdata('flash-sukses', 'Edit gambar berhasil');

            redirect('admin/background', 'refresh');
        }
    }

    public function hapus($id)
    {
        $this->background->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/background');
    }
}