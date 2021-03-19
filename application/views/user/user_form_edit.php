<section class="content-header">
	<h1>User
		<small>Pengguna</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href=""><i class="fa fa-user"></i></a></li>
		<li class="active">User</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit User</h3>
		<div class="pull-right">
		<a href="<?=site_url('user')?>" class="btn btn-warning btn-flat">
		<i class="fa fa-undo"></i> Back
	</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="" method="post">
					<div class ="form-group <?=form_error('fullname') ? 'has-error' : null?>">
						<input type="hidden" name="id" value="<?=$this->input->post('id') ?? $row->id?>" class="form-control">
						<label>Nama *</label>
						<input type="text" name="fullname" value="<?=$this->input->post('fullname') ?? $row->nama?>" class="form-control">
						<?=form_error('fullname')?>
					</div>
					<div class ="form-group <?=form_error('username') ? 'has-error' : null?>">
						<label>Username *</label>
						<input type="text" name="username" value="<?=$this->input->post('username') ?? $row->username?>"class="form-control">
						<?=form_error('username')?>
					</div>
					<div class ="form-group <?=form_error('password') ? 'has-error' : null?>">
						<label>Password</label>
						<input type="password" name="password" value="<?=$this->input->post('password')?>"class="form-control">
						<?=form_error('password')?>
					</div>
					<div class ="form-group <?=form_error('passconf') ? 'has-error' : null?>">
						<label>Password Confirmation</label>
						<input type="passconf" name="passconf" value="<?=$this->input->post('passconf')?>" class="form-control">
						<?=form_error('passconf')?>
					</div>
					<div class ="form-group <?=form_error('jabatan') ? 'has-error' : null?>">
						<label>Jabatan</label>
						<select name="jabatan" class="form-control">
							<?php $jabatan = $this->input->post('jabatan') ? $this->input->post('jabatan') : $row->jabatan ?>
							<option value="1">Service Advisor</option>
							<option value="2"<?=$jabatan == 2 ? 'selected': null?>>Gudang</option>
							<option value="3">Kepala Gudang</option>
							<option value="4">Kepala Bengkel</option>
							<option value="5">Admin</option>
						</select>
						<?=form_error('jabatan')?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-flat">
							<i class="fa fa-paper-plane"></i>Simpan</button>
						<button type="Reset" class="btn btn-flat">Reset</button>
					</div>
				</form> 
			</div>
		</div>
	</div>
</div>

</section>