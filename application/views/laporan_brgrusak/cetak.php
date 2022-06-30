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
    .line-title{
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
                                                  <br/><font style="font-size: 12pt;font-family: Arial;">BPJS Ketenagakerjaan Cabang Pratama Kapuas</font>
                                                </span>
                                                <br><font style="font-size: 10pt;font-family: Times;">Jl. Tambun Bungai, Selat Tengah, Kec. Selat, Kabupaten Kapuas, Kalimantan Tengah 72516</font>
                                                <br><font style="font-size: 10pt;font-family: Times;">Telp. (0812) 2021061 Email: bpjsketenagakerjaan@gmail.com</font>
                                              </td>
                                            </tr>
                                          </table>
                                          
                                          <hr class="line-title"> 
                                          <p align="center">
                                            <b>LAPORAN BARANG RUSAK</b><br/>
                                            Periode : <?php echo $this->input->post('start_date') ?> s/d <?php echo $this->input->post('end_date') ?>
                                          </p>
      
                                    <hr/>

                                    <table class="table table-bordered">
                                    <tr>
                                        <th>No. </th>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Rusak</th>
                                        <th>User</th>
                                        <th>Status</th>
                                    </tr>
                                      
                                    <?php
                                        $no = 1;
                                        if ($barangrusak) :
                                            foreach ($barangrusak as $br) :
                                                ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $br['tgl_brg_rusak']; ?></td>
                                                    <td><?= $br['nama_barang']; ?></td>
                                                    <td><?= $br['jumlah_rusak'] . ' ' . $br['nama_satuan']; ?></td>
                                                    <td><?= $br['nama']; ?></td>
                                                    <td><?= $br['status_barang']; ?></td>
                                                    
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
                                        
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    
                                    <div style="float: right;">
                                      <center>
                                        Kuala Kapuas, <?php echo date('d-m-Y') ?>
                                        <br/>Kepala Kantor Cabang
                                        <br/>
                                        <br/>
                                        <br/>
                                        <br/>Agus Sutejo<hr/>
                                        NIP. 131149868
                                      </center>   
                                      </div>
                                      
                                    </div>
                                </div>

                                

                            </div>
                        </div>  



</body>


</html>