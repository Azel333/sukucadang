<style>

</style>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Permintaan Item</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard">Home</a></li>
          <li class="breadcrumb-item active">Permintaan Item</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<form id="form" action="<?php echo site_url('permintaan/create_action'); ?>" method="post">
  <section class="content">
    <div class="row">
      <div class="col-lg-5">
        <div class="position-relative p-3 bg-white">
          <div class="col-md-4 text-center">
            <div style="margin-top: 8px" id="message">
              <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
          </div>
          <table width="100%">
            <tr>
              <td style="vertical-align:top" width:30%>
                <label>Cabang</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="text" id="nama_cbg" value="PT Tunas Toyota" class="form-control" readonly>
                </div>
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top" width:30%>
                <label>Service Advisor</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="text" name="nama" id="nama" value="<?= $this->fungsi->user_login()->nama ?>" class="form-control" requireds>
                </div>
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <label for="date">Tanggal</label>
              </td>
              <td>
                <div class="form-group">
                  <input type="date" id="tanggal" name="tanggal" value="" class="form-control">
                </div>
              </td>
            </tr>
            <!-- <tr> -->
              <!-- <tr>
              <td style="vertical-align:top" width:30%>
                <label for="vendor">Pelanggan </label>
              </td> 
              <td>
                <div>
                <select id="vendor" name="vendor" class="form-control">
                <option value="">Nama Vendor</option>
                  <?php foreach ($vendor as $vdr => $value) {
                    echo '<option value="' . $value->id_vendor . '">' . $value->nama_vendor . '</option>';
                  } ?>
                </select>
              </div>
              <br>
              </td>
            </tr> -->
          </table>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="position-relative p-3 bg-white">
          <table width="100%">
          <tr>
            <th style="vertical-align:top" width:30%>
              <label>Pelanggan</label>
            </th>
            <td>
              <div>
                 <input type="text" name="nama" id="nama" value="" class="form-control" required> 
                <!-- <select id="nama_pelanggan" name="nama_pelanggan" class="form-control">
                  <option selected disabled="true">-Pilih-</option>
                  <?php foreach ($pelanggan as  $value) {
                    echo '<option value="' . $value->id_pelanggan . '">' . $value->nama . '</option>';
                  } ?>
                </select> -->
              </div>
            </td>
            </tr>
            <tr>
            <th style="vertical-align:top" width:30%>
              <label>Alamat</label>
            </th>
            <td>
              <div class="form-group">
                <textarea name="alamat" id="alamat" class="form-control" required></textarea>
              </div>
            </td>
            </tr>
            <td style="vertical-align:top" width:30%>
              <label>telepon</label>
            </td>
            <td>
              <div class="form-group">
                <input type="text" name="telepon" id="telepon" value="" class="form-control" required>
              </div>
            </td>
            <tr>
            <th style="vertical-align:top" width:30%>
              <label>No Pol</label>
            </th>
            <td>
              <div class="form-group">
                <input type="text" name="no_pol" id="no_pol" value="" class="form-control" required>
              </div>
            </td>
            </tr>
            <!--             <tr>
              <td style="vertical-align:top">
                <label for="date">Need by Date</label>
              </td>
              <td>
                <div class="form-group">
                <input type="date" id="needbydate" name="needbydate" value="" class="form-control">
                </div>
              </td>
            </tr> -->
            <!-- <tr>
              <td style="vertical-align:top">
                <label>Jenis Permintaan</label>
              </td>
              <td>
                <div>
                <select id="jenis" name="jenis" class="form-control">
                  <option value="">--- Pilih ---</option>
                  <option value="">Rutin</option>
                  <option value="">Tidak Rutin</option>
                </select>
              </div>
              <br>
              </td> -->
            <!-- <td>
                <div>
                <select id="jenis" name="jenis" class="form-control">
                  <option value="">--- Pilih ---</option>
                  <option value="">Rutin</option>
                  <option value="">Tidak Rutin</option>
                </select>
                </div>
              </td> -->
            </tr>

          </table>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="position-relative p-3 bg-white">
          <div align="right" class="form-group">
            <h4><b>No. Permintaan</b></h4>
            <h4><span name="id_permintaan" id="id_permintaan"><?= $id_permintaan ?></span></h4>
            <input type="hidden" name="id_permintaan" value="<?= $id_permintaan ?>" />
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-lg-12">
        <div class="position-relative p-3 bg-white table-responsive">
          <table class="table table-bordered table-striped autonumber" id="table_item">
            <thead>
              <tr>
                <th>#</th>
                <th>Kode Item</th>
                <th>Nama Item</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Stok</th>
                <th><button type="button" id="add_baris" class="btn btn-success add-row glyphicon glyphicon-plus">Add</button></th>
              </tr>
            </thead>
            <tbody id="cart_table">
              <tr class="autonumber">
                <!-- <td colspan="7" class="text-center">Tidak ada item</td> -->
                <td>1</td>
                <td>
                  <div class="form-group input-group">
                    <input type="text" name="id_sc[]" id="id_sc-1" class="form-control">

                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" onclick="TampilPopUp(this.id)" id="btn-add-1">Select
                      </button>
                    </span>
                  </div>
                </td>

                <!-- <td style="display:none;"> <input type="text" name="id_sc[]" id="id_sc-1" class="form-control"></td> -->
                <td> <input type="text" name="nama_sc[]" id="nama_sc-1" class="form-control"></td>
                <td> <input type="text" name="tipe_sc[]" id="tipe_sc-1" class="form-control"></td>
                <td> <input type="number" name="jumlah[]" id="jumlah_item-1" class="form-control"></td>
                <td> <input type="text" name="stok[]" id="stok_sc-1" class="form-control" readonly></td>
                <td> <button type="button" class="btn btn-danger delete-row icon-trash glyphicon glyphicon-trash">Hapus</button></td>

              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-lg-4">
        <div class="position-relative p-3 bg-white">
          <table width="100%">
            <tr>
              <div align="right" class="form-group">
                <td style="vertical-align:top">
                  <label for="date">Note</label>
                </td>
                <td>
                  <textarea id="note" name="note" rows="3" class="form-control" value=""></textarea>
                </td>
              </div>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="position-relative p-3 bg-white">
          <table width="100%">
            <tr>
              <td style="vertical-align:top" width:30%>
                <div align="center">
                  <button id="reset" type="reset" class="btn btn-flat btn-warning">
                    <i class="fa fa-refresh"></i> Reset
                  </button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div align="center" class="form-group">
                  <button type="submit" class="btn btn-flat btn-success">
                    <i class="fa fa-paper-plane-o"></i> Simpan
                  </button>
                </div>
              </td>
            </tr>
          </table>

        </div>
      </div>
    </div>
    <br>
  </section>
</form>
<div class="modal fade" id="modal-sukucadang">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title"><b>
            <font color="red">*Klik baris untuk memilih produk</font>
          </b></h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table-bordered table-striped" id="table1">
          <thead>
            <tr>
              <th>
                <font size="2">Kode</font>
              </th>
              <th>
                <font size="2">Nama</font>
              </th>
              <th>
                <font size="2">Tipe</font>
              </th>
              <th>
                <font size="2">Stok</font>
              </th>
              <th>
                <font size="2">Satuan</font>
              </th>
              <th>
                <font size="2">Lokasi Rak</font>
              </th>
              <th style="display:none;">
                <font size="2">id</font>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($sukucadang as $s => $data) { ?>
              <tr>
                <td>
                  <font size="2"><?= $data->id_sc ?></font>
                </td>
                <td>
                  <font size="2"><?= $data->nama ?></font>
                </td>
                <td>
                  <font size="2"><?= $data->tipe ?></font>
                </td>
                <td>
                  <font size="2"><?= $data->stok ?></font>
                </td>
                <td>
                  <font size="2"><?= $data->satuan ?></font>
                </td>
                <td>
                  <font size="2"><?= $data->lokasi_rak ?></font>
                </td>
                <!-- <td style="display:none;">
                  <font size="2"><?= $data->id_sc ?></font>
                </td> -->
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  var i = 1;
  var actual_id = i;
  $('#add_baris').on('click', function() {
    addRow();
  });

  function addRow() {
    var row = $('#table_item tbody tr').length;
    row = row + 1;

    $('#table_item tbody').append('<tr class="autonumber" id="row' + row + '">\
             <td>' + row + '</td>\
                <td>    <div class="form-group input-group">\
                  <input type="text" name="id_sc[]" id="id_sc-' + row + '" class="form-control">\
                  <span class="input-group-btn">\
                    <button type="button" class="btn btn-info btn-flat" onclick="TampilPopUp(this.id)"  id="btn-add-' + row + '">select           </button>\
                  </span>\
                </div></td>\
                <td>  <input type="text" name="nama_sc[]" id="nama_sc-' + row + '"  class="form-control"></td>\
                <td>  <input type="text" name="tipe_sc[]" id="tipe_sc-' + row + '"  class="form-control"></td>\
                <td>  <input type="number" name="jumlah[]" id="jumlah-' + row + '"  class="form-control"></td>\
                <td>  <input type="text" name="stok[]" id="stok_sc-' + row + '"  class="form-control"></td>\
                <td> <button type="button" class="btn btn-danger delete-row icon-trash glyphicon glyphicon-trash">Hapus</button></td>\
              </tr>').children(':last');
  }

  function TampilPopUp(id) {
    id_tag = id.split("-")
    console.log(id_tag);
    ids = id_tag[2]
    $('#modal-sukucadang').modal('show');
    PilihSelect(ids);
  }

  function PilihSelect() {
    console.log(ids)
    $('#table1').on('click', 'tbody tr ', function() {
      var data = $(this).find('td').map(function() {
        return $(this).text()
      })
      console.log(data)
      $('#id_sc-' + ids).val(data[0]);
      $('#nama_sc-' + ids).val(data[1]);
      $('#tipe_sc-' + ids).val(data[2]);
      $('#stok_sc-' + ids).val(data[3]);
      // $('#satuan-'+ids).val(data[3]);
      // $('#lokasi_rak-'+ids).val(data[4]);
      // $('#id_sc-' + ids).val(data[5]);

      $('#modal-sukucadang').modal('hide');
    });
  }

  $(document).ready(function() {
    //alert('')
    // $(document).on('click','#select', function() {
    // 	var id_sc = $(this).data('id_sc');
    // 	var nama = $(this).data('nama');
    // 	var stok = $(this).data('stok');
    // 	var satuan = $(this).data('satuan');
    // 	var lokasi_rak = $(this).data('lokasi_rak');
    // 	$('#note'.val(nama);
    // 	$('#id_sc'.val(id_sc);
    // 	$('modal-sukucadang').modal('hide');
    // })
  })

  $("#form").on("submit", function(e) {
    // e.preventDefault()
    // $.ajax({
    //   type: "POST",
    //   url: "#",
    //   data: $("#form").serialize(),
    //   success: "#",
    // });
  })


  $('#nama_pelanggan').change(function() {
    var id = $(this).val();
    $.ajax({
      url: "<?php echo site_url('permintaan/get_alamat'); ?>",
      method: "POST",
      data: {
        id: id
      },
      async: true,
      dataType: 'json',
      success: function(data) {
        $('#alamat').val(data.alamat);
        console.log(data)
        //  alert(data.alamat)
        // var html = '';
        // var i;
        // for(i=0; i<data.length; i++){
        //     html += '<option value='+data[i].subcategory_id+'>'+data[i].subcategory_name+'</option>';
        // }
        // $('#sub_category').html(html);

      }
    });
    return false;
  });

  // function pilihan(id){
  //   var site = id
  //   url = '{{ route('ehsenv.filter_site') }}'
  //   token = window.Laravel.csrfToken

  //   $.ajax({
  //     url : url,
  //     type : 'POST',
  //     dataType : 'json',
  //     data : {
  //       site : site,
  //       _token : token,
  //     },
  //     success: function(_response) {
  //       if (_response.indctr == '1') {
  //         console.log(_response.msg)
  //         var html = "";
  //         _response.kd_ot.forEach(myFunction);
  //         function myFunction(item,index,change){
  //           html += '<option value="'+item.kd_ot+'">'+item.kd_ot+'</option>';
  //           console.log(item.kd_ot)
  //         }
  //         $('#kd_ot').html(html)

  //       } else if (_response.indctr == '0') {
  //         console.log(_response.msg)

  //       }
  //     },
  //     error: function() {
  //       console.log(_response.msg)

  //     }
  //   })
  // }
</script>