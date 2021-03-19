<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_sukucadang', 'm_supplier', 'm_stok', 'm_permintaan']);
	}

	public function stock_in_data()
	{
		$data['row'] = $this->m_stok->get_stock_in()->result();
		$this->template->load('template','transaksi/stock_in/stock_in_data', $data);
	}
	public function laporan_in_data()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		// if ($bulan && $tahun) {
			// $data['row'] = $this->m_stok->get_stock_in1($bulan, $tahun)->result();
		// }else {
		// 	$data['row'] = $this->m_stok->get_stock_in()->result();
		// };
		if ($bulan && $tahun) {
			$data['row'] = $this->m_stok->get_stock_in1($bulan, $tahun)->result();
		} else {
			$data['row'] = $this->m_stok->get_stock_in()->result();
		}
		if (empty($data['row'])) {
			$data['row'] = $this->m_stok->get_stock_in()->result();
		}
		$this->template->load('template','transaksi/stock_in/laporan_stock_in', $data);
	}

	public function stock_out_data()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		if ($bulan && $tahun) {
			$permintaan = $this->m_permintaan->get_detail1($bulan, $tahun)->result();
		} else {
			$permintaan = $this->m_permintaan->get_detail()->result();
		}
		if (empty($permintaan)) {
			$permintaan = $this->m_permintaan->get_detail()->result();
		}
		
		$start = intval($this->input->get('start'));
		$data = array(
			'permintaan' => $permintaan,
			'start' => $start
		);
		$this->template->load('template','transaksi/stock_in/stock_out_data', $data);
	}
	
	public function stock_in_add()
	{
		$sukucadang = $this->m_sukucadang->get()->result();
		$supplier = $this->m_supplier->get()->result();
		$data = ['sukucadang' => $sukucadang,
		'supplier' => $supplier,
		'no_stok' => $this->m_stok->noStok(),];
		$this->template->load('template','transaksi/stock_in/stock_in_form', $data);
	}

	public function stock_in_edit($id)
	{
		$query = $this->m_stok->get($id);
		if ($query->num_rows() > 0) {
			$sukucadang = $this->m_sukucadang->get()->result();
			$supplier = $this->m_supplier->get()->result();
			$stok = $this->db->get_where('t_stok', array('id_stok'=>$id))->row_array();
			$data = array(
				'sukucadang' => $sukucadang,
				'stok' => $stok,
				'supplier' => $supplier
			);
			$this->template->load('template','transaksi/stock_in/stock_edit_form', $data);
		} else {
			echo "<script>alert('Data tidak ditemukan');";
			echo "window.location='" . site_url('stock/stock_in_data') . "';</script>";
		}
	}

	public function stock_in_del()
	{
		$id_stok = $this->uri->segment(3);
		$id_sc = $this->uri->segment(4);
		$jumlah = $this->m_stok->get($id_stok)->row();
		$jumlah = $jumlah->jumlah; // ini masih array nih, hrs single value
		// var_dump($jumlah);die;
		// $data['jumlah'] = $jumlah; 
		// $data['id_sc'] = $id_sc;
		$this->m_sukucadang->update_stock_out($jumlah, $id_sc);
		$this->m_stok->del($id_stok);
		if($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Data Stock berhasil dihapus');
		}
		redirect('stock/in');		

	}
		
	public function process()
	{
		if(isset($_POST['in_add'])) {
			$post = $this->input->post(null, TRUE);	
			$this->m_sukucadang->update_stock_in($post);
			$this->m_stok->add_stock_in($post);
			if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data Stock Masuk berhasil disimpan');
		}	
		redirect('stock/in');
		}			
	}

	public function process1($id)
	{
		if(isset($_POST['in_add'])) {
			$post = $this->input->post(null, TRUE);	
			$this->m_stok->add_stock_in($post, $id);
			$this->m_sukucadang->update_stock_in($post);
			if($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data Stock Masuk berhasil disimpan');
		}	
		redirect('stock/in');
		}			
	}

	public function laporan_print_stock()
	{
		$id = $this->uri->segment(3);
		$result = $this->db->get_where('t_stok', array('id_stok'=>$id))->row_array();
		$data = array(
			'purchase' => $result
		);
		$this->load->view('transaksi/stock_in/laporan_print_stock', $data);
	}

	public function laporan_excel_stock()
	{
		$data['row'] = $this->m_stok->get_stock_in()->result();
		$this->load->view('transaksi/stock_in/laporan_excel_stock', $data);
	}

	function laporan_pdf_stock()
	{
		$this->load->library('pdf');
		// require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');

		$id = $this->uri->segment(3);
		$result = $this->db->get_where('t_stok', array('id_stok'=>$id))->row_array();
		$data = array(
			'purchase' => $result
		);
		$this->load->view('transaksi/stock_in/laporan_pdf_stock', $data);
// $dompdf = new Dompdf();
// $paper_size  = 'A4'; // ukuran kertas
// $orientation = 'landscape'; //tipe format kertas potrait atau landscape
$html = $this->output->get_output();
$html .= '<link type="text/css" href="http://localhost/sukucadang/assets/style.css" rel="stylesheet" />';
		// var_dump($html);
		// die;
		// require_once 'dompdf/autoload.inc.php';
		
		// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("laporan_data_stock.pdf", array('Attachment' => 0));

		// nama file pdf yang di hasilkan
	}
}
