<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_permintaan extends CI_Model
{

	public function nospesifikasi()
	{
		$sql = "SELECT MAX(MID(id_spesifikasi,9,4)) AS nospesifikasi 
				FROM doc_spesifikasiitem 
				WHERE MID(id_spesifikasi,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";

		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$n = ((int)$row->nospesifikasi) + 1;
			$no = sprintf("%'.04d", $n);
		} else {
			$no = "0001";
		}
		$id_spesifikasi = "RI" . date('ymd') . $no;
		return $id_spesifikasi;
	}

	public function nopermintaan()
	{
		// $sql = "SELECT MAX(MID(id_permintaan,9,4)) AS nopermintaan 
		// 		FROM permintaan 
		// 		WHERE MID(id_permintaan,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";

		// $query = $this->db->query($sql);
		// if ($query->num_rows() > 0) {
		// 	$row = $query->row();
		// 	$n = ((int)$row->nopermintaan) + 1;
		// 	$no = sprintf("%'.04d", $n);
		// } else {
		// 	$no = "0001";
		// }
		$this->db->select('RIGHT(permintaan.id_permintaan,3) as kode', FALSE);
    $this->db->order_by('id_permintaan','DESC');
    $this->db->limit(1);
    $query = $this->db->get('permintaan');
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
		$id_permintaan = "PN" . date('ymd') . $no;
		return $id_permintaan;
	}

	public function get($id = null)
	{
		$this->db->select('permintaan.*');
		$this->db->from('permintaan');
		// $this->db->join('tb_user', 'tb_user.id = permintaan. id');
		// if($id != null) {
		//     $this->db->where('id_permintaan',$id);
		// }
		$this->db->order_by('id_permintaan', 'asc');
		$query = $this->db->get();
		return $query;
	}
	public function create_action()
	{
		$id = $this->input->post('id_permintaan');

		$data = array(
			'id_permintaan' => $this->input->post('id_permintaan'),
			'username' => $this->input->post('username'),
			'tanggal' => $this->input->post('tanggal'),
			'id_pelanggan' => $this->input->post('pelanggan'),
			'alamat' => $this->input->post('alamat'),
			'no_pol' => $this->input->post('no_pol'),
		);
	}

	// public function get_pelanggan()
	// {
	// 	// $this->db->select('nama');
	// 	//   $this->db->from('tb_pelanggan');
	// 	$sql = "SELECT * 
	// 			FROM tb_pelanggan 
	// 			";
	// 	//   $query = $this->db->get($sql);
	// 	$query = $this->db->query($sql);
	// 	return $query;
	// }

	public function get_detail($id = null)
	{
		$this->db->from('permintaan_detail');
		if ($id != null) {
			$this->db->where('id_permintaan', $id);
		}
		$query = $this->db->get();
		return $query;
	}

	public function get_detail1($bulan, $tahun)
	{
		$this->db->select('permintaan_detail.*, permintaan.id_permintaan, permintaan.tanggal');
		$this->db->join('permintaan', 'permintaan_detail.id_permintaan = permintaan.id_permintaan');
		$this->db->from('permintaan_detail');
		$this->db->where('MONTH(tanggal)', $bulan);
		$this->db->where('YEAR(tanggal)', $tahun);
		$query = $this->db->get();
		return $query;
	}

	public function get_detail2($tanggal)
	{
		$this->db->select('permintaan_detail.*, permintaan.id_permintaan, permintaan.tanggal');
		$this->db->join('permintaan', 'permintaan_detail.id_permintaan = permintaan.id_permintaan');
		$this->db->from('permintaan_detail');
		$this->db->where('tanggal', $tanggal);
		$query = $this->db->get();
		return $query;
	}
}
