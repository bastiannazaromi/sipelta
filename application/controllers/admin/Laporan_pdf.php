<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_pdf extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Laporan_pdf', 'laporan_pdf');
    }

    public function index()
    {
        $data['title'] = 'List Laporan PDF';
        $data['page'] = 'admin/backend/laporan_pdf';

        $data['laporan_pdf'] = $this->laporan_pdf->getAll();

        $this->load->view('admin/backend/index', $data);
    }

    public function edit()
    {
        $data = [
            "status" => $this->input->post('status', TRUE)
        ];

        $this->laporan_pdf->edit($data);

        $this->session->set_flashdata('flash-sukses', 'Data berhasil diupdate');
        redirect('admin/laporan_pdf');
    }

    public function hapus($id)
    {
        $this->laporan_pdf->hapus($id);
        $this->session->set_flashdata('flash-sukses', 'Data berhasil dihapus');
        redirect('admin/laporan_pdf');
    }

    public function multiple_delete()
    {
        $id = $this->input->post('id');
        if ($id == NULL) {
            $this->session->set_flashdata('flash-error', 'Pilih data yang akan dihapus !');
            redirect('admin/laporan_pdf');
        } else {
            $this->laporan_pdf->multiple_delete($id);

            $this->session->set_flashdata('flash-sukses', 'Data berhasil di hapus');
            redirect('admin/laporan_pdf');
        }
    }
}