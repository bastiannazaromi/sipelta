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

    }

    public function index()
    {
        
    }

}

/* End of file Dosen.php */

?>