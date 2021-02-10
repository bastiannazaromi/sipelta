<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model
{
	function cek_login($u, $p)
	{
		$this->db->where('username', $u);
		$query = $this->db->get('tb_admin');
		$data = $query->result();

		if (count($data) === 1) {
			if (password_verify($p, $data[0]->password)) {
				$login		=	array(
					'is_logged_in'	=> 	true,
					'username'		=>	$u,
					'id'			=>	$data[0]->id,
					'nama'			=>	$data[0]->nama
				);
				if ($login) {
					$this->session->set_userdata('data_login', $login);
					$this->session->set_userdata($login);
					return 'Valid';
				}
			} else {
				return 'Password Salah';
			}
		} else {
			return 'Username tidak terdaftar';
		}
	}
}