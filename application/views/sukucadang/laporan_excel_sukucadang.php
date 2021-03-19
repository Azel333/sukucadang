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
            border: 1px solid black;
            font-size: 10pt;
        }
    </style>
    <h3>Laporan Data Suku Cadang</h3>
    <p>Tanggal cetak: <?php echo date("Y-m-d"); ?></p>
    <br>
    <table class="table-data">
        <thead>
            <tr>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Supplier</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Lokasi Rak</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($row->result() as $key => $data) { ?>
                <tr>
                    <td style="width:5%;"><?= $no++ ?>.</td>
                    <td><?= $data->id_sc ?></td>
                    <td><?= $data->supplier_nama ?></td>
                    <td><?= $data->nama ?></td>
                    <td><?= $data->stok ?></td>
                    <td><?= $data->satuan ?></td>
                    <td><?= $data->lokasi_rak ?></td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</body>

</html>