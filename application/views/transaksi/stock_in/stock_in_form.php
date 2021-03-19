<section class="content-header">
	<h1>Suku Cadang Masuk
		<small>Suku Cadang Masuk</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-user"></i>
		<i>Transaksi</i>
		<li class="active"> Stok Masuk</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<?php $this->view('message') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Tambah Stok Masuk</h3>
		<div class="pull-right">
		<a href="<?=site_url('stock/in')?>" class="btn btn-warning btn-flat">
		<i class="fa fa-undo"></i> Kembali
	</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?=site_url('stock/process')?>" method="post">
					<!-- <div class ="form-group">
						<label>No. Surat Jalan</label>
						<input type="text" name="id_permintaan" value="<?= $no_stok ?>" class="form-control" readonly/>
					</div> -->
					<div class ="form-group">
						<label>Tanggal*</label>
						<input type="date"  name="date" value="<?=date('Y-m-d')?>"class="form-control" required> 
					</div>
					<?php if ($this->uri->segment(3) === 'add') { ?>
					<button type="button" id="add_baris" class="btn btn-success add-row glyphicon glyphicon-plus">Add</button>
					<?php }?>
					<div id="tambah">
					<div class="kecubung">
					<div>
						<label for="id_sc">Kode *</label>
					</div>
					<div class="form-group input-group">
						<input type="text" name="id_sc[]" id="id_sc-1" class="form-control" readonly="true" required autofocus>
						<span class="input-group-btn">
							<button type="button" class="btn btn-info btn-flat" onclick="TampilPopUp(this.id)"  id="btn-add-1">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
					<div class ="form-group">
						<label>No. Surat Jalan</label>
						<input type="text" name="no_stok[]" value="" class="form-control"/>
					</div>
					<div class ="form-group">
					<div class="row">
							<div class="col-md-8">
						<label for="nama_sc">Nama Sukucadang *</label>
						<input type="text"  name="nama[]" id="nama-1" class="form-control" readonly>
						</div>
							<div class="col-md-4">
						<label for="nama_sc">Tipe *</label>
						<input type="text"  name="tipe[]" id="tipe-1" class="form-control" readonly>
						</div></div>
					</div>
					<div class ="form-group">
						<div class="row">
							<div class="col-md-4">
								<label for="satuan">Satuan</label>
								<input type="text" name="satuan[]" id="satuan-1" value="-" class="form-control" readonly>
						</div>	
						<div class="col-md-4">
							<label for="satuan">Stok Awal</label>
							<input type="text" name="stok[]" id="stok-1" value="-" class="form-control"readonly>
						</div>
						<div class="col-md-4">
							<label for="satuan">Maksimum</label>
							<input type="text" name="kondisi[]" id="kondisi-1" value="-" class="form-control"readonly>
						</div>
					</div>
				</div> 
						<!-- <div class ="form-group">
							<label>Detail *</label>
							<input type="text"  name="detail[]" id="detail-1" class="form-control" placeholder="kulakan / tambahan / etc"required> 
						</div> -->
						<div class ="form-group">
							<label>Supplier</label>
							<select name="supplier[]" id="supplier-1" class="form-control">
								<option value="">-- Pilih --</option>
								<?php foreach($supplier as $supp => $value) {
									echo '<option value="'.$value->id_supplier.'">'.$value->nama.'</option>';
								} ?>
							</select>
						</div>
						<div class ="form-group">
							<label>Jumlah *</label>
							<input type="number"  name="jumlah[]" id="jumlah-1" class="form-control"required> 
						</div>
						</div>
						</div>

				<div class="form-group">
					<button type="submit" name="in_add" class="btn btn-success btn-flat">
						<i class="fa fa-paper-plane"></i>Simpan</button>
						<button type="Reset" class="btn btn-flat">Reset</button>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>

</section>

<div class="modal fade" id="modal-sukucadang">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Select Sukucadang</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered table-striped" id="table1">
					<thead>
						<tr>
							<th>Kode</th>
							<th>Nama</th>
							<th>Tipe</th>
							<th>Stok</th>
							<th>Satuan</th>
							<th>Maksimum</th>
							<th>Lokasi Rak</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($sukucadang as $s => $data) { ?>
						<tr> 
							<td><?=$data->id_sc?></td>
							<td><?=$data->nama?></td>
							<td><?=$data->tipe?></td>
							<td class="text-right"><?=$data->stok?></td>
							<td><?=$data->satuan?></td>
							<td><?=$data->kondisi?></td>
							<td><?=$data->lokasi_rak?></td>
							<td class="text-right">
								<button class="btn btn-xs btn-info select-id_sc"
								data-id_sc="<?=$data->id_sc?>"
								data-nama="<?=$data->nama?>"
								data-tipe="<?=$data->tipe?>"
								data-stok="<?=$data->stok?>"
								data-satuan="<?=$data->satuan?>"
								data-kondisi="<?=$data->kondisi?>"
								data-lokasi_rak="<?=$data->lokasi_rak?>"
								> 
								<i class="fa fa-check"></i> Select
								</button>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<!-- jQuery 3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- <script src="bower_components/jquery/dist/jquery.min.js"></script>  -->
<!-- Bootstrap 3.3.7 -->
<!-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>  -->
<!-- DataTables -->
<!-- <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->
<!-- <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<script>

	var i = 1;
  var actual_id = i;
  $('#add_baris').on('click', function() {
    addRow();
  });

  function addRow() {
    var row = $('#tambah .kecubung').length;
    row = row + 1;

	$('#tambah').append('<hr/><hr/>\
	<div class="kecubung" id="row' + row + '">\
	<div>\
						<label for="id_sc">Kode *</label>\
					</div>\
					<div class="form-group input-group">\
						<input type="text" name="id_sc[]" id="id_sc-' + row + '"class="form-control" readonly="true" required autofocus>\
						<span class="input-group-btn">\
							<button type="button" class="btn btn-info btn-flat" onclick="TampilPopUp(this.id)"  id="btn-add-' + row + '">\
								<i class="fa fa-search"></i>\
							</button>\
						</span>\
					</div>\
					<div class ="form-group">\
						<label>No. Surat Jalan</label>\
						<input type="text" name="no_stok[]" value="" class="form-control"/>\
					</div>\
					<div class ="form-group">\
					<div class="row">\
					<div class="col-md-8">\
						<label for="nama_sc">Nama Sukucadang *</label>\
						<input type="text"  name="nama[]" id="nama-' + row + '" class="form-control" readonly>\
						</div>\
						<div class="col-md-4">\
						<label for="nama_sc">Tipe *</label>\
						<input type="text"  name="tipe[]" id="tipe-' + row + '" class="form-control" readonly>\
						</div></div>\
					</div>\
					<div class ="form-group">\
						<div class="row">\
							<div class="col-md-4">\
								<label for="satuan">Satuan</label>\
								<input type="text" name="satuan[]" id="satuan-' + row + '" value="-" class="form-control" readonly>\
						</div>\
						<div class="col-md-4">\
							<label for="satuan">Stok Awal</label>\
							<input type="text" name="stok[]" id="stok-' + row + '" value="-" class="form-control"readonly>\
						</div>\
						<div class="col-md-4">\
							<label for="satuan">Maksimum</label>\
							<input type="text" name="kondisi[]" id="kondisi-' + row + '" value="-" class="form-control"readonly>\
						</div>\
					</div>\
						<div class ="form-group">\
							<label>Supplier</label>\
							<select name="supplier[]" id="supplier-' + row + '" class="form-control">\
								<option value="">-- Pilih --</option><?php foreach($supplier as $supp => $value) { echo '<option value="'.$value->id_supplier.'">'.$value->nama.'</option>';} ?> </select>\
						</div>\
						<div class ="form-group">\
							<label>Jumlah *</label>\
							<input type="number"  name="jumlah[]" id="jumlah-' + row + '" class="form-control"required>\
						</div>\
						</div>').children(':last');
  }
  function TampilPopUp(id) {
    id_tag = id.split("-")
    ids = id_tag[2]
    $('#modal-sukucadang').modal('show');
    PilihSelect(ids);
  }
  function PilihSelect() {
	console.log(ids)
	$('#table1').on('click', '.select-id_sc', function() {
		var id_sc = $(this).data('id_sc');
		var nama = $(this).data('nama');
		var tipe = $(this).data('tipe');
		var stok = $(this).data('stok');
		var kondisi = $(this).data('kondisi');
		var satuan = $(this).data('satuan');
		var lokasi_rak = $(this).data('lokasi_rak');
		$('#id_sc-' + ids).val(id_sc);
		$('#nama-' + ids).val(nama);
		$('#tipe-' + ids).val(tipe);
		$('#stok-' + ids).val(stok);
		$('#kondisi-' + ids).val(kondisi);
		$('#satuan-' + ids).val(satuan);
		$('#lokasi_rak-' + ids).val(lokasi_rak);
		$('#jumlah-' + ids).attr({
       "max" : kondisi - stok,
	   "placeholder" : "maksimum input tersisa " + (kondisi - stok),
    });;
		$('#modal-sukucadang').modal('hide');
	});
};
</script>