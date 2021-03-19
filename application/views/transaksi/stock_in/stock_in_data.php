<section class="content-header">
	<h1>Sukucadang Masuk
		<small>Sukucadang Masuk</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-user"></i>
		<i>Transaksi</i>
		<li class="active"> Stok Masuk</li>
		<?php $this->view('message') ?>
	</ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Stok Masuk</h3>
		<div class="pull-right">
		<a href="<?=site_url('stock/in/add')?>" class="btn btn-primary btn-flat">
		<i class="fa fa-plus"></i> Tambah Stok
	</a>
	</div>

	</div>

	<div class="box-body table-responsive">

		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>No. Surat Jalan</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Tipe</th>
					<th>Jumlah</th>
					<th>Tanggal</th>
					<th>Action</th>
					<!-- <th>Cetak</th> -->
				</tr>

			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($row as $key => $data) { ?>
				<tr>
					<td style="width: 5%;"><?=$no++?>.</td>
					<td><?=$data->no_stok?></td>
					<td><?=$data->id_sc?></td>
					<td><?=$data->nama_sc?></td>
					<td><?=$data->tipe?></td>
					<td class="text-right"><?=$data->jumlah?></td>
					<td class="text-center"><?=indo_date($data->tanggal)?></td>

					<td class="text-center">
						<!-- <a id="set_dtl" class="btn btn-default btn-xs" data-toggle="modal" data-target="#cek<?=$data->id_sc?>"
						data-id_sc="<?=$data->id_sc?>"
						data-nama_sc="<?=$data->nama_sc?>"
						data-detail="<?=$data->detail?>"
						data-nama_supplier="<?=$data->nama_supplier?>"
						data-jumlah="<?=$data->jumlah?>"
						data-tanggal="<?=indo_date($data->tanggal)?>"
						> -->
						<a class="btn btn-default btn-xs" data-toggle="modal" data-target="#cek<?php echo $data->id_sc?>">
						<i class="fa fa-eye"></i> Detail
						</a>
						<a href="<?= site_url('stock/stock_in_edit/' . $data->id_stok) ?>" class="btn btn-primary btn-xs">
									<i class="fa fa-pencil"></i> Ubah
								</a>
						<a href="<?=site_url('stock/stock_in_del/'.$data->id_stok.'/'.$data->id_sc)?>" onclick="return confirm('Yakin hapus data')" class="btn btn-danger btn-xs">
							<i class="fa fa-trash"></i> Delete
						</a>
				<!-- <a class="btn btn-warning btn-md" href="<?php echo base_url() . 'sukucadang/laporan_pdf_sukucadang'; ?>">
					<span class="glyphicon glyphicon-print"></span> Cetak PDF
				</a> -->
					</td>
					<!-- <td>
						<a class="btn btn-default btn-md" href="<?php echo base_url() . 'sukucadang/laporan_print_sukucadang/'.$data->id_sc; ?>">
					<span class="glyphicon glyphicon-print"></span> Print
				</a>
				</td> -->
				</tr>
				<?php
				}?>
			</tbody>
		</table>
	</div>
</div>
</section>

<?php $no = 1;
				foreach ($row as $key => $data) { ?>
<div class="modal fade" id="cek<?php echo $data->id_sc?>" role="dialog" aria-labelledby="modaledit" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Detail Stok Masuk</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered no-margin">
					<tbody>
						<tr>
							<th style="">Kode</th>
							<td><span id="id_sc"></span><?=$data->id_sc?></td>
						</tr>
						<tr>
							<th style="">No. Stok</th>
							<td><span id="id_sc"></span><?=$data->no_stok?></td>
						</tr>
						<tr>
							<th>Nama</th>
							<td><span id="nama_sc"></span><?=$data->nama_sc?></td>
						</tr>
						<!-- <tr>
							<th>Detail</th>
							<td><span id="detail"><?=$data->detail?></span></td>
						</tr> -->
						<tr>
							<th>Supplier</th>
							<td><span id="nama_supplier"></span><?=$data->nama_supplier?></td>
						</tr>
						<tr>
							<th style="">Jumlah
							<td><span id="jumlah"></span><?=$data->jumlah?></td>
						</tr>
						<tr>
							<th>Tanggal</th>
							<td><span id="tanggal"></span><?=indo_date($data->tanggal)?></td>
						</tr>
			
					</tbody>
					
				</table>

			</div>
		</div>
	</div>
</div>
<?php
				}?>
<script>
                    $('#cek<?php echo $data->id_sc?>"').on('shown.bs.modal', function() {
                        
                    });
                    
                    
                </script>
<!-- <script>
$(document).ready(function(){
	$('#table1').on('click', '#set_dtl', function() {
		var id_sc = $(this).data('id');
		var id_sc = $(this).data('id_sc');
		var nama_sc = $(this).data('nama_sc');
		var detail = $(this).data('detail');
		var nama_supplier = $(this).data('nama_supplier');
		var jumlah = $(this).data('jumlah');
		var tanggal = $(this).data('tanggal');
		$('#id_sc').text(id_sc);
		$('#id_sc').text(id_sc);
		$('#nama_sc').text(nama_sc);
		$('#detail').text(detail);
		$('#nama_supplier').text(nama_supplier);
		$('#jumlah').text(jumlah);
		$('#tanggal').text(tanggal);
		$('#detail').text(detail);
	});
});
</script> -->