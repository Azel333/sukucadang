<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_supplier extends CI_Model {
	public function get($id = null) 
	{
		$this->db->from('tb_supplier');
		if($id != null){
			$this->db->where('id_supplier',$id);
		}
		$query = $this->db->get();
		return $query;
	}
	public function add($post)
	{
		$params = [
			'nama' => $post['nama_supplier'],
			'alamat' => $post['alamat'],
			'telepon' => $post['telepon'],
		];
		$this->db->insert('tb_supplier', $params);
	}
	public function edit($post)
	{
		$params = [
			'nama' => $post['nama_supplier'],
			'alamat' => $post['alamat'],
			'telepon' => $post['telepon'],
		];
		$this->db->where('id_supplier', $post['id']);
		$this->db->update('tb_supplier', $params);
	}
	public function del($id)
	{
		$this->db->where('id_supplier', $id);
		$this->db->delete('tb_supplier');
	}

	function get_all_supplier(){
        $hasil=$this->db->get('tb_supplier');
        return $hasil->result();
	}
	
	function get_supplier($id_supplier)
	{
		// $data = $this->input->post('id_supplier');
			// $this->session->set_userdata($id_supplier);
		$this->db->where('id_supplier', $id_supplier);
		$query = $this->db->get('tb_sukucadang');
		$output = '';
		$no=1;
		if ($query->num_rows() > 0) {
			# code...
			foreach($query->result() as $row)
			{
				$output .= '<tr><td>'.$no++.'</td>
				<td><input name="id_sc[]" hidden value="'.$row->id_sc.'">'.$row->id_sc.'</td>
				<td>'.$row->nama.'</td>
				<td>'.$row->tipe.'</td>
				<td>'.$row->stok.' '.$row->satuan.'</td>
				<td>'.$row->lokasi_rak.'</td>
				<td><input type="number" id="quantity" name="jumlah[]" placeholder="0" min="0" max=""></td>
				<td><input type="number" id="harga" name="harga[]" placeholder="0" min="0" max=""></td>
				<td><button type="button" class="btn text-danger btn-remove-item">
				<i class="fa fa-trash"></i>
			</button></td></tr>';
		}
		return $output;
		} else {
			# code...
			$output .= '<tr><td colspan="9" class="text-center">Tidak ada item</td></tr>';
			return $output;
		}
		
	}
}
