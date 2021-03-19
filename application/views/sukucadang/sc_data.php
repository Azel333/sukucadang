<section class="content-header">
	<h1>suku cadang
		<small>Stok</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-user"></i></a></li>
		<li class="active">suku cadang</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<?php $this->view('message') ?>
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Data Suku Cadang</h3>
			<div class="pull-right">
				<a href="<?= site_url('sukucadang/add') ?>" class="btn btn-primary btn-flat">
					<i class="fa fa-plus"></i> Tambah
				</a>
				<!-- <a class="btn btn-default btn-md" href="<?php echo base_url() . 'sukucadang/laporan_print_sukucadang'; ?>">
					<span class="glyphicon glyphicon-print"></span> Print
				</a>
				<a class="btn btn-warning btn-md" href="<?php echo base_url() . 'sukucadang/laporan_pdf_sukucadang'; ?>">
					<span class="glyphicon glyphicon-print"></span> Cetak PDF
				</a> -->
			</div>

		</div>

		<div class="box-body table-responsive">

			<table class="table table-bordered table-striped" id="table1">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Supplier</th>
						<th>Nama</th>
						<th>Tipe</th>
						<th>Satuan</th>
						<th>Lokasi Rak</th>
						<th>Stok</th>
						<th>Status</th>
						<th>Safety Stok</th>
						<th>maksimum</th>
						<th>Action</th>
						<!-- <th>Cetak</th> -->
					</tr>

				</thead>
				<tbody>
					<?php $no = 1;
					foreach ($row->result() as $key => $data) {
						$sp = $this->db->get_where('tb_supplier', ['id_supplier' => $data->id_supplier])->row_array(); ?>
						<tr>
							<td style="width:5%;"><?= $no++ ?>.</td>
							<td><?= $data->id_sc ?></td>
							<td><?= $data->supplier_nama ?></td>
							<td><?= $data->nama ?></td>
							<td><?= $data->tipe ?></td>
							<td><?= $data->satuan ?></td>
							<td><?= $data->lokasi_rak ?></td>
							<td><?= $data->stok ?></td>
							<?php if ($data->stok > $data->status) { ?>
								<td style="text-align:center; background-color:green; color:white;"><strong>Aman</strong></td>
							<?php } elseif ($data->stok == $data->status) {?>
								<td style="text-align:center; background-color: #ff9900;color:white;"><strong>Kritis</strong></td>
							<?php } else { ?>
								<td style="text-align:center; background-color: red;color:white;"><strong><a href="<?= site_url('purchaseorder') ?>"  style="color:white;">
									Urgent
								</a></strong></td>
							<?php } ?>
							<td><?= $data->status ?></td>
							<td><?= $data->kondisi ?></td>
							
							<td class="text-center">
								<a href="<?= site_url('sukucadang/edit/' . $data->id_sc) ?>" class="btn btn-primary btn-xs">
									<i class="fa fa-pencil"></i> Ubah
								</a>
								<!-- <a id="set_detail" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-detail" data-nama="<?= $data->nama ?>">
									<a id="set_dtl" class="btn btn-default btn-xs" data-toggle="modal" data-target="#<?php echo $data->id_sc ?>">
									<i class="fa fa-eye"></i> Detail -->
									<button href="<?= site_url('sukucadang/del/' . $data->id_sc) ?>" onclick="confirmDelete(this)" class="btn btn-danger btn-xs">
										<i class="fa fa-trash"></i> Hapus
									</button>
							</td>
							<!-- <td>
							 <a class="btn btn-default btn-md" href="<?php echo base_url() . 'sukucadang/laporan_print_sukucadang/'.$data->id_sc ; ?>">
					<span class="glyphicon glyphicon-print"></span> Print
				</a>
				<a class="btn btn-warning btn-md" href="<?php echo base_url() . 'sukucadang/laporan_pdf_sukucadang'; ?>">
					<span class="glyphicon glyphicon-print"></span> Cetak PDF
				</a>
							<a class="btn btn-default btn-md" href="<?php echo base_url() . 'sukucadang/laporan_excel_sukucadang'; ?>">
					<span class="glyphicon glyphicon-print"></span> Cetak Excel
				</a>
							</td> -->
						</tr>
					<?php
					} ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<div class="modal fade" id="modal-detail">
	<div class="modal-dialog modal-sm">
	
		<!-- <div class="modal fade" id="cek<?= $data->id_sc ?>" role="dialog" aria-labelledby="modaledit" aria-hidden="true">
	<div class="modal-dialog"> -->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Detail Stok</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered no-margin">
					<tbody>
						<tr>
							<th>Nama</th>
							<td><span id="nama"><?= $data->supplier_nama ?></span></td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td><span id="supplier"><?= $sp['alamat'] ?></span></td>
						</tr>
						<tr>
							<th>Telepon</th>
							<td><span id="supplier"><?= $sp['telepon'] ?></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$(document).on('click', '#set_detail', function() {
			//var id_sc = $(this).data('id_sc');sss
			var nama = $(this).data('nama');
			$('#nama_sc').text(nama_sc);
		});
	});

	function confirmDelete(ths) {
		console.log(ths);
		var urlHapus = $(ths).attr("href");
		swal.fire({
			title: "Yakin Hapus",
			icon: "question",
			showCancelButton: true,
			cancelButtonColor: "red",
		}).then(function() {
			window.location.href = urlHapus;
		});
	}
</script>