<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		redirect('user/beranda', 'refresh');

		// $this->load->view('create', array('error' => ' '));
	}

	// public function create()
	// {
	// 	$config['upload_path']          = './assets/uploads/';
	// 	$config['allowed_types']        = 'doc|docx|pdf';
	// 	$config['max_size']             = 2048;
	// 	$config['remove_spaces']		= TRUE;
	// 	// $config['max_width']            = 1024;
	// 	// $config['max_height']           = 768;

	// 	$this->load->library('upload', $config);

	// 	if (!$this->upload->do_upload('filename')) {
	// 		$error = array('error' => $this->upload->display_errors());

	// 		$this->load->view('create', $error);
	// 	} else {
	// 		$upload_data = $this->upload->data();

	// 		$data = [
	// 			"filename" => $upload_data['file_name']
	// 		];

	// 		$this->M_File->insert($data);

	// 		redirect('welcome', 'refresh');
	// 	}
	// }
}