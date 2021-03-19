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
  $pod = $this->db->get_where('tb_po', ['id_po' => $purchase['id_po']])->row_array();
                $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $purchase['id_supplier']])->row_array();
                $cb = $this->db->get_where('tb_cabang', ['id_cabang' => '1'])->row_array();
                $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $purchase['id_sc']])->row_array(); ?>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo base_url('assets/logo.jpeg'); ?>">
      </div>
      <h1>Suku Cadang Keluar</h1>
      <div id="company" class="clearfix">
        <div>Tunas Toyota</div>
        <div><?= $cb['alamat'] ?></div>
        <div><?= $cb['telepon'] ?></div>
      </div>
      <div id="project">
        <div><span>LAPORAN</span> Suku Cadang Keluar</div>
        <div><span>SUPPLIER</span> <?= $sp['nama'] ?></div>
        <div><span>ALAMAT</span> <?= $sp['alamat'] ?></div>
        <div><span>TELEPON</span> <?= $sp['telepon'] ?></div>
        <div><span>TANGGAL</span> <?= $purchase['tanggal'] ?></div>
        <div><span>CETAK</span> <?= date('Y-m-d'); ?></div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">KODE BARANG</th>
            <th class="desc">NAMA BARANG</th>
            <th>JUMLAH</th>
            <th>DETAIL</th>
            <th>SATUAN</th>
            <th>Lokasi Rak</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="service"><?= $sc['id_sc'] ?></td>
            <td class="desc"><?= $sc['nama'] ?></td>
            <td class="unit"><?= $purchase['jumlah'] ?></td>
            <td class="unit"><?= $purchase['detail'] ?></td>
            <td class="qty"><?= $sc['satuan'] ?></td>
            <td class="qty"><?= $sc['lokasi_rak'] ?></td>
          </tr>
        </tbody>
      </table>
    </main>
    <footer>
      Was created on a computer and is valid without the signature and seal.
    </footer>
    </section>
    <!-- <script type="text/javascript">
        window.print();
    </script> -->
  </body>
</html>