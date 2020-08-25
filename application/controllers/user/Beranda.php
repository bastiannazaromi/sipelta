<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // if (empty($this->session->userdata('user_login'))) {
        //     $this->session->set_flashdata('flash-error', 'Anda Belum Login');
        //     redirect('user/Login', 'refresh');
        // }

        $this->load->model('M_Mahasiswa', 'mahasiswa');
        $this->load->model('M_Background', 'background');
        $this->load->model('M_About', 'about');
        $this->load->model('M_Galery', 'galery');

        $this->load->library('pdf');
    }

    public function index()
    {
        $data['title'] = 'SIPESTA';

        $nim = $this->session->userdata('nim');
        $data['mahasiswa'] = $this->mahasiswa->getOne($nim);

        $data['bg_header'] = $this->background->getHeader();
        $data['bg_content'] = $this->background->getContent();
        $data['galery'] = $this->galery->getAll();

        $data['about'] = $this->about->getAll();

        $this->load->view('user/frontend/beranda', $data);
    }
}
        
    /* End of file  Beranda.php */