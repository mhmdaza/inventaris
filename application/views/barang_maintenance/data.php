<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-info">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                    Riwayat Data Barang Maintenance
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('barangmaintenance/add') ?>" class="btn btn-sm btn-info btn-icon-split">
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
                    <th>Nama Barang</th>
                    <th>Jumlah Maintenance</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($barangmaintenance) :
                    foreach ($barangmaintenance as $bmain) :
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $bmain['tgl_brg_maintenance']; ?></td>
                            <td><?= $bmain['nama_barang']; ?></td>
                            <td><?= $bmain['jumlah_maintenance'] . ' ' . $bmain['nama_satuan']; ?></td>
                            <td><?= $bmain['nama']; ?></td>
                            <td>
                                <?php if ($bmain['status_barang'] == 'Maintenance') { ?>
                                    <div class="badge badge-xs badge-warning"><?= $bmain['status_barang'] ?></div>
                                <?php } else { ?>
                                    <div class="badge badge-xs badge-success"><?= $bmain['status_barang'] ?></div>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($bmain['status_barang'] == 'Maintenance') { ?>
                                    <a href="#modalSelesai<?= $bmain['id_barang_maintenance']; ?>" data-toggle="modal" title="Selesai" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-check-circle"></i></a>
                                    <a href="#modalHapusBrgMain<?= $bmain['id_barang_maintenance']; ?>" data-toggle="modal" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                                <?php } else { ?>
                                    <button class="btn btn-primary btn-sm">No Action</button>
                                <?php } ?>
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

<?php foreach ($barangmaintenance as $c) { ?>

    <div class="modal fade" id="modalHapusBrgMain<?= $c['id_barang_maintenance']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <?= form_open('barangmaintenance/delete'); ?>
                <div class="modal-body">

                    <input type="hidden" value="<?= $c['id_barang_maintenance']; ?>" required="" name="id_barang_maintenance">
                    <input type="hidden" value="<?= $c['barang_id']; ?>" required="" name="barang_id">
                    <input type="hidden" value="<?= $c['jumlah_maintenance']; ?>" required="" name="jumlah_maintenance">

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

<?php foreach ($barangmaintenance as $d) { ?>

    <div class="modal fade" id="modalSelesai<?= $d['id_barang_maintenance']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Selesai Data</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                </div>
                <?= form_open('barangmaintenance/selesai'); ?>
                <div class="modal-body">

                    <input type="hidden" value="<?= $d['id_barang_maintenance']; ?>" required="" name="id_barang_maintenance">
                    <input type="hidden" value="<?= $d['barang_id']; ?>" required="" name="barang_id">
                    <input type="hidden" value="<?= $d['jumlah_maintenance']; ?>" required="" name="jumlah_maintenance">

                    <div class="form-group">
                        <h4>Apakah Barang Ini Sudah Selesai Di Maintenance ?</h4>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Selesai</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>

<?php } ?>