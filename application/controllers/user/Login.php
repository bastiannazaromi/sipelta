<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('user_login'))) {
            if ($this->uri->segment(3) != 'logout') {
                $this->session->set_flashdata('flash-error', 'Anda Sudah Login');
                redirect('user/beranda');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Login';
        $this->load->view('user/login/index', $data, FALSE);
    }

    public function login()
    {
        $nim = $this->input->post("nim");
        $password = $this->input->post("password");

        $this->load->model('M_Login');
        $data['status'] = $this->M_Login->cek_login($nim, $password);
        $data['token'] = $this->security->get_csrf_hash();

        echo json_encode($data);
    }

    public function logout()
    {
        $this->session->sess_destroy($this->session->userdata('user_login'));
        redirect('user/login', 'refresh');
    }
}