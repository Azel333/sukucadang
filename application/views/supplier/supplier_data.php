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
<?php $this->view('message') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Supplier</h3>
		<div class="pull-right">
		<a href="<?=site_url('supplier/add')?>" class="btn btn-primary btn-flat">
		<i class="fa fa-plus"></i> Tambah
	</a>
	</div>

	</div>

	<div class="box-body table-responsive">

		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Alamat</th>
					<th>Telepon</th>
					<th>Action</th>
				</tr>	

			</thead>
		<tbody>
			<?php $no = 1;
			foreach($row->result() as $key => $data) { ?>
				<tr>
					<td style="width:5%;"><?=$no++?>.</td>
					<td><?=$data->nama?></td>
					<td><?=$data->alamat?></td>
					<td><?=$data->telepon?></td>
					<td class="text-center" width="160px">
						<a href="<?=site_url('supplier/edit/'.$data->id_supplier)?>" class="btn btn-primary btn-xs">
							<i class="fa fa-pencil"></i> Ubah
						</a>
						<button href="<?=site_url('supplier/del/'.$data->id_supplier)?>" onclick="confirmDelete(this)" class="btn btn-danger btn-xs">
							<i class="fa fa-trash"></i> Hapus
						</button>
					</td>
				</tr>
				<?php
			 	}?>
			</tbody>
		</table>
	</div>
</div>
</section>

<script type="text/javascript">
	function confirmDelete(ths) {
		console.log(ths);
		var urlHapus = $(ths).attr("href");
		swal.fire({
			title: "Yakin Hapus",
			icon: "question",
			showCancelButton: true,
			cancelButtonColor: "red",
		}).then(function(result) {
			if(result.value){
				window.location.href = urlHapus;
	        }else if(result.dismiss == 'cancel'){
	        	//
	        }
		});
	}
</script>