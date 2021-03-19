<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
		check_already_login();
		$this->load->view('login');
	}

public function process()
	{
		$post =$this->input->post(null,TRUE);
		 if(isset($post['login'])) {
		 	$this->load->model('m_user');
		 	$query = $this->m_user->login($post);
		 	if($query->num_rows() > 0){
		 		$row = $query->row();
		 		$params = array(
		 			'id' => $row->id,
		 			'jabatan' => $row->jabatan
		 		);
		 		$this->session->set_userdata($params);
		 		echo "<script>
		 		alert('Selamat, login berhasil'); window.location='".site_url('dashboard')."';
		 		</script>";
		 	}else {
		 		echo"<script>
		 		alert('Login gagal, username / password salah'); window.location='".site_url('auth/login')."';
		 			</script>";
		 	}
		}
	}
	
	function logout(){
		$params = array('id', 'jabatan');
		$this->session->unset_userdata($params);
		// Destroy session
		$this->session->sess_destroy();

		// Recreate session
		session_start();
		$this->session->sess_regenerate(TRUE);
		redirect('auth/login');
	}
}
