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

        $this->u2		= $this->uri->segment(2);
        $this->u3		= $this->uri->segment(3);
        $this->u4		= $this->uri->segment(4);
        $this->u5		= $this->uri->segment(5);
        $this->u6		= $this->uri->segment(6);
        $this->u7		= $this->uri->segment(7);

        $this->load->model('M_Laporan_pdf', 'laporan_pdf');
    }

    public function index()
    {
        $data['title']      = 'List Laporan PDF';
        $data['page']       = 'admin/backend/laporan_pdf';
        $data['kategori']   = $this->u3;
        $data['tahun']      = $this->laporan_pdf->gruptahun();

        if ($this->u4 == '')
        {
            $tahun = tahunAkademik();
        }
        else
        {
            $tahun = dekrip($this->u4);
        }

        $data['laporan_pdf'] = $this->laporan_pdf->getAll(['tb_laporan_pdf.kategori' => $this->u3, 'tb_mahasiswa.tahun' => $tahun]);

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