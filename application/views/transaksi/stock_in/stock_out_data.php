<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Suku Cadang Keluar</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
          <li class="breadcrumb-item active">Laporan Suku Cadang Keluar</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="card">
    <div class="card-header">
      <form method="post" action="<?php echo base_url('stock/stock_out_data') ?>">
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
$query =  $this->db->from('permintaan')->select('tanggal')->group_by('YEAR(tanggal)')->get();
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
    
    <div class="card-body">
      <div class="modal-body table-responsive">
        <table class="table table-bordered" id="table1">
          <thead>
            <tr>
              <th>No</th>
              <th>No. Permintaan</th>
              <th>No POL</th>
              <th>Tanggal</th>
              <th>Jumlah</th>
              <!-- <th>Action</th>
              <th>Status</th>
              <?php if ($this->session->userdata('jabatan') === 'Gudang') { ?>
      <th>Cetak</th>
      <?php } ?> -->
            </tr>
          </thead>
          <tbody>
            <?php foreach ($permintaan as $i => $data) {
              $pod = $this->db->get_where('permintaan', ['id_permintaan' => $data->id_permintaan])->row_array();
            ?>
              <tr>
                <td style="width:5%;"><?php echo ++$start ?>.</td>
                <td><?= $data->id_permintaan ?></td>
                <td><?= $pod['no_pol'] ?></td>
                <td><?= $pod['tanggal'] ?></td>
                <td><?= $data->jumlah ?></td>
                <!-- <td><a class="btn btn-default btn-xs" data-toggle="modal" data-target="#cek<?php echo $pod['id_pelanggan']?>">
						<i class="fa fa-eye"></i> Detail
						</a>
            <a href="<?= site_url('permintaan/edit/' . $data->id) ?>" class="btn btn-primary btn-xs">
									<i class="fa fa-pencil"></i> Edit
								</a></td>
                <?php if ($this->session->userdata('jabatan') === 'Gudang') { ?>
                  <td>
                    <?php if ($data->validasi != 'belum divalidasi') {
                      if ($data->validasi == 'ditolak') { ?>
                        <form method="post" action="<?php echo base_url('permintaan/validasi') ?>">
                          <input type="text" name="id" value="<?= $data->id ?>" hidden>
                          <input type="text" name="jumlah" value="<?= $data->jumlah ?>" hidden>
                          <input type="text" name="id_sc" value="<?= $data->id_sc ?>" hidden>
                          <input type="text" name="validasi" value="diproses" hidden>
                          <button type="submit">proses</button>
                        </form>
                      <?php } elseif ($data->validasi == 'diproses') { ?>
                        <form method="post" action="<?php echo base_url('permintaan/validasi') ?>">
                        <input type="text" name="id" value="<?= $data->id ?>" hidden>
                        <input type="text" name="jumlah" value="<?= $data->jumlah ?>" hidden>
                        <input type="text" name="id_sc" value="<?= $data->id_sc ?>" hidden>
                        <input type="text" name="validasi" value="selesai" hidden>
                        <button type="submit">selesai</button>
                      </form>
                      <?php } elseif ($data->validasi == 'selesai') {
                        echo $data->validasi;
                      }
                    } else { ?>
                      <form method="post" action="<?php echo base_url('permintaan/validasi') ?>">
                        <input type="text" name="id" value="<?= $data->id ?>" hidden>
                        <input type="text" name="jumlah" value="<?= $data->jumlah ?>" hidden>
                        <input type="text" name="id_sc" value="<?= $data->id_sc ?>" hidden>
                        <input type="text" name="validasi" value="diproses" hidden>
                        <button type="submit">proses</button>
                      </form>
                      <form method="post" action="<?php echo base_url('permintaan/validasi') ?>">
                        <input type="text" name="id" value="<?= $data->id ?>" hidden>
                        <input type="text" name="validasi" value="ditolak" hidden>
                        <button type="submit">tolak</button>
                      </form>
                    <?php } ?>
                  </td>
                <?php
                } else { ?> <td> <?= $data->validasi; ?> </td>
                <?php } ?> -->
                <!-- <td>
                <?php if ($this->session->userdata('jabatan') === 'Gudang') { ?>
        <a class="btn btn-default btn-md" href="<?php echo base_url() . 'permintaan/laporan_print_permintaan/'.$data->id; ?>">
          <span class="glyphicon glyphicon-print"></span> Print
        </a>
        <a class="btn btn-warning btn-md" href="<?php echo base_url() . 'permintaan/laporan_pdf_permintaan/'.$data->id; ?>">
          <span class="glyphicon glyphicon-print"></span> Cetak PDF
        </a>
        <a class="btn btn-warning btn-md" href="<?php echo base_url() . 'permintaan/laporan_excel_permintaan/'.$data->id; ?>">
          <span class="glyphicon glyphicon-print"></span> Cetak Excel
        </a>
      <?php } ?>
                </td> -->
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer">
        Footer
      </div>
    </div>
</section>

<?php $no = 1;
foreach ($permintaan as $i => $data) {
  $pod = $this->db->get_where('permintaan', ['id_permintaan' => $data->id_permintaan])->row_array();
  // $pel = $this->db->get_where('tb_pelanggan', ['id_pelanggan' => $pod['id_pelanggan']])->row_array();
  $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $data->id_sc])->row_array();?>
<div class="modal fade" id="cek<?php echo $pod['id_pelanggan']?>" role="dialog" aria-labelledby="modaledit" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Detail Data Permintaan</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered no-margin">
					<tbody>
						<tr>
							<th style="">Nama Pelanggan</th>
							<td><span id="nama_pel"></span><?= $pod['nama']?></td>
						</tr>
						<tr>
							<th>Telpon</th>
							<td><span id="nama_sc"></span><?= $pod['telepon'] ?></td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td><span id="nama_supplier"></span><?= $pod['alamat'] ?></td>
						</tr>
						<tr>
							<th style="">Kode SC</th>
							<td><span id="jumlah"></span><?= $sc['id_sc'] ?></td>
						</tr>
						<tr>
							<th>Nama barang</th>
							<td><span id="tanggal"></span><?= $sc['nama'] ?></td>
						</tr>
						<tr>
							<th>Lokasi Rak</th>
							<td><span id="tanggal"></span><?= $sc['lokasi_rak'] ?></td>
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
$('#cek<?php echo $pod['id_pelanggan'] ?>"').on('shown.bs.modal', function() {
  
});
</script>