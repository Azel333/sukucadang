<?php

Class Fungsi {

	protected $ci;

	public function __construct(){
		$this->ci =& get_instance();
	}

	function user_login(){
		$this->ci->load->model('m_user');
		$id = $this->ci->session->userdata('id');
		$userdata = $this->ci->m_user->get($id)->row();
		return $userdata;
	}
}