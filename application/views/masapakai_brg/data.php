<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-info">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                    Data Masa Pakai Barang Sudah Lewat
                </h4>
            </div>
            <div class="col-auto">
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Penempatan Barang</th>
                    <th>Jenis Barang</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                    <th>Masa Pakai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                    foreach ($barang as $b) :
                        ?>
                    <?php if($b['masa_pakai'] < date('Y-m-d')) { ?>    
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['id_barang']; ?></td>
                            <td><?= $b['nama_barang']; ?></td>
                            <td><?= $b['nama_penempatan']; ?></td>
                            <td><?= $b['nama_jenis']; ?></td>
                            <td><?= $b['stok']; ?></td>
                            <td><?= $b['nama_satuan']; ?></td>
                            <td><?= $b['masa_pakai']; ?></td>
                        </tr>
                    <?php } ?> 
                    <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>