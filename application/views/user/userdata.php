<section class="content-header">
	<h1>Users
		<small>Pengguna</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-user"></i></a></li>
		<li class="active">Users</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Users</h3>
		<div class="pull-right">
		<a href="<?=site_url('user/add')?>" class="btn btn-primary btn-flat">
		<i class="fa fa-user-plus"></i> Tambah
	</a>
	</div>

	</div>

	<div class="box-body table-responsive">

		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>Username</th>
					<th>Nama</th>
					<th>Jabatan</th>
					<th>Action</th>
				</tr>

			</thead>
		<tbody>
			<?php $no = 1;
			foreach($row->result() as $key => $data) { ?>
				<tr>
					<td style="width:5%;"><?=$no++?>.</td>
					<td><?=$data->username?></td>
					<td><?=$data->nama?></td>
					<td><?=$data->jabatan?></td>
					<td class="text-center" width="160px">
					<!-- <form action="<?=site_url('user/del')?>" method="post"> -->
						<a href="<?=site_url('user/edit/'.$data->id)?>" class="btn btn-primary btn-xs">
							<i class="fa fa-pencil"></i> Edit
						</a>
						<a href="<?=site_url('user/del/'.$data->id)?>" onclick="return confirm('Yakin hapus data?')" class="btn btn-danger btn-xs">
							<i class="fa fa-trash"></i> Hapus
						</a>
					<!-- </form> -->
				</td>
			</tr>
			<?php
			 }?>
			</tbody>
		</table>
	</div>
</div>
</section>