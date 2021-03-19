<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sukucadang extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_sukucadang', 'm_supplier']);
	}
	public function index()
	{
		$data['row'] = $this->m_sukucadang->get();
		$this->template->load('template', 'sukucadang/sc_data', $data);
	}
	public function add()
	{
		$sukucadang = new stdClass();
		$sukucadang->id_sc = null;
		$sukucadang->id_supplier = null;
		$sukucadang->nama = null;
		$sukucadang->satuan = null;
		$sukucadang->lokasi_rak = null;
		$sukucadang->status = null;
		$sukucadang->kondisi = null;
		$sukucadang->tipe = null;

		$query_supplier = $this->m_supplier->get();
		$supplier = $this->m_supplier->get()->result();
		$data = array(
			'page' => 'add',
			'row' => $sukucadang,
			//'supplier' => $supplier, 'selectedsupplier' => null,
			'supplier' => $supplier,
		);
		$this->template->load('template', 'sukucadang/sc_form', $data);
	}
	public function edit($id)
	{
		$query = $this->m_sukucadang->get($id);
		if ($query->num_rows() > 0) {
			$sukucadang = $query->row();
			$supplier = $this->m_supplier->get()->result();
			// $query_supplier = $this->m_supplier->get();
			// $supplier[null] = '- Pilih -';
			// foreach ($query_supplier->result() as $spr) {
			// 	$supplier[$spr->id_supplier] = $spr->nama;
			// }
			$data = array(
				'page' => 'edit',
				'row' => $sukucadang,
				'supplier' => $supplier, 'selectedsupplier' => $sukucadang->id_supplier,
			);
			$this->template->load('template', 'sukucadang/sc_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('sukucadang') . "';</script>";
		}
	}
	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($_POST['add'])) {
			$params = array();
		$index = 0;
		for ($i = 0; $i < count($post['id_sc']); $i++) {
			if ($this->m_sukucadang->check_kode($post['id_sc'][$index])->num_rows() > 0) {
				$this->session->set_flashdata('error', "Kode ".$post['id_sc'][$index]." sudah dipakai barang lain");
				redirect('sukucadang/add');
			} else {
				$params = [
					'id_sc' => $this->m_sukucadang->kode_otomatis(),
					'id_supplier' => $post['supplier'][$index],
					'nama' => $post['nama'][$index],
					'satuan' => $post['satuan'][$index],
					'lokasi_rak' => $post['lokasi_rak'][$index],
					'status' => $post['status'][$index],
					'kondisi' => $post['kondisi'][$index],
					'tipe' => $post['tipe'][$index],
				];
				$this->db->insert('tb_sukucadang', $params);
			}
			$index++;
	};
		} else if (isset($_POST['edit'])) {
			// if ($this->m_sukucadang->check_kode($post['id_sc'], $post['id'])->num_rows() > 0) {
			// 	$this->session->set_flashdata('error', "Kode $post[id_sc] sudah dipakai barang lain");
			// 	redirect('sukucadang/edit/' . $post['id']);
			// } else {
				// $this->m_sukucadang->edit($post);
			// }
			$params = array();
		$index = 0;
		for ($i = 0; $i < count($post['id_sc']); $i++) {
			// if ($this->m_sukucadang->check_kode($post['id_sc'][$index])->num_rows() > 0) {
			// 	$this->session->set_flashdata('error', "Kode ".$post['id_sc'][$index]." sudah dipakai barang lain");
			// 	redirect('sukucadang/add');
			// } else {
				$params = [
					'id_sc' => $post['id_sc'][$index],
					'id_supplier' => $post['supplier'][$index],
					'nama' => $post['nama'][$index],
					'satuan' => $post['satuan'][$index],
					'lokasi_rak' => $post['lokasi_rak'][$index],
					'status' => $post['status'][$index],
					'kondisi' => $post['kondisi'][$index],
					'tipe' => $post['tipe'][$index],
				];
				$this->db->where('id_sc', $post['id'][$index]);
		$this->db->update('tb_sukucadang', $params);
				// $this->db->insert('tb_sukucadang', $params);
			// }
			// $index++;
	};
		}

		// if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
		// }
		redirect('sukucadang');
	}
	public function del($id)	
	{
		$this->m_sukucadang->del($id);
		// if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus');
		// }
		redirect('sukucadang');
	}

	public function laporan_print_sukucadang()
	{
		$id = $this->uri->segment(3);
		$result = $this->db->get_where('tb_sukucadang', array('id_sc'=>$id))->row_array();
		$data = array(
			'purchase' => $result
		);
		$this->load->view('sukucadang/laporan_print_sukucadang', $data);
	}
	public function laporan_excel_sukucadang()
	{
		$data['row'] = $this->m_sukucadang->get();
		$this->load->view('sukucadang/laporan_excel_sukucadang', $data);
	}

	function laporan_pdf_sukucadang()
	{
		$this->load->library('pdf');
		// require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');

		$data['row'] = $this->m_sukucadang->get();

		$this->load->view('sukucadang/laporan_pdf_sukucadang', $data);

		$paper_size  = 'A4'; // ukuran kertas
		$orientation = 'landscape'; //tipe format kertas potrait atau landscape
		$html = $this->output->get_output();

		$this->pdf->set_paper($paper_size, $orientation);
		//Convert to PDF
		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("laporan_data_sukucadang.pdf", array('Attachment' => 0));
		// nama file pdf yang di hasilkan
	}
}
