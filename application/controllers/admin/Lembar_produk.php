<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lembar_produk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Lembar_produk', 'lembar_produk');
    }

    public function index()
    {
        $data['title'] = 'List Lembar Penyerahan Produk';
        $data['page'] = 'admin/backend/lembar_produk';

        $data['lembar_produk'] = $this->lembar_produk->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function edit()
    {
        $data = [
            "status" => $this->input->post('status', TRUE)
        ];

        $this->lembar_produk->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');
        redirect('admin/lembar_produk');
    }

    public function hapus($id)
    {
        $this->lembar_produk->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/lembar_produk');
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('flash-error', 'Pilih data yang akan dihapus !');
            redirect('admin/lembar_produk');
        } else {
            $this->lembar_produk->multiple_delete($id);

            $this->session->set_flashdata('flash-sukses', 'Data berhasil di hapus');
            redirect('admin/lembar_produk');
        }
    }
}