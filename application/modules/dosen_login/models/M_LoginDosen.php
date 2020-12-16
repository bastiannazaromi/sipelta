<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_LoginDosen extends CI_Model {

    public function cek_login($u, $p)
	{
		$this->db->where('username', $u);
		$query = $this->db->get('tb_dosen');
		$data = $query->result_array();

		if (count($data) === 1) {
			if (password_verify($p, $data[0]['password'])) {
				$login		=	array(
					'is_logged_in'	=> 	true,
					'username'	    =>	$u,
					'id'			=>	$data[0]['id'],
                    'nama'			=>	$data[0]['nama'],
                    'nipy'			=>	$data[0]['nipy'],
                    'nidn'			=>	$data[0]['nidn'],
                    'foto'			=>	$data[0]['foto'],
				);
				if ($login) {
					$this->session->set_userdata('dosen_login', $login);
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

/* End of file M_LoginDosen.php */

?>