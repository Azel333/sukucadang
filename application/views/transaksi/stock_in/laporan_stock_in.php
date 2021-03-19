<section class="content-header">
	<h1>Sukucadang Masuk
		<small>Sukucadang Masuk</small>
	</h1>
	
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-user"></i>
		<i>Transaksi</i>
		<li class="active"> Stok Masuk</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Stok Masuk</h3>
		<div class="pull-right">
		<a>
		
	</a>
	</div>
<form method="post" action="<?php echo base_url('stock/laporan_in_data') ?>">
  <fieldset>
    <div class="form-group">
      <label for="disabledSelect">Bulan</label>
      <select name="bulan" id="disabledSelect" class="form-control">
		<option value="01">Januari</option>
<option value="02">Februari</option>
<option value="03">Maret</option>
<option value="04">April</option>
<option value="05">Mei</option>
<option value="06">Juni</option>
<option value="07">Juli</option>
<option value="08">Agustus</option>
<option value="09">September</option>
<option value="10">Oktober</option>
<option value="11">November</option>
<option value="12">Desember</option>
      </select>
    </div>
    <div class="form-group">
      <label for="disabledSelect">Tahun</label>
      <select name="tahun" id="disabledSelect" class="form-control">
        <option selected disabled="">Select Tahun</option>
<?php
$query =  $this->db->from('t_stok')->select('tanggal')->group_by('YEAR(tanggal)')->get();
if( $query->num_rows() > 0) {
    $result = $query->result_array();
    foreach( $result as $tel )
    {
          $data = explode('-',$tel['tanggal']);
          $tahun = $data[0];
      // var_dump($tahun);
      // die;
      echo '<option value="'.$tahun.'">'.$tahun.'</option>';
    }
} 
?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Lihat Data</button>
<a class="btn btn-warning btn-md" href="<?php echo base_url() . 'stock/laporan_excel_stock/'?>">
          <span class="glyphicon glyphicon-print"></span> Cetak Excel
        </a>
  </fieldset>
</form>
	</div>

	<div class="box-body table-responsive">

		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Tipe</th>
					<th>Jumlah</th>
					<th>Tanggal</th>
					<!-- <th>Action</th>
					<th>Cetak</th> -->
				</tr>

			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($row as $key => $data) { ?>
				<tr>
					<td style="width: 5%;"><?=$no++?>.</td>
					 <td><?=$data->id_sc?></td>
					<td><?=$data->nama_sc?></td>
					<td><?=$data->tipe?></td>
					<td class="text-right"><?=$data->jumlah?></td>
					<td class="text-center"><?=indo_date($data->tanggal)?></td>

					<!-- <td class="text-center" width="160px"> -->
						<!-- <a id="set_dtl" class="btn btn-default btn-xs" data-toggle="modal" data-target="#cek<?=$data->id_sc?>"
						data-id_sc="<?=$data->id_sc?>"
						data-nama_sc="<?=$data->nama_sc?>"
						data-detail="<?=$data->detail?>"
						data-nama_supplier="<?=$data->nama_supplier?>"
						data-jumlah="<?=$data->jumlah?>"
						data-tanggal="<?=indo_date($data->tanggal)?>"
						> -->
						<!-- <a class="btn btn-default btn-xs" data-toggle="modal" data-target="#cek<?php echo $data->id_sc?>">
						<i class="fa fa-eye"></i> Detail
						</a>
						<a href="<?= site_url('stock/stock_in_edit/' . $data->id_stok) ?>" class="btn btn-primary btn-xs">
									<i class="fa fa-pencil"></i> Edit
								</a>
					</td> -->
					<!-- <td>
					<a class="btn btn-default btn-md" href="<?php echo base_url() . 'stock/laporan_print_stock/'.$data->id_stok; ?>">
          <span class="glyphicon glyphicon-print"></span> Print
        </a>
        <a class="btn btn-warning btn-md" href="<?php echo base_url() . 'stock/laporan_pdf_stock/'.$data->id_stok; ?>">
          <span class="glyphicon glyphicon-print"></span> Cetak PDF
        </a>
        <a class="btn btn-warning btn-md" href="<?php echo base_url() . 'stock/laporan_excel_stock/'.$data->id_stok; ?>">
          <span class="glyphicon glyphicon-print"></span> Cetak Excel
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
							<td><span id="no_stok"></span><?=$data->no_stok?></td>
						</tr>
						<tr>
							<th>Nama</th>
							<td><span id="nama_sc"></span><?=$data->nama_sc?></td>
						</tr>
						<tr>
							<th>Detail</th>
							<td><span id="detail"><?=$data->detail?></span></td>
						</tr>
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
                <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
<script>
                    $('#cek<?php echo $data->id_sc?>"').on('shown.bs.modal', function() {
                        
                    });
                    
                    
                </script>