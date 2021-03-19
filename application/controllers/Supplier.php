<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model('m_supplier');

	}
	public function index()
	{
		$data['row'] = $this->m_supplier->get();
		$supplier = $this->m_supplier->get()->result();
		$this->template->load('template', 'supplier/supplier_data', $data);
	}
	public function add(){
		$supplier = new stdClass();
		$supplier->id_supplier = null;
		$supplier->nama = null;
		$supplier->alamat = null;
		$supplier->telepon = null;
		$data = array(
			'page' => 'add',
			'row' => $supplier
		);
		$this->template->load('template', 'supplier/supplier_form',$data);
	}
	public function edit ($id)
	{
		$query = $this->m_supplier->get($id);
		if($query->num_rows() > 0){
			$supplier = $query->row();
			$data = array(
			'page' => 'edit',
			'row' => $supplier
		);
		$this->template->load('template', 'supplier/supplier_form',$data);
		}else{
		// echo "<script>alert('Data tidak ditemukan');";
			$this->session->set_flashdata('error', 'Data tidak ditemukan');
					// echo "window.location='".site_url('supplier')."';</script>";
			redirect('supplier');
		}
	}
	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])){
			$this->m_supplier->add($post);
		} else if(isset($_POST['edit'])){
			$this->m_supplier->edit($post);
		}

		if($this->db->affected_rows() > 0){
			// echo "<script>alert('Data berhasil disimpan');</script>";
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}
			// echo "<script>window.location='".site_url('supplier')."';</script>";
			redirect('supplier');
	}
	public function del ($id)
	{
		$this->m_supplier->del($id);
		// if($this->db->affected_rows() > 0){
			// echo "<script>alert('Data berhasil dihapus');</script>";
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		// }
			// echo "<script>window.location='".site_url('supplier')."';</script>";
		redirect('supplier');
	}
}