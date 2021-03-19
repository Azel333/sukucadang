<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <h1>Purchase Order</h1>
      </div>
      <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active">Purchase Order</li>
      </ol>
      </div>
    </div>
  </div>  
</section>

<section class="content">
<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
  <div class="row">
    <div class="col-lg-4">
      <div class="position-relative p-3 bg-white">
        <table width="100%">
            <tr>
              <td style="vertical-align:top">
                <label for="date">Tanggal</label>
              </td>
              <td>
                <div class="form-group">
                <input name="date" type="date" id="date" value="<?=date('y-m-d')?>" class="form-control">
                </div>
              </td>
            </tr>
           <!--  <tr>
              <td style="vertical-align:top" width:30%>
                <label for="date">Plant</label>
              </td>
              <td>
                <div class="form-group">
                <input type="text" id="plant" value="<?=$this->fungsi->user_login()->plant?>" class="form-control" readonly>
                </div>
              </td>
            </tr> -->
            <tr>
              <td style="vertical-align:top" width:30%>
                <label for="date">Nama Cabang</label>
              </td>
              <td>
                <div class="form-group">
                <input type="text" id="cabang" value="<?= $cabang['nama_cbg']?>" class="form-control" disabled required>
                <input type="hidden" name="id_cabang" value="<?= $cabang['id_cabang']?>" class="form-control">
                </div>
              </td> 
            </tr>
          </table>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="position-relative p-3 bg-white">
            <label for="supplier">Supplier </label>
              <!-- <select name="supplier" class="form-control" id="supplier">
                  <option value="">-- Pilih --</option>
                  <?php foreach($supplier as $supp => $value) {
                    echo '<option value="'.$value->id_supplier.'">'.$value->nama.'</option>';
                } ?>
              </select> -->
              <select name="supplier" id="supplier" class="form-control">
													
													<option selected disabled="">Select supplier</option>
													<?php
													foreach($supplier as $row)
													{
														echo '<option value="'.$row->id_supplier.'">'.$row->nama.'</option>';
													}
													?>
												</select>
                        </table>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="position-relative p-3 bg-white">
          <div align="right">
            <h4><b>No. Purchase Order</b></h4>
            <h4><span name="idpo" id="idpo"><?= $id_po ?></span></h4>
            <input type="hidden" name="id_po" value="<?= $id_po ?>"/>
          </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-lg-12">
      <div class="position-relative p-3 bg-white table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode Item</th>
                <th>Nama Item</th>
                <th>Tipe</th>
                <th>Detail Item</th>
                <th>Lokasi Rak</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="cart_table">
              <tr id="tr_table">
                  <td colspan="9" class="text-center">Tidak ada item</td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-lg-3">
      <div class="position-relative p-3 bg-white">
          <table width="100%">
            <tr>
              <td style="vertical-align:top">
                <label for="sub_total">Metode Pembayaran</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="text" name="metode" id="sub_total" value="tagihan" class="form-control" readonly>
                </div>
              </td>
            </tr>
          </table>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="position-relative p-3 bg-white">
          <table width="100%">
            <tr>
              <td style="vertical-align:top; width:30%">
                <label for="note">Note</label>
              </td>
              <td>
                <div>
                  <textarea id="note" name="note" rows="3" class="form-control"></textarea>
                </div>
              </td>
            </tr>
          </table>
      </div>
    </div>
    <div class="col-lg-3">
      <div>
        <button id="reset" class="btn btn-flat btn-warning">
          <i class="fa fa-refresh"></i> Reset
        </button><br><br>
        <button id="processpo" class="btn btn-flat btn-success">
          <i class="fa fa-paper-plane-o"></i> Process PO
        </button>
      </div>
    </div>
  </div>
  <br>
  </form>
</section>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script>
	$(document).ready(function()
	{
		$('#supplier').change(function()
		{
			var id_supplier = $('#supplier').val();
			if(id_supplier != '')
			{
				$.ajax(
				{
					url:"<?php echo site_url('purchaseorder/supplier_data'); ?>",
					method:"POST",
					data:{id_supplier},
					success:function(data)
					{
            $('#cart_table').html(data);
            $('.table').on('click', '.btn-remove-item', function () {
    $(this).closest('tr').remove();
});
					}
				});
			}
			else
			{
				$('#cart_table').html('<tr><td colspan="9" class="text-center">Tidak ada item</td></tr>');
			}
		});
	});
</script>