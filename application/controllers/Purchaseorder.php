<?php defined('BASEPATH') or exit('No direct script access allowed');
use Dompdf\Dompdf;

class Purchaseorder extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_purchaseorder', 'm_sukucadang', 'm_supplier', 'm_user', 'm_permintaan']);
	}

	public function index()
	{
		$result = $this->m_supplier->get_all_supplier();
		$data = array(
			'cabang'	=> $this->db->get('tb_cabang')->row_array(),
			'id_po' => $this->m_purchaseorder->nopo(),
			'supplier' => $result
		);
		$this->form_validation->set_rules('date', 'tanggal', 'required');
		$this->form_validation->set_rules('supplier', 'nama supplier', 'required');
		if ($this->form_validation->run() == false) {
			$this->template->load('template', 'po/po_form', $data);
		} else {
			$id_po = $this->m_purchaseorder->id_po();
			$date = $this->input->post('date');
			$id_cabang = $this->input->post('id_cabang');
			$id_supplier = $this->input->post('supplier');
			$no_po = $this->input->post('id_po');
			$id_sc = $this->input->post('id_sc');
			$jumlah = $this->input->post('jumlah');
			$harga = $this->input->post('harga');
			$metode = $this->input->post('metode');
			$note = $this->input->post('note');
			$no = $this->input->post('no');
			$data = array(
				// 'id_po' => $id_po,
				'id_po' => $no_po,
				'id_cabang' => $id_cabang,
				'id_supplier' => $id_supplier,
				'metode' => $metode,
				'note' => $note
			);
			$this->db->insert('tb_po', $data);
			$data1 = array();
			$index = 0;
			for ($i = 0; $i < count($id_sc); $i++) {
				$data1 = array(
					'id_po' => $no_po,
					'id_sc' => $id_sc[$index],
					'tanggal' => $date,
					'jumlah' => $jumlah[$index],
					'harga' => $harga[$index],
				);
				if ($data1['jumlah'] > 0) {
					$this->db->insert('tb_po_detail', $data1);
					// $test = $this->m_sukucadang->update_stock_out($data1['jumlah'], $data1['id_sc']);
				}
				$index++;
			}
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect('purchaseorder/datapo');
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(3);
		$result = $this->m_supplier->get_all_supplier();
		$data = array(
			'cabang'	=> $this->db->get('tb_cabang')->row_array(),
			// 'id_po' => $this->m_purchaseorder->nopo(),
			'po' => $this->db->get_where('tb_po_detail', ['id' => $id])->row_array(),
			'supplier' => $result
		);
		$this->form_validation->set_rules('date', 'tanggal', 'required');
		$this->form_validation->set_rules('supplier', 'nama supplier', 'required');
		if ($this->form_validation->run() == false) {
			$this->template->load('template', 'po/po_edit', $data);
		} else {
			// $id_po = $this->m_purchaseorder->id_po();
			$id_po = $this->input->post('poid');
			$date = $this->input->post('date');
			$id_cabang = $this->input->post('id_cabang');
			$id_supplier = $this->input->post('supplier');
			$no_po = $this->input->post('id_po');
			$id_sc = $this->input->post('id_sc');
			$jumlah = $this->input->post('jumlah');
			$harga = $this->input->post('harga');
			$metode = $this->input->post('metode');
			$note = $this->input->post('note');
			$no = $this->input->post('no');
			$data = array(
				'id_po' => $no_po,
				// 'no_po' => $no_po,
				'id_cabang' => $id_cabang,
				'id_supplier' => $id_supplier,
				'metode' => $metode,
				'note' => $note
			);
			$this->db->where('id_po', $data['id_po']);
			$this->db->delete('tb_po');
			$this->db->insert('tb_po', $data);
			$data1 = array();
			$index = 0;
			for ($i = 0; $i < count($id_sc); $i++) {
				$data1 = array(
					'id_po' => $no_po,
					'id_sc' => $id_sc[$index],
					'tanggal' => $date,
					'jumlah' => $jumlah[$index],
					'harga' => $harga[$index],
				);
				if ($data1['jumlah'] > 0) {
					$this->db->where('id_po', $data['id_po']);
					$this->db->delete('tb_po_detail');
					$this->db->insert('tb_po_detail', $data1);
					// $test = $this->m_sukucadang->update_stock_out($data1['jumlah'], $data1['id_sc']);
				}
				$index++;
			}
			$this->session->set_flashdata('success', 'Data berhasil disimpan');
			redirect('purchaseorder/datapo');
		}
	}

	function get_data_edit(){
		$id_supplier = $this->input->post('id_supplier',TRUE);
		$data = $this->m_purchaseorder->get_po_by_id($id_supplier)->result();
		echo json_encode($data);
	}

	function supplier_data()
	{
		// unset($_SESSION['id_supplier']);
		$id_supplier =$this->input->post('id_supplier');

		if ($id_supplier) {
			echo $this->m_supplier->get_supplier($id_supplier);
		}
	}

	public function dataPo()
	{
		$result = $this->m_purchaseorder->getpo();
		$user = $this->m_user->get();
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		if ($bulan && $tahun) {
			$result1 = $this->m_purchaseorder->getpo1($bulan, $tahun);
			$data = array(
				'purchase' => $result1,
				'bulan' => $bulan,
				'tahun' => $tahun,
				'user' => $user
			);
		} else {
			$data = array(
				'purchase' => $result,
				'user' => $user
			);
		}
		
		$id_po = $this->input->post('id_po');
		$validasi = $this->input->post('validasi');
		$validasi1 = $this->input->post('validasi1');
		$jumlah = $this->input->post('jumlah');
		$catatan = $this->input->post('catatan');
		$id_sc = $this->input->post('id_sc');
		$id = $this->input->post('id');
		if ($validasi) {
			$data1 = array(
				'validasi' => $validasi,
				'catatan' => $catatan
			);
			$this->db->where('id', $id);
			$this->db->update('tb_po_detail', $data1);
			redirect('purchaseorder/datapo');
		} elseif ($validasi1) {
			$data1 = array(
				'validasi1' => $validasi1,
				'catatan' => $catatan
			);
			$this->db->where('id', $id);
			$this->db->update('tb_po_detail', $data1);
			// $this->m_sukucadang->update_stock_out($jumlah, $id_sc);
			redirect('purchaseorder/datapo');
		} else {
			$this->template->load('template', 'po/po_data', $data);
		}
	}

	public function laporan_print_purchaseorder()
	{
		$id = $this->uri->segment(3);
		$row = $this->db->get_where('tb_po_detail', array('id_po'=>$id))->row_array();
		$result = $this->db->get_where('tb_po_detail', array('id_po'=>$id))->result_array();
		$data = array(
			'purchase' => $row,
			'order' => $result
		);
		$this->load->view('po/laporan_print_purchaseorder', $data);
	}

	public function laporan_excel_purchaseorder()
	{
		$result = $this->m_purchaseorder->getpo();
		$user = $this->m_user->get();
		$data = array(
			'purchase' => $result,
			'user' => $user
		);
		$this->load->view('po/laporan_excel_purchaseorder', $data);
	}

	function laporan_pdf_purchaseorder()
	{
		// require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');
		// $dompdf = new Dompdf();
		$this->load->library('pdf');
		$id = $this->uri->segment(3);
		$result = $this->db->get_where('tb_po_detail', array('id'=>$id))->row_array();
		$data = array(
			'purchase' => $result
		);

		$this->load->view('po/laporan_pdf_purchaseorder', $data);
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
$dompdf->stream("laporan_data_purchaseorder.pdf", array('Attachment' => 0));
		// $paper_size  = 'A4'; // ukuran kertas
		// $orientation = 'landscape'; //tipe format kertas potrait atau landscape
		// $html = $this->output->get_output();

		// $this->pdf->setPaper($paper_size, $orientation);
		// //Convert to PDF
		// $this->pdf->loadHtml($html);
		// $this->pdf->render();
		// $this->pdf->stream("laporan_data_purchaseorder.pdf", array('Attachment' => 0));
		// nama file pdf yang di hasilkan
	}
}
