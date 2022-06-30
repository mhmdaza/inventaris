<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-info">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                    Data Penempatan Barang
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('penempatanbarang/add') ?>" class="btn btn-sm btn-info btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Penempatan Barang
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Penempatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($penempatanbarang) :
                    $no = 1;
                    foreach ($penempatanbarang as $s) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $s['nama_penempatan']; ?></td>
                            <th>
                                <a href="<?= base_url('penempatanbarang/edit/') . $s['id_penempatan_brg'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('penempatanbarang/delete/') . $s['id_penempatan_brg'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>