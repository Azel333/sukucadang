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
  $pod = $this->db->get_where('permintaan', ['id_permintaan' => $purchase['id_permintaan']])->row_array();
  // $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $purchase['id_sc']])->row_array();
  //               $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $sc['id_supplier']])->row_array();
                $cb = $this->db->get_where('tb_cabang', ['id_cabang' => '1'])->row_array(); ?>
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
        <div><span>LAPORAN</span> Permintaan</div>
        <div><span>NO.POL</span> <?= $pod['no_pol'] ?></div>
        <div><span>CUSTOMER</span> <?= $pod['nama'] ?></div>
        <div><span>ALAMAT</span> <?= $pod['alamat'] ?></div>
        <div><span>TELEPON</span> <?= $pod['telepon'] ?></div>
        <div><span>TANGGAL</span> <?= $pod['tanggal'] ?></div>
        <div><span>CETAK</span> <?= date('Y-m-d'); ?></div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th>NO. PERMINTAAN</th>
            <th class="service">KODE BARANG</th>
            <th class="desc">NAMA BARANG</th>
            <th>JUMLAH</th>
            <th>HARGA</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($permintaan as $i => $data) {
              $pod = $this->db->get_where('permintaan', ['id_permintaan' => $data['id_permintaan']])->row_array();
  $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $data['id_sc']])->row_array();
                $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $sc['id_supplier']])->row_array();
                $cb = $this->db->get_where('tb_cabang', ['id_cabang' => '1'])->row_array();
            ?>
          <tr>
            <td><?= $data['id_permintaan'] ?></td>
            <td class="service"><?= $sc['id_sc'] ?></td>
            <td class="desc"><?= $sc['nama'] ?></td>
            <td class="unit"><?= $data['jumlah'].' '. $sc['satuan'] ?></td>
            <td class="qty"><?= $data['Harga'] ?></td>
            <td class="qty"><?= $data['Harga']*$data['jumlah'] ?></td>
          </tr>
          <?php } ?>
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