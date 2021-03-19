<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_stok extends CI_Model {

	public function get($id = null)
	{
		// $this->db->select('t_stok');
		$this->db->from('t_stok');
		if($id != null){
			$this->db->where('id_stok', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function nostok()
	{
		$sql = "SELECT MAX(MID(no_stok,9,4)) AS nostok
				FROM t_stok
				WHERE MID(no_stok,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n = ((int)$row->nostok) + 1;
			$no = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$no_stok = "PN" . date('ymd') . $no;
		return $no_stok;
	}

	public function del($id){
		$this->db->where('id_stok', $id);
		$this->db->delete('t_stok');
	}
	public function get_stock_in()
	{
		$this->db->select('t_stok.id_stok, tb_sukucadang.id_sc, tb_sukucadang.nama as nama_sc, jumlah, no_stok, tanggal, detail, tipe, tb_supplier.nama as nama_supplier, tb_sukucadang.id_sc');
		$this->db->from('t_stok');
		$this->db->join('tb_sukucadang', 't_stok.id_sc = tb_sukucadang.id_sc');
		$this->db->join('tb_supplier', 't_stok.id_supplier= tb_supplier.id_supplier', 'left');
		$this->db->where('type', 'in');
		$this->db->order_by('id_stok', 'dsc');
		$query = $this->db->get();
		return $query;
	}

	public function get_stock_in1($bulan, $tahun)
	{
		$this->db->select('t_stok.id_stok, tb_sukucadang.id_sc, tb_sukucadang.nama as nama_sc, jumlah, tipe, no_stok, tanggal, detail, tb_supplier.nama as nama_supplier, tb_sukucadang.id_sc');
		$this->db->from('t_stok');
		$this->db->join('tb_sukucadang', 't_stok.id_sc = tb_sukucadang.id_sc');
		$this->db->join('tb_supplier', 't_stok.id_supplier= tb_supplier.id_supplier', 'left');
		$this->db->where('type', 'in');
		$this->db->where('MONTH(tanggal)', $bulan);
		$this->db->where('YEAR(tanggal)', $tahun);
		$this->db->order_by('id_stok', 'dsc');
		$query = $this->db->get();
		return $query;
	}

	public function add_stock_in($post, $id = null)
	{
		if ($id) {
			$params = array();
			$index = 0;
			for ($i = 0; $i < count($post['id_sc']); $i++) {
			$params = array(
				'id_sc' => $post['id_sc'][$index],
				'no_stok ' => $post['no_stok'][$index],
				'type' => 'in',
				// 'detail' => $post['detail'][$index],
				'id_supplier' => $post['supplier'][$index] == '' ? null : $post['supplier'][$index],
				'jumlah' => $post['jumlah'][$index],
				'tanggal' => $post['date'],
				'id' => $this->session->userdata('id'),
			);
			$this->db->where('id_stok', $id);
			$this->db->update('t_stok', $params);
			// $index++;
		};
		} else {
			
			$params = array();
			$index = 0;
			for ($i = 0; $i < count($post['id_sc']); $i++) {
			$params = array(
				'id_sc' => $post['id_sc'][$index],
				'no_stok ' => $post['no_stok'][$index],
				'type' => 'in',
				// 'detail' => $post['detail'][$index],
				'id_supplier' => $post['supplier'][$index] == '' ? null : $post['supplier'][$index],
				'jumlah' => $post['jumlah'][$index],
				'tanggal' => $post['date'],
				'id' => $this->session->userdata('id'),
			);
			$this->db->insert('t_stok', $params);
			$index++;
		};
	};
	}
}