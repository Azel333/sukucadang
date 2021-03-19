<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function login($post)
	{
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('username', $post['username']);
		$this->db->where('password', $post['password']);
		$query = $this->db->get();
		return $query;
	}

	public function get($id = null) 
	{
		$this->db->from('tb_user');
		if($id != null){
			$this->db->where('id',$id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function add($post)
	{
		$params['nama'] = $post['fullname'];
		$params['username'] = $post['username'];
		$params['password'] = $post['password'];
		$params['jabatan'] = $post['jabatan'];
		$this->db->insert('tb_user',$params);
	}
	public function edit($post)
	{
		$params['nama'] = $post['fullname'];
		$params['username'] = $post['username'];
		if(!empty($post['password'])) {
		$params['password'] = ($post['password']);

		}
		$params['jabatan'] = $post['jabatan'];
		$this->db->where('id',$post['id']);
		$this->db->update('tb_user', $params);
	}
	
	public function del($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tb_user');
	}
}