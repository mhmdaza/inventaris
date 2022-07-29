<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                            Form Input Penempatan Barang
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('penempatan') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', [], ['id_penempatan' => $id_penempatan]); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="id_penempatan">ID Transaksi Penempatan</label>
                    <div class="col-md-4">
                        <input value="<?= $id_penempatan; ?>" type="text" readonly="readonly" class="form-control">
                        <?= form_error('id_penempatan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="tgl_penempatan">Tanggal Penempatan</label>
                    <div class="col-md-4">
                        <input value="<?= set_value('tgl_penempatan', date('Y-m-d')); ?>" name="tgl_penempatan" id="tgl_penempatan" type="text" class="form-control date" placeholder="Tanggal Penempatan...">
                        <?= form_error('tgl_penempatan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="pegawai_id">Penerima Barang</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="pegawai_id" id="pegawai_id" class="custom-select">
                                <option value="" selected disabled>Pilih Pegawai</option>
                                <?php foreach ($pegawai as $p) : ?>
                                    <option value="<?= $p['id_pegawai'] ?>"><?= $p['nama_pegawai'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-info" href="<?= base_url('pegawai/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('pegawai_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="ruangan_id">Ruangan</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="ruangan_id" id="ruangan_id" class="custom-select">
                                <option value="" selected disabled>Pilih Ruangan</option>
                                <?php foreach ($ruangan as $r) : ?>
                                    <option value="<?= $r['id_ruangan'] ?>"><?= $r['nama_ruangan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-info" href="<?= base_url('ruanganbarang/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('ruangan_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="barang_id">Nama Barang</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="barang_id" id="barang_id" class="custom-select">
                                <option value="" selected disabled>Pilih Barang</option>
                                <?php foreach ($barang as $b) : ?>
                                    <option value="<?= $b['id_barang'] ?>"><?= $b['id_barang'] . ' | ' . $b['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                                <a class="btn btn-info" href="<?= base_url('barang/add'); ?>"><i class="fa fa-plus"></i></a>
                            </div>
                        </div>
                        <?= form_error('barang_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="stok">Stok</label>
                    <div class="col-md-5">
                        <input readonly="readonly" id="stok" type="number" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="jumlah_penempatan">Jumlah</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <input value="<?= set_value('jumlah_penempatan'); ?>" name="jumlah_penempatan" id="jumlah_penempatan" type="number" class="form-control" placeholder="Jumlah Barang...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan">Satuan</span>
                            </div>
                        </div>
                        <?= form_error('jumlah_penempatan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col offset-md-4">
                        <button type="submit" class="btn btn-info">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>