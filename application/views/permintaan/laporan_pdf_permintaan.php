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
    <h3>Laporan Data Permintaan</h3>
    <p>Tanggal cetak: <?php echo date("Y-m-d"); ?></p>
    <br />
    <thead>
            <tr>
              <th>No</th>
              <th>No. Permintaan</th>
              <th>No POL</th>
              <th>Tanggal</th>
              <th>Status</th>
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
                <td> <?= $data->validasi; ?> </td>
              </tr>
            <?php } ?>
          </tbody>
    </table>
</body>

</html>