<section class="content-header">
	<h1>Suku Cadang
		<small>Stok</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-user"></i></a></li>
		<li class="active">Suku Cadang</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<?php $this->view('message') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?=ucfirst($page)?> Suku Cadang</h3>
		<div class="pull-right">
		<a href="<?=site_url('sukucadang')?>" class="btn btn-warning btn-flat">
		<i class="fa fa-undo"></i> Kembali
	</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?=site_url('sukucadang/process')?>" method="post">
				<button type="button" id="add_baris" class="btn btn-success add-row glyphicon glyphicon-plus">Add</button>
				<div id="tambah">
					<div class="kecubung">
					<div class ="form-group">
						<input type="hidden" name="id[]" value="<?=$row->id_sc?>">
						<input type="hidden" name="id_sc[]" value="<?=$row->id_sc?>" class="form-control" required> 
					</div>
					<div class ="form-group">
							<label>Supplier</label>
							<select name="supplier[]" class="form-control">
								<option value="">-- Pilih --</option>
								<?php foreach($supplier as $supp => $value) {
									echo '<option value="'.$value->id_supplier.'">'.$value->nama.'</option>';
								} ?>
							</select>
						</div>
					<div class ="form-group">
						<label for="nama">Nama*</label>
						<input type="text" name="nama[]" id="nama" value="<?=$row->nama?>" class="form-control" required> 
					</div>
					<div class ="form-group">
						<label>Tipe *</label>
						<input type="text" name="tipe[]" value="<?=$row->tipe?>" class="form-control" required> 
					</div>
					<div class ="form-group">
						<label>Satuan *</label>
						<select name="satuan[]" class="form-control"required>
						<option value="">- Pilih -</option>
							<option value="btl"> Botol </option>
							<option value="pcs"> Pcs </option>
						</select> 
					</div>
					<div class ="form-group">
						<label>Lokasi Rak *</label>
						<input type="text" name="lokasi_rak[]" value="<?=$row->lokasi_rak?>" class="form-control" required> 
					</div>
					<div class ="form-group">
						<label>Safety Stock *</label>
						<input type="number" name="status[]" value="<?=$row->status?>" class="form-control" required> 
					</div>
					<div class ="form-group">
						<label>Maksimum Stock *</label>
						<input type="number" name="kondisi[]" value="<?=$row->kondisi?>" class="form-control" required> 
					</div>
					</div>
					</div>
					<div class="form-group">
						<button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">
							<i class="fa fa-paper-plane"></i>Simpan</button>
						<!-- <button type="Reset" class="btn btn-flat">Reset</button> -->
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
var i = 1;
  var actual_id = i;
  $('#add_baris').on('click', function() {
    addRow();
  });

  function addRow() {

	$('#tambah').append('<hr/><hr/>\
	<div class="kecubung">\
					<div class ="form-group">\
						<input type="hidden" name="id[]" value="<?=$row->id_sc?>">\
						<input type="hidden" name="id_sc[]" value="<?=$row->id_sc?>" class="form-control" required>\
					</div>\
					<div class ="form-group">\
							<label>Supplier</label>\
							<select name="supplier[]" class="form-control">\
								<option value="">-- Pilih --</option><?php foreach($supplier as $supp => $value) {echo '<option value="'.$value->id_supplier.'">'.$value->nama.'</option>'; } ?></select>\
						</div>\
					<div class ="form-group">\
						<label for="nama">Nama*</label>\
						<input type="text" name="nama[]" id="nama" value="<?=$row->nama?>" class="form-control" required>\
					</div>\
					<div class ="form-group">\
						<label>Satuan *</label>\
						<select name="satuan[]" class="form-control"required>\
						<option value="">- Pilih -</option>\
							<option value="btl"> Botol </option>\
							<option value="pcs"> Pcs </option>\
						</select>\
					</div>\
					<div class ="form-group">\
						<label>Lokasi Rak *</label>\
						<input type="text" name="lokasi_rak[]" value="<?=$row->lokasi_rak?>" class="form-control" required>\
					</div>\
					<div class ="form-group">\
						<label>Safety Stock *</label>\
						<input type="number" name="status[]" value="<?=$row->status?>" class="form-control" required>\
					</div>\
					<div class ="form-group">\
						<label>Maksimum Stock *</label>\
						<input type="number" name="kondisi[]" value="<?=$row->kondisi?>" class="form-control" required>\
					</div>\
					<div class ="form-group">\
						<label>Tipe *</label>\
						<input type="text" name="tipe[]" value="<?=$row->tipe?>" class="form-control" required>\
					</div>\
					</div>').children(':last');
  }
  </script>