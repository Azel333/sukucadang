<?php defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['m_permintaan', 'm_sukucadang']);
	}
	public function index()
	{
		$data['row'] = $this->m_permintaan->get();
		$permintaan = $this->m_permintaan->get()->result();
		$sukucadang = $this->m_sukucadang->get()->result();
		$start = intval($this->input->get('start'));
		$data = array(
			'id_permintaan' => $this->m_permintaan->nopermintaan(),
			// 'pelanggan' => $this->m_permintaan->get_pelanggan()->result(),
			'sukucadang' => $sukucadang,
			'permintaan' => $permintaan,
			'start' => $start,
		);

		//$pelanggan = $this->m_permintaan->get_pelanggan();
		//return $pelanggan;
		$this->template->load('template', 'permintaan/permintaan_form', $data);
	}

	public function edit($id)
	{
		$data['row'] = $this->m_permintaan->get();
		// $permintaan = $this->m_permintaan->get()->result();
		$sukucadang = $this->m_sukucadang->get()->result();
		$start = intval($this->input->get('start'));
		$data = array(
			'permintaan' => $this->db->get_where('permintaan_detail', array('id'=>$id))->row_array(),
			// 'pelanggan' => $this->m_permintaan->get_pelanggan()->result(),
			'sukucadang' => $sukucadang,
			'start' => $start,
		);
		$this->template->load('template', 'permintaan/permintaan_edit', $data);
	}

	public function create_action()
	{
		$id_sc = $this->input->post('id_sc');
		$jumlah = $this->input->post('jumlah');
		$id_permintaan = $this->input->post('id_permintaan');

		$data1 = array(
			'id_permintaan' => $id_permintaan,
			//'id' => $this->input->post('id'), 
			// 'id_pelanggan' => $this->input->post('nama_pelanggan'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'no_pol' => $this->input->post('no_pol'),
			'tanggal' => $this->input->post('tanggal'),
			'note' => $this->input->post('note')
		);
		$this->db->insert('permintaan', $data1);
		$data = array();
		$index = 0;
		for ($i = 0; $i < count($id_sc); $i++) {
			$data = array(
				'id_permintaan' => $id_permintaan,
				'id_sc' => trim($id_sc[$index]),
				'jumlah' => $jumlah[$index],
			);
			$this->db->insert('permintaan_detail', $data);
			// $this->m_sukucadang->update_stock_in($data);
			$index++;
		}

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('success', 'Data Stock Masuk berhasil simpan');
			redirect('permintaan/data');
		}
		//$this->template->load('template','permintaan/permintaan_form', $data);
	}

	public function create_action1()
	{
		$id_sc = $this->input->post('id_sc');
		$jumlah = $this->input->post('jumlah');
		$id_permintaan = $this->input->post('id_permintaan');
		$id = $this->input->post('id');

		$data1 = array(
			// 'id_permintaan' => $id_permintaan,
			//'id' => $this->input->post('id'), 
			'id_pelanggan' => $this->input->post('nama_pelanggan'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'no_pol' => $this->input->post('no_pol'),
			'tanggal' => $this->input->post('tanggal'),
			'note' => $this->input->post('note')
		);
		$this->db->where('id_permintaan', $id_permintaan);
			$this->db->update('permintaan', $data1);
		$data = array();
		$index = 0;
		for ($i = 0; $i < count($id_sc); $i++) {
			$data = array(
				// 'id_permintaan' => $id_permintaan,
				'id_sc' => trim($id_sc[$index]),
				'jumlah' => $jumlah[$index],
			);
			$this->db->where('id', $id);
			$this->db->update('permintaan_detail', $data);
			// $this->m_sukucadang->update_stock_in($data);
			$index++;
		}
		$this->session->set_flashdata('success', 'Data Stock Masuk berhasil disimpan');
		redirect('permintaan/data');
		//$this->template->load('template','permintaan/permintaan_form', $data);
	}

	public function data()
	{
		$tanggal = $this->input->post('date');
		if ($tanggal) {
			$permintaan = $this->m_permintaan->get_detail2($tanggal)->result();
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
		$this->template->load('template', 'permintaan/permintaan_data', $data);
	}

	public function get_alamat()
	{
		$id = $this->input->post('id', TRUE);
		$query = $this->db->get_where('tb_pelanggan', array('id_pelanggan' => $id));
		$data = $query->first_row();
		//  $data = $this->m_permintaan->get_sub_category($category_id)->result();
		echo json_encode($data);
	}

	public function validasi()
	{
		$validasi = $this->input->post('validasi');
		$id_sc = $this->input->post('id_sc');
		$jumlah = $this->input->post('jumlah');
		$id = $this->input->post('id');

		$data1 = array(
			'validasi' => $validasi
		);
		$this->db->where('id', $id);
		$this->db->update('permintaan_detail', $data1);

		if ($validasi === 'selesai') {
			$data = array(
				'jumlah' => $jumlah,
				'id_sc' => $id_sc
			);
			$jumlah =$data['jumlah'];
		$id_sc =$data['id_sc'];
			$this->m_sukucadang->update_stock_out($jumlah,$id_sc);
			// $this->db->where('id_sc', $id_sc);
			// $this->db->update('tb_sukucadang', $data);
		}
		redirect('permintaan/data');
	
	}
	public function harga()
	{
		$harga = $this->input->post('harga');
		$id = $this->input->post('id');

		$data1 = array(
			'harga' => $harga
		);
		$this->db->where('id', $id);
		$this->db->update('permintaan_detail', $data1);
		$this->session->set_flashdata('success', 'Data Harga berhasil disimpan');
		redirect('permintaan/data');
	}

	public function laporan_print_permintaan()
	{
		$id = $this->uri->segment(3);
		$row = $this->db->get_where('permintaan_detail', array('id_permintaan'=>$id))->row_array();
		$result = $this->db->get_where('permintaan_detail', array('id_permintaan'=>$id))->result_array();
		$data = array(
			'purchase' => $row,
			'permintaan' => $result
		);
		$this->load->view('permintaan/laporan_print_permintaan', $data);
	}

	public function laporan_excel_permintaan()
	{
		$permintaan = $this->m_permintaan->get_detail()->result();
		$start = intval($this->input->get('start'));
		$data = array(
			'permintaan' => $permintaan,
			'start' => $start
		);
		$this->load->view('permintaan/laporan_excel_permintaan', $data);
	}

	function laporan_pdf_permintaan()
	{
		$this->load->library('pdf');
		// require_once(APPPATH . 'third_party/dompdf/autoload.inc.php');

		$permintaan = $this->m_permintaan->get_detail()->result();
		$start = intval($this->input->get('start'));
		$data = array(
			'permintaan' => $permintaan,
			'start' => $start
		);

		$this->load->view('permintaan/laporan_pdf_permintaan', $data);

		$paper_size  = 'A4'; // ukuran kertas
		$orientation = 'landscape'; //tipe format kertas potrait atau landscape
		$html = $this->output->get_output();

		$this->pdf->set_paper($paper_size, $orientation);
		//Convert to PDF
		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream("laporan_data_permintaan.pdf", array('Attachment' => 0));
		// nama file pdf yang di hasilkan
	}
}



	
  //    	$id_sc = $this->input->post('id_sc');
  //    	$nama = $_POST['nama'];
  //    	$harga = $_POST['harga'];
  //    	$total_harga = $_POST['harga'];
  //    	$status = $_POST['status'];
		// $jumlah = $this->input->post('jumlah');

  //  		for ($s=0; $s < count($id_sc); $s++) { 
  //  		$sukucadang = array(
  //       	'id_sc'=>$id_sc[$s],
  //       	'id_permintaan'=>$id,
  //       	'jumlah'=>$jumlah[$s],

  //   	  );
  //   	$this->db->insert('permintaan_detail', $sukucadang);
	 //    }
		// $this->session->set_flashdata('message', 'Data '.json_encode($nama_sc).' Berhasil Disimpan');
  //          redirect(site_url('permintaan'));
		// }

	// 	public function process()
	// 	{
	// 	$post = $this->input->post(null, TRUE);
	// 	if(isset($_POST['add'])){
	// 		$this->m_pemintaanr->add($post);
	// 	} else if(isset($_POST['edit'])){
	// 		$this->m_pemintaanr->edit($post);
	// 	}
	// 	if($this->db->affected_rows() > 0){
	// 		echo "<script>alert('Data berhasil disimpan');</script>";
	// 		}
	// 		echo "<script>window.location='".site_url('permintaan')."';</script>";
	// 	}
	// }