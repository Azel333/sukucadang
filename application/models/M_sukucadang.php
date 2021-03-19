<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_sukucadang extends CI_Model {
	public function get($id = null) 
	{
		$this->db->select('tb_sukucadang.*, tb_supplier.nama as supplier_nama');
		$this->db->from('tb_sukucadang');
		$this->db->join('tb_supplier', 'tb_supplier.id_supplier = tb_sukucadang. id_supplier');
		if($id != null){
			$this->db->where('id_sc',$id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function add($post)
	{
		$params = [
			'id_sc' => $post['id_sc'],
			'id_supplier' => $post['supplier'],
			'nama' => $post['nama'],
			'satuan' => $post['satuan'],
			'lokasi_rak' => $post['lokasi_rak'],
		];
		$this->db->insert('tb_sukucadang', $params);
	}
	public function process(){
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])){
			$this->m_sukucadang->add($post);
		} else if(isset($_POST['edit'])){
			$this->m_sukucadang->edit($post);
		}
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		}	
		required('sukucadang');
	}
	public function edit($post)
	{
		$params = [
			'id_sc' => $post['id_sc'],
			'id_supplier' => $post['supplier'],
			'nama' => $post['nama'],
			'satuan' => $post['satuan'],
			'lokasi_rak' => $post['lokasi_rak'],
		];
		$this->db->where('id_sc', $post['id']);
		$this->db->update('tb_sukucadang', $params);
	}
	
	function check_kode($code, $id = null){
		$this->db->from('tb_sukucadang');
		$this->db->where('id_sc', $code);
		if($id != null){
			$this->db->where('id_sc !=', $id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function del($id)
	{
		$this->db->where('id_sc', $id);
		$this->db->delete('tb_sukucadang');
		$this->db->where('id_sc', $id);
		$this->db->delete('tb_po_detail');
		$this->db->where('id_sc', $id);
		$this->db->delete('permintaan_detail');
		$this->db->where('id_sc', $id);
		$this->db->delete('t_stok');
	}
	function update_stock_in($data)
	{
		$params = array();
		$index = 0;
		for ($i = 0; $i < count($data['id_sc']); $i++) {
		$params = array(
			'jumlah' => $data['jumlah'][$index],
			'id_sc' =>$data['id_sc'][$index],
		);
		if ($params['jumlah']) {
			# code...
			$jumlah =$params['jumlah'];
			$id =$params['id_sc'];
			$sql = "UPDATE tb_sukucadang SET stok = stok + '$jumlah' WHERE id_sc = '$id'";
			$this->db->query($sql);
		} else {
			$this->session->set_flashdata('error', 'jumlah input melebihi maksimum');
		redirect('permintaan/data');
		}
	$index++;
};
	}
	function update_stock_out($jumlah, $id_sc)
	{
		$jumlah = $jumlah;
		$id = $id_sc;
		
		$sql = "UPDATE tb_sukucadang SET stok = stok - '$jumlah' WHERE id_sc = '$id'";

		$this->db->query($sql);

	}

	public function kode_otomatis()
  {
    $this->db->select('RIGHT(tb_sukucadang.id_sc,3) as kode', FALSE);
    $this->db->order_by('id_sc','DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_sukucadang');
    if ($query->num_rows()<>0)
    {
      $data=$query->row();
      $kode=intval($data->kode)+1;
    }
    else
    {
      $kode=1;
    }

    $kodemax=str_pad($kode,3,"0",STR_PAD_LEFT);
    $kodejadi='A'.$kodemax;

    return $kodejadi;
  }
}
