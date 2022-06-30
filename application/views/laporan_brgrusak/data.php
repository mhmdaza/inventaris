<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-info">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                    Laporan Data Barang Rusak
                </h4>
            </div>
            <div class="col-auto">
                <button data-toggle="modal" data-target="#modalCetak" class="btn btn-sm btn-info btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-print"></i>
                    </span>
                    <span class="text">
                        Cetak Data
                    </span>
                </button>
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
                    <th>Jumlah Rusak</th>
                    <th>User</th>
                    <th>Status</th>
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
                            <td><?= $br['nama_barang']; ?></td>
                            <td><?= $br['jumlah_rusak'] . ' ' . $br['nama_satuan']; ?></td>
                            <td><?= $br['nama']; ?></td>
                            <td><div class="badge badge-xs badge-danger"><?= $br['status_barang']; ?></div></td>
                            
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

<div class="modal fade" id="modalCetak" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Cetak Data</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
            </div>
            <?= form_open('laporan/cetak_barangrusak'); ?>
              <div class="modal-body">
        
                <div class="form-group">
                    <label>Start Date</label>
                    <input type="date" class="form-control" name="start_date" required>
                </div>

                <div class="form-group">
                    <label>End Date</label>
                    <input type="date" class="form-control" name="end_date" required>
                </div>
              
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</button>
              </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>