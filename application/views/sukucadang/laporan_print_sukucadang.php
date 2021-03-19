<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/style.css'); ?>" media="all" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">
    <style>@page { size: A4 }</style>
  </head>
  <?php
//   $pod = $this->db->get_where('permintaan', ['id_permintaan' => $p['id_permintaan']])->row_array();
  $p = $this->db->get_where('tb_po_detail', ['id_po' => $purchase['id_sc']])->row_array();
                $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $purchase['id_supplier']])->row_array();
                $cb = $this->db->get_where('tb_cabang', ['id_cabang' => '1'])->row_array(); 
                $cs = $this->db->get_where('t_stok', ['id_sc' => $purchase['id_sc']])->row_array(); 
                ?>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo base_url('assets/logo.jpeg'); ?>">
      </div>
      <h1>Permintaan</h1>
      <div id="company" class="clearfix">
        <div>Tunas Toyota</div>
        <div><?= $cb['alamat'] ?></div>
        <div><?= $cb['telepon'] ?></div>
      </div>
      <div id="project">
        <div><span>LAPORAN</span> Sukucadang</div>
        <div><span>SUPPLIER</span> <?= $sp['nama'] ?></div>
        <div><span>ALAMAT</span> <?= $sp['alamat'] ?></div>
        <div><span>TELEPON</span> <?= $sp['telepon'] ?></div>
        <!-- <div><span>TANGGAL</span> <?= $pod['tanggal'] ?></div> -->
        <div><span>CETAK</span> <?= date('Y-m-d'); ?></div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
          <th>NO. SURAT JALAN</th>
            <th class="service">KODE BARANG</th>
            <th class="desc">NAMA BARANG</th>
            <th>JUMLAH</th>
            <th>SATUAN</th>
            <th>Lokasi Rak</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?= $cs['no_stok'] ?></td>
            <td class="service"><?= $purchase['id_sc'] ?></td>
            <td class="desc"><?= $purchase['nama'] ?></td>
            <td class="unit"><?= $cs['jumlah'] ?></td>
            <td class="qty"><?= $purchase['satuan'] ?></td>
            <td class="qty"><?= $purchase['lokasi_rak'] ?></td>
          </tr>
        </tbody>
      </table>
    </main>
    <footer>
      Was created on a computer and is valid without the signature and seal.
    </footer>
    </section>
    <script type="text/javascript">
        window.print();
    </script>
  </body>
</html>