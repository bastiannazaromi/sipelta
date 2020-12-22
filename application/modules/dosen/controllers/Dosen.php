<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('dosen_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('dosen/login', 'refresh');
        }

        $this->u2		= $this->uri->segment(2);
        $this->u3		= $this->uri->segment(3);
        $this->u4		= $this->uri->segment(4);
        $this->u5		= $this->uri->segment(5);
        $this->u6		= $this->uri->segment(6);
        $this->u7		= $this->uri->segment(7);

        $this->load->model('M_Dsn', 'dosen');
    }

    public function index()
    {
        
    }

}

/* End of file Dosen.php */

?>