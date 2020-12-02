<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->load->model('M_Mahasiswa', 'mahasiswa');
        $this->load->model('M_Dosen', 'dosen');
        $this->load->model('M_Jurnal', 'jurnal');
        $this->load->model('M_Laporan_pdf', 'laporan_pdf');
        $this->load->model('M_Lembar_produk', 'lembar_produk');
        $this->load->model('M_Pengesahan', 'pengesahan');
        $this->load->model('M_Persetujuan', 'persetujuan');
        $this->load->model('M_Brosur', 'brosur');

        $this->load->model('M_Admin', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['page'] = 'admin/backend/dashboard';

        $data['mahasiswa'] = count($this->mahasiswa->getAll('', 'tb_mahasiswa'));
        $data['dosen'] = count($this->dosen->getAll());
        $data['admin'] = count($this->admin->getAll());
        $data['jurnal'] = count($this->jurnal->getAll());
        $data['laporan_pdf'] = count($this->laporan_pdf->getAll());
        $data['lembar_produk'] = count($this->lembar_produk->getAll());
        $data['pengesahan'] = count($this->pengesahan->getAll());
        $data['persetujuan'] = count($this->persetujuan->getAll());
        $data['brosur'] = count($this->brosur->getAll());

        $this->load->view('admin/backend/index', $data);
    }
}
        
    /* End of file  Dashboard.php */