<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Data Purchase Order</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
          <li class="breadcrumb-item active">Data Purchase Order</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
        <?php $this->view('message') ?>
  <div class="card">
    <div class="card-header">
      <form method="post" action="<?php echo base_url('purchaseorder/datapo') ?>">
      Bulan
<select name="bulan">
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
Tahun
<select name="tahun">
<option selected disabled="">Select Tahun</option>
<?php
$query =  $this->db->from('tb_po_detail')->select('tanggal')->group_by('YEAR(tanggal)')->get();
if( $query->num_rows() > 0) {
    $result = $query->result_array();
    foreach( $result as $row )
    {
          $data = explode('-',$row['tanggal']);
          $tahun = $data[0];
      // var_dump($tahun);
      // die;
      echo '<option value="'.$tahun.'">'.$tahun.'</option>';
    }
} 
?>
</select>
<button type="submit">lihat data</button>
      </form>
      
    <div class="card-body">
      <div class="modal-body table-responsive">
        <table class="table table-bordered" id="table1">
          <thead>
            <tr>
              <th>#</th>
              <th>No. PO</th>
              <th>Detail</th>
              <th>Tanggal</th>
              <th>Note</th>
              <th>Validasi</th>
              <?php
              if ($this->session->userdata('jabatan') !== 'Kepala Gudang') { ?>
                <th>Validasi</th>
              <?php } 
              if ($this->session->userdata('jabatan') == 'Gudang') { ?>
                <th>Catatan</th>
                <th>Cetak</th>
                <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($purchase as $po => $data) {
              $pod = $this->db->get_where('tb_po', ['id_po' => $data->id_po])->row_array();
              $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $pod['id_supplier']])->row_array();
              $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $data->id_sc])->row_array();
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $pod['id_po'] ?></td>
                <td><button type="button" data-toggle="modal" data-target="#cek<?php echo $data->id?>">
                        lihat
                        </button></td>
                <td><?= $data->tanggal ?></td>
                
                <td><?= $pod['note'] ?></td>
                <td>
                    <?php if ($this->session->userdata('jabatan') === 'Kepala Gudang') {
                      if ($data->validasi != 'belum divalidasi') {
                        if ($data->validasi == 'ditolak') { ?>
                          <form method="post" action="<?php echo base_url('purchaseorder/datapo') ?>">
                          <input type="text" name="id" value="<?= $data->id ?>" hidden>
                            <input type="text" name="id_po" value="<?= $data->id_po ?>" hidden>
                            <input type="text" name="validasi" value="setuju" hidden>
                            <button type="submit">setuju</button>
                          </form>
                        <?php } elseif ($data->validasi == 'setuju') {
                          echo $data->validasi;
                        }
                      } else { ?>
                        <form method="post" action="<?php echo base_url('purchaseorder/datapo') ?>">
                        <input type="text" name="id" value="<?= $data->id ?>" hidden>
                          <input type="text" name="id_po" value="<?= $data->id_po ?>" hidden>
                          <input type="text" name="validasi" value="setuju" hidden>
                          <button type="submit">setuju</button>
                        </form>
                        <button type="button" data-toggle="modal" data-target="#exampleModal0<?= $data->id ?>">
                        tolak
                        </button>
                        
                    <?php }
                    } else {
                      echo $data->validasi . " kepala gudang";
                    } ?>
                  </td>

                <?php
                if ($this->session->userdata('jabatan') !== 'Kepala Gudang' && $data->validasi === 'setuju') { ?>
                  <td>
                    <?php
                    if ($this->session->userdata('jabatan') === 'Kepala Bengkel') {
                      if ($data->validasi1 != 'belum divalidasi') {
                        if ($data->validasi1 == 'ditolak') { ?>
                          <form method="post" action="<?php echo base_url('purchaseorder/datapo') ?>">
                          <input type="text" name="id" value="<?= $data->id ?>" hidden>
                            <input type="text" name="id_po" value="<?= $data->id_po ?>" hidden>
                            <input type="text" name="validasi1" value="setuju" hidden>
                            <input type="text" name="jumlah" value="<?= $data->jumlah ?>" hidden>
                            <input type="text" name="id_sc" value="<?= $data->id_sc ?>" hidden>
                            <button type="submit">setuju</button>
                          </form>
                        <?php } elseif ($data->validasi1 == 'setuju') {
                          echo $data->validasi1;
                        }
                      } else { ?>
                        <form method="post" action="<?php echo base_url('purchaseorder/datapo') ?>">
                        <input type="text" name="id" value="<?= $data->id ?>" hidden>
                          <input type="text" name="id_po" value="<?= $data->id_po ?>" hidden>
                          <input type="text" name="validasi1" value="setuju" hidden>
                          <input type="text" name="jumlah" value="<?= $data->jumlah ?>" hidden>
                          <input type="text" name="id_sc" value="<?= $data->id_sc ?>" hidden>
                          <button type="submit">setuju</button>
                        </form>
                        <button type="button" data-toggle="modal" data-target="#exampleModal1<?= $data->id ?>">
                        tolak
                        </button>
                        
                    <?php }
                    } else {
                      echo $data->validasi1;
                    } ?>
                  </td>
                <?php
                } elseif ($this->session->userdata('jabatan') !== 'Kepala Gudang') { ?> <td> <?= $data->validasi; ?> </td>
                <?php }
                if ($this->session->userdata('jabatan') == 'Gudang') {
              if ($data->validasi === 'ditolak' || $data->validasi1 === 'ditolak') {
                ?> <td> <button type="button" data-toggle="modal" data-target="#exampleModal2<?php echo $data->id ?>">
                        lihat
                        </button>
                        </td>
              <?php }else { ?>
                <td>tidak tesedia</td>
                <?php
              }
              } ?>
              <?php
                if ($this->session->userdata('jabatan') == 'Gudang') {
                ?>
              <td>
              <a href="<?= site_url('purchaseorder/edit/' . $data->id) ?>" class="btn btn-primary btn-xs">
									<i class="fa fa-pencil"></i> Ubah
								</a>
                <a class="btn btn-default btn-md" href="<?php echo base_url() . 'purchaseorder/laporan_print_purchaseorder/'.$data->id_po; ?>">
          <span class="glyphicon glyphicon-print"></span> Cetak
        </a>
        <!-- <a class="btn btn-warning btn-md" href="<?php echo base_url() . 'purchaseorder/laporan_pdf_purchaseorder/'.$data->id; ?>">
          <span class="glyphicon glyphicon-print"></span> Cetak PDF
        </a> -->
        <!-- <a class="btn btn-warning btn-md" href="<?php echo base_url() . 'purchaseorder/laporan_excel_purchaseorder/'.$data->id; ?>">
          <span class="glyphicon glyphicon-print"></span> Cetak Excel
        </a> -->
              </td>
               <?php
                }
                ?>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
</section>

<?php $no = 1;
            foreach ($purchase as $po => $data) {
              $pod = $this->db->get_where('tb_po', ['id_po' => $data->id_po])->row_array();
              $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $pod['id_supplier']])->row_array();
              $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $data->id_sc])->row_array();
            ?>
<div class="modal fade" id="exampleModal0<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="<?php echo base_url('purchaseorder/datapo') ?>">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tolak validasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="text" name="id" value="<?= $data->id ?>" hidden>
      <input type="text" name="id_po" value="<?= $data->id_po ?>" hidden>
      <input type="text" name="validasi" value="ditolak" hidden>
      <div class="form-group">
      <label for="comment">Alasan ditolak:</label>
      <textarea class="form-control" rows="5" name="catatan" value="" id="comment"></textarea>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
        <button type="submit" class="btn btn-primary">tolak</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>
<?php $no = 1;
            foreach ($purchase as $po => $data) {
              $pod = $this->db->get_where('tb_po', ['id_po' => $data->id_po])->row_array();
              $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $pod['id_supplier']])->row_array();
              $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $data->id_sc])->row_array();
            ?>
<div class="modal fade" id="exampleModal1<?= $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" action="<?php echo base_url('purchaseorder/datapo') ?>">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tolak validasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="text" name="id" value="<?= $data->id ?>" hidden>
      <input type="text" name="id_po" value="<?= $data->id_po ?>" hidden>
      <input type="text" name="validasi1" value="ditolak" hidden>
      <div class="form-group">
      <label for="comment">Alasan ditolak:</label>
      <textarea class="form-control" rows="5" name="catatan" value="" id="comment"></textarea>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
        <button type="submit" class="btn btn-primary">tolak</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php } ?>

<?php $no = 1;
            foreach ($purchase as $po => $data) {
              $pod = $this->db->get_where('tb_po', ['id_po' => $data->id_po])->row_array();
              $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $pod['id_supplier']])->row_array();
              $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $data->id_sc])->row_array();
            ?>
                        <div class="modal fade" id="exampleModal2<?php echo $data->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alasan Ditolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group">
      <label for="comment">Alasan ditolak:</label>
      <textarea class="form-control" rows="5" name="catatan" value="" id="comment" readonly><?= $data->catatan; ?></textarea>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
      </div>
    </div>
  </div>
</div>
            <?php } ?>

<?php $no = 1;
            foreach ($purchase as $po => $data) {
              $pod = $this->db->get_where('tb_po', ['id_po' => $data->id_po])->row_array();
              $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $pod['id_supplier']])->row_array();
              $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $data->id_sc])->row_array();
            ?>
<div class="modal fade" id="cek<?php echo $data->id?>" role="dialog" aria-labelledby="modaledit" aria-hidden="true">
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
							<th style="">Nama</th>
							<td><span id="nama_pel"></span><?= $sp['nama'] ?></td>
						</tr>
						<tr>
							<th>Alamat</th>
							<td><span id="nama_supplier"></span><?= $sp['alamat'] ?></td>
						</tr>
						<tr>
							<th>Telpon</th>
							<td><span id="nama_sc"></span</span><?= $sp['telepon'] ?></td>
						</tr>
						<tr>
							<th style="">Jumlah</th>
							<td><span id="jumlah"></span><?=$data->jumlah?></td>
						</tr>
            <tr>
							<th>Harga</th>
							<td><span id="harga"><?=$data->Harga?></span></td>
						</tr>
						<tr>
							<th>Nama barang</th>
							<td><span id="tanggal"></span><?= $sc['nama'] ?></td>
						</tr>
						<tr>
							<th>Nama Item</th>
							<td><span id="nama_item"><?= $sc['nama'] ?></span></td>
						</tr>
						<tr>
							<th>Metode Pembayaran</th>
							<td><span id="metode"><?= $pod['metode'] ?></span></td>
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
$('#exampleModal0<?= $data->id ?>').on('shown.bs.modal', function() {
  
});
$('#exampleModal1<?= $data->id ?>').on('shown.bs.modal', function() {
  
});
$('#exampleModal2<?php echo $data->id ?>').on('shown.bs.modal', function() {
  
});
$('#cek<?php echo $data->id?>').on('shown.bs.modal', function() {
  
});
</script>