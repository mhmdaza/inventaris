<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-info">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                    Data Barang Rusak
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('barangrusak/add') ?>" class="btn btn-sm btn-info btn-icon-split">
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
                    <th>Tanggal</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>User</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($barangrusak) :
                    foreach ($barangrusak as $br) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $br['tgl_brg_rusak']; ?></td>
                            <td><?= $br['id_barang']; ?></td>
                            <td><?= $br['nama_barang']; ?></td>
                            <td><?= $br['jumlah_rusak'] . ' ' . $br['nama_satuan']; ?></td>
                            <td><?= $br['nama']; ?></td>
                            <td><?= $br['deskripsi']; ?></td>
                            <td>
                                <div class="badge badge-xs badge-danger"><?= $br['status_barang']; ?></div>
                            </td>
                            <td>
                                <a href="#modalHapusBrgRsk<?= $br['id_barang_rusak']; ?>" data-toggle="modal" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php foreach ($barangrusak as $c) { ?>

    <div class="modal fade" id="modalHapusBrgRsk<?= $c['id_barang_rusak']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <?= form_open('barangrusak/delete'); ?>
                <div class="modal-body">

                    <input type="hidden" value="<?= $c['id_barang_rusak']; ?>" required="" name="id_barang_rusak">
                    <input type="hidden" value="<?= $c['barang_id']; ?>" required="" name="barang_id">
                    <input type="hidden" value="<?= $c['jumlah_rusak']; ?>" required="" name="jumlah_rusak">

                    <div class="form-group">
                        <h4>Apakah Anda Ingin Menghapus Data Ini ?</h4>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

<?php } ?>