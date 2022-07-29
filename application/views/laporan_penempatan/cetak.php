<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo $title; ?></title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body style="background-color: white;" onload="window.print()">

  <style>
    .line-title {
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>

  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-body">
          <img src="<?php echo base_url('assets/img/logo/7c40faddf22c4aff151f1984cbc4b657.png') ?>" style="position: absolute; width: 250px; height: auto;">
          <table style="width: 100%;">
            <tr>
              <td align="center">
                <span style="line-height: 1.6; font-weight: bold;">
                  <font style="font-size: 15pt;font-family: Arial;">BPJS KETENAGAKERJAAN</font>
                  <br />
                  <font style="font-size: 12pt;font-family: Arial;">BPJS Ketenagakerjaan Cabang Pratama Kapuas</font>
                </span>
                <br>
                <font style="font-size: 10pt;font-family: Times;">Jl. Tambun Bungai, Selat Tengah, Kec. Selat, Kabupaten Kapuas, Kalimantan Tengah 72516</font>
                <br>
                <font style="font-size: 10pt;font-family: Times;">Telp. (0812) 2021061 Email: bpjsketenagakerjaan@gmail.com</font>
              </td>
            </tr>
          </table>

          <hr class="line-title">
          <p align="center">
            <b>LAPORAN PENEMPATAN BARANG</b>
          </p>

          <hr />

          <table class="table table-bordered">
            <tr>
              <th>No. </th>
              <th>ID Transaksi</th>
              <th>Tanggal</th>
              <th>Penerima</th>
              <th>Ruangan</th>
              <th>ID Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
            </tr>

            <?php
            $no = 1;
            if ($penempatan) :
              foreach ($penempatan as $p) :
            ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $p['id_penempatan']; ?></td>
                  <td><?= $p['tgl_penempatan']; ?></td>
                  <td><?= $p['nama_pegawai']; ?></td>
                  <td><?= $p['nama_ruangan']; ?></td>
                  <td><?= $p['barang_id']; ?></td>
                  <td><?= $p['nama_barang']; ?></td>
                  <td><?= $p['jumlah_penempatan'] . ' ' . $p['nama_satuan']; ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="8" class="text-center">
                  Data Kosong
                </td>
              </tr>
            <?php endif; ?>

          </table>

          <br />
          <br />
          <br />
          <br />
          <br />

          <div style="float: right;">
            <center>
              Kuala Kapuas, <?php echo date('d-m-Y') ?>
              <br />Kepala Kantor Cabang
              <br />
              <br />
              <br />
              <br />Agus Sutejo
              <hr />
              NIP. 131149868
            </center>
          </div>

        </div>
      </div>



    </div>
  </div>



  <!-- Mainly scripts -->
  <!-- <script src="../assets/js/jquery-3.1.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/plugins/dataTables/datatables.min.js"></script>

    <script src="../assets/js/inspinia.js"></script>
    <script src="../assets/js/plugins/pace/pace.min.js"></script>

    <script src="../assets/js/plugins/sweetalert/sweetalert.min.js"></script> -->

</body>


<!-- Mirrored from webapplayers.com/inspinia_admin-v2.9.4/table_data_tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Mar 2021 04:31:47 GMT -->

</html>