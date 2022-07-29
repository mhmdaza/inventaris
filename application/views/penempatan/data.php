<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-info">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                    Riwayat Data Penempatan Barang
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('penempatan/add') ?>" class="btn btn-sm btn-info btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Data
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>No Transaksi</th>
                    <th>Tanggal</th>
                    <th>Penerima</th>
                    <th>Ruangan</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
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
                            <td><?= $p['id_barang']; ?></td>
                            <td><?= $p['nama_barang']; ?></td>
                            <td><?= $p['jumlah_penempatan'] . ' ' . $p['nama_satuan']; ?></td>
                            <td>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('penempatan/delete/') . $p['id_penempatan'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>