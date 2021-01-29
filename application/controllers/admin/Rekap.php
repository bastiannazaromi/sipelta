<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('data_login'))) {
            $this->session->set_flashdata('flash-error', 'Anda Belum Login');
            redirect('admin/auth', 'refresh');
        }

        $this->u2        = $this->uri->segment(2);
        $this->u3        = $this->uri->segment(3);
        $this->u4        = $this->uri->segment(4);
        $this->u5        = $this->uri->segment(5);
        $this->u6        = $this->uri->segment(6);
        $this->u7        = $this->uri->segment(7);

        $this->load->model('M_Rekap', 'rekap');
    }

    public function index()
    {
        $semester = dekrip($this->u3);
        if ($this->u4 == '') {
            $tahun  = $this->_tahunAkademik();
        } else {
            $tahun  = dekrip($this->u4);
        }

        $data['title']      = 'Rekap data upload berkas';
        $data['page']       = 'admin/backend/rekap';
        $data['semester']   = $this->u3;
        $data['tahun']      = $this->rekap->gruptahun(['semester' => $semester]);
        $data['th_ini']     = $tahun;

        if ($semester == 4) {
            $data['rekap']      = $this->rekap->getKP($tahun);
        } else {
            $data['rekap']      = $this->rekap->getTA($tahun);
        }

        $this->session->set_userdata('previous_url', current_url());
        $this->load->view('admin/backend/index', $data);
    }

    private function _tahunAkademik()
    {
        $time = strtotime("-1 year", time());
        $date = date("Y", $time);

        return $date . "/" . date('Y');
    }
}

/* End of file Rekap.php */