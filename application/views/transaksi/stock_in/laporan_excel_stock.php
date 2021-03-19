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
    <h3>Laporan Data Sukucadang Keluar</h3>
    <p>Tanggal cetak: <?php echo date("Y-m-d"); ?></p>
    <br>
    <table class="table-data">
    <thead>
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Jumlah</th>
					<th>Tanggal</th>
				</tr>

			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($row as $key => $data) { ?>
				<tr>
					<td style="width: 5%;"><?=$no++?>.</td>
					<td><?=$data->id_sc?></td>
					<td><?=$data->nama_sc?></td>
					<td class="text-right"><?=$data->jumlah?></td>
					<td class="text-center"><?=indo_date($data->tanggal)?></td>
				</tr>
				<?php
				}?>
			</tbody>
    </table>
</body>

</html>