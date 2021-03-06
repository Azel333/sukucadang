<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_user');
	}

	public function index()
	{
		$data['row']= $this->m_user->get();
		$this->template->load('template','user/userdata', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('fullname','Nama','required');
		$this->form_validation->set_rules('username','Username','required|min_length[5]|is_unique[tb_user.username]');
		$this->form_validation->set_rules('password','Password','required|min_length[5]');
		$this->form_validation->set_rules('passconf','Konfirmasi Password','required|matches[password]', 
			array('matches' => '%s tidak sesuai dengan password')
		);
		$this->form_validation->set_rules('jabatan','jabatan','required');

		$this->form_validation->set_message('required','%s masih kosong, silahkan isi');
		$this->form_validation->set_message('min_length','{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique','{field} ini sudah dipakai, silahkan ganti');

		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if ($this->form_validation->run() == FALSE) {
			$this->template->load('template','user/user_form_add');
		} else {
			$post = $this->input->post(null,TRUE);
			$this->m_user->add($post);
			if($this->db->affected_rows() > 0){
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			echo "<script>window.location='".site_url('user')."';</script>";
		}
	}

public function edit($id)
	{
		$this->form_validation->set_rules('fullname','Nama','required');
		$this->form_validation->set_rules('username','Username','required|min_length[5]|callback_username_check');
		if($this->input->post('password')){
			$this->form_validation->set_rules('password','Password','min_length[5]');
			$this->form_validation->set_rules('passconf','Konfirmasi Password','|matches[password]', 
			array('matches' => '%s tidak sesuai dengan password')
			);
		}
		
		if($this->input->post('passconf')){
			$this->form_validation->set_rules('passconf','Konfirmasi Password','matches[password]', 
			array('matches' => '%s tidak sesuai dengan password')
			);
		}
		$this->form_validation->set_rules('jabatan','jabatan','required');

		$this->form_validation->set_message('required','%s masih kosong, silahkan isi');
		$this->form_validation->set_message('min_length','{field} minimal 5 karakter');
		$this->form_validation->set_message('is_unique','{field} ini sudah dipakai, silahkan ganti');

		$this->form_validation->set_error_delimiters('<span class="help-block">','</span>');

		if ($this->form_validation->run() == FALSE) {
			$query = $data['row'] = $this->m_user->get($id);
			if($query->num_rows() > 0){
				$data['row'] = $query->row();
				$this->template->load('template','user/user_form_edit', $data);
				} else {
					echo "<script>alert('Data tidak ditemukan');";
					echo "window.location='".site_url('user')."';</script>";
			}
			
		} else {
			$post = $this->input->post(null,TRUE);
			$this->m_user->edit($post);
			if($this->db->affected_rows() > 0){
				echo "<script>alert('Data berhasil disimpan');</script>";
			}
			echo "<script>window.location='".site_url('user')."';</script>";
		}
	}
	function username_check(){
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM tb_user WHERE username = '$post[username]' AND id != '$post[id]'");
		if($query->num_rows() > 0) {
			$this->form_validation->set_message('username_check','{field} ini sudah dipakai, silahkan ganti');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	public function del($id){
		$this->m_user->del($id);
		if($this->db->affected_rows() > 0){
			echo "<script>alert('Data berhasil dihapus');</script>";
			}
			echo "<script>window.location='".site_url('user')."';</script>";
	}
}
