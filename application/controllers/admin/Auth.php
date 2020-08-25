<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('data_login'))) {
            if ($this->uri->segment(3) != 'logout') {
                $this->session->set_flashdata('flash-error', 'Anda Sudah Login');
                redirect('admin/dashboard');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'Halaman Login';
        $this->load->view('admin/auth/index', $data, FALSE);
    }

    public function login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");

        $this->load->model('M_Auth');
        $data['status'] = $this->M_Auth->cek_login($username, $password);
        $data['token'] = $this->security->get_csrf_hash();

        echo json_encode($data);
    }

    public function logout()
    {
        $this->session->sess_destroy($this->session->userdata('data_login'));
        redirect('admin/auth', 'refresh');
    }
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */