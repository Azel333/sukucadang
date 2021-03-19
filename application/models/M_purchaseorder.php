<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_purchaseorder extends CI_Model
{

	public function nopo()
	{
		// $sql = "SELECT MAX(MID(id_po,9,4)) AS nopo 
		// 		FROM tb_po
		// 		WHERE MID(id_po,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";

		// $query = $this->db->query($sql);
		// if ($query->num_rows() > 0) {
		// 	$row = $query->row();
		// 	$n = ((int) $row->nopo) + 1;
		// 	$no = sprintf("%'.04d", $n);
		// } else {
		// 	$no = "0001";
		// }
		$this->db->select('RIGHT(tb_po.id_po,3) as kode', FALSE);
    $this->db->order_by('id_po','DESC');
    $this->db->limit(1);
    $query = $this->db->get('tb_po');
    if ($query->num_rows()<>0)
    {
      $data=$query->row();
	  $n=intval($data->kode)+1;
	  $no = sprintf("%'.04d", $n);
    }
    else
    {
      $no = "0001";
    }
		$id_po = "PO" . date('ymd') . $no;
		return $id_po;
	}

	public function get($id = null)
	{
		$this->db->from('tb_po_detail');
		if ($id != null) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function getpo($id = null)
	{
		$hasil = $this->db->get('tb_po_detail');
		return $hasil->result();
	}

	public function getpo1($bulan, $tahun)
	{
		$this->db->where('MONTH(tanggal)', $bulan);
		$this->db->where('YEAR(tanggal)', $tahun);
		$hasil = $this->db->get('tb_po_detail');
		return $hasil->result();
	}

	public function getpo2($id = null)
	{
		$this->db->select('tb_po_detail.*, tb_po.id_po AS id_po, tb_po.tanggal');
		$this->db->join('tb_po', 'tb_po.id_po = tb_po_detail.id_po');
		//$this->db->join('tbl_2', 'tbl_1.id_2 = tbl_2.id');
		$this->db->from('tb_po_detail');
		// $this->db->where('id_meta', $this->session->userdata('id_meta'));
		$query = $this->db->get();
		return $query->result();
	}

	function get_po_by_id($id_supplier){
		$query = $this->db->get_where('tb_po', array('id_supplier' =>  $id_supplier));
		return $query;
	}

	function id_po()
	{
		$this->db->select('id_po');
		$this->db->order_by('id_po', 'DESC');
		$query = $this->db->get('tb_po');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->id_po) + 1;
		} else {
			$kode = 1;
		}
		return $kode;
	}
}
