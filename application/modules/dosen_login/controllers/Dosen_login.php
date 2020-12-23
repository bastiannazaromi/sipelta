<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!empty($this->session->userdata('dosen_login'))) {
            if ($this->uri->segment(2) != 'logout') {
                $this->session->set_flashdata('flash-error', 'Anda Sudah Login');
                redirect('dosen');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'Dosen Login';
        $this->load->view('login', $data);
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]', [
            'required' => 'Username tidak boleh kosong !',
            'min_length' => 'Username kurang dari 3 digit !'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
            'required' => 'Password harap di isi !',
            'min_length' => 'Password kurang dari 3'
        ]);

        if ($this->form_validation->run() == false) {

            if (form_error('username', '-- ', ' --')) {
                $data['status'] = form_error('username', '-- ', ' --');
            } else {
                $data['status'] = form_error('password', '-- ', ' --');
            }

            $data['token'] = $this->security->get_csrf_hash();

            echo json_encode($data);
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            $this->load->model('M_LoginDosen', 'login');
            $data['status'] = $this->login->cek_login($username, $password);
            $data['token'] = $this->security->get_csrf_hash();

            echo json_encode($data);
        }
    }

    public function logout()
    {
        $this->session->sess_destroy($this->session->userdata('dosen_login'));
        redirect('dosen/login', 'refresh');
    }

}

/* End of file Dosen_login.php */

?>