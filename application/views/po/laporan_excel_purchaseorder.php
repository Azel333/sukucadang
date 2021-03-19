<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=laporan.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <style type="text/css">
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid red;
            font-size: 10pt;
        }
    </style>
    <h3>Laporan Data Purchase Order</h3>
    <p>Tanggal cetak: <?php echo date("Y-m-d"); ?></p>
    <br>
    <table class="table-data">
        <thead>
            <tr>
            <tr>
                <th>#</th>
                <th>No. PO</th>
                <th>Supplier</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Nama Item</th>
                <th>Metode Pembayaran </th>
                <th>Note</th>
                <th>Validasi</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($purchase as $po => $data) {
                $pod = $this->db->get_where('tb_po', ['id_po' => $data->id_po])->row_array();
                $sp = $this->db->get_where('tb_supplier', ['id_supplier' => $pod['id_supplier']])->row_array();
                $sc = $this->db->get_where('tb_sukucadang', ['id_sc' => $data->id_sc])->row_array(); ?>
                <tr>
                    <td style="width:5%;"><?= $no++ ?>.</td>
                    <td><?= $no++ ?></td>
                    <td><?= $sp['nama'] ?></td>
                    <td><?= $pod['tanggal'] ?></td>
                    <td><?= $data->jumlah ?></td>
                    <td><?= $sc['nama'] ?></td>
                    <td><?= $pod['metode'] ?></td>
                    <td><?= $pod['note'] ?></td>
                    <td>
                        <?php echo $data->validasi1
                        ?>
                    </td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</body>

</html>