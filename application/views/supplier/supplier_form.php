<section class="content-header">
	<h1>Supplier
		<small>Pemasok Barang</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-user"></i></a></li>
		<li class="active">Supplier</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?=ucfirst($page)?> Supplier</h3>
		<div class="pull-right">
		<a href="<?=site_url('supplier')?>" class="btn btn-warning btn-flat">
		<i class="fa fa-undo"></i> Kembali
	</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?=site_url('supplier/process')?>" method="post">
					<div class ="form-group">
						<label>Nama Supplier *</label>
						<input type="hidden" name="id" value="<?=$row->id_supplier?>">
						<input type="text" name="nama_supplier" value="<?=$row->nama?>" class="form-control" required> 
					</div>
					<div class ="form-group">
						<label>Alamat *</label>
						<textarea name="alamat" class="form-control" required><?=$row->alamat?></textarea> 
					</div>
					<div class ="form-group">
						<label>Telepon *</label>
						<input type="number" name="telepon" value="<?=$row->telepon?>" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">
							<i class="fa fa-paper-plane"></i>Simpan</button>
						<button type="Reset" class="btn btn-flat">Reset</button>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>

</section>