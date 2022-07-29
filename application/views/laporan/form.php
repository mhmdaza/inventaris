<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                    Data Laporan
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <div class="card mx-auto" style="width: 35rem;">
                        <div class="card-header">
                            Laporan per periode
                        </div>
                        <div class="card-body mx-auto">
                            <div class="col-md">
                                <div class="custom-control custom-radio">
                                    <input value="barang_masuk" type="radio" id="barang_masuk" name="laporan" class="custom-control-input">
                                    <label class="custom-control-label" for="barang_masuk">Barang Masuk</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input value="barang_keluar" type="radio" id="barang_keluar" name="laporan" class="custom-control-input">
                                    <label class="custom-control-label" for="barang_keluar">Barang Keluar</label>
                                </div>
                                <?= form_error('laporan', '<span class="text-danger small">', '</span>'); ?>
                                <div class="row form-group mt-2">
                                    <label class="col-lg text-lg-right" for="tanggal">Tanggal Transaksi</label>
                                    <div class="col-lg-7">
                                        <div class="input-group">
                                            <input value="<?= set_value('tanggal'); ?>" name="tanggal" id="tanggal" type="text" class="form-control" placeholder="Periode Tanggal">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                                            </div>
                                        </div>
                                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="row form-group float-right mt-3">
                                    <div class="col-lg">
                                        <button type="submit" class="btn btn-info btn-icon-split">
                                            <span class="icon">
                                                <i class="fa fa-print"></i>
                                            </span>
                                            <span class="text">
                                                Cetak
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mx-auto" style="width: 35rem;">
                    <div class="card-body mx-auto">
                        <div class="row pt-3">
                            <div class="col-lg-6" style="width: 12rem;">
                                <div class="custom-control custom-radio">
                                    <input value="supplier" type="radio" id="supplier" name="laporan" class="custom-control-input">
                                    <label class="custom-control-label" for="supplier">Supplier</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input value="barang" type="radio" id="barang" name="laporan" class="custom-control-input">
                                    <label class="custom-control-label" for="barang">Data Barang</label>
                                </div>
                            </div>
                            <div class="col-lg-6" style="width: 15rem;">
                                <div class="custom-control custom-radio">
                                    <input value="pengguna_brg" type="radio" id="pengguna_brg" name="laporan" class="custom-control-input">
                                    <label class="custom-control-label" for="pengguna_brg">Penunjukan Barang</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input value="barang_rusak" type="radio" id="barang_rusak" name="laporan" class="custom-control-input">
                                    <label class="custom-control-label" for="barang_rusak">Barang Rusak</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input value="barang_maintenance" type="radio" id="barang_maintenance" name="laporan" class="custom-control-input">
                                    <label class="custom-control-label" for="barang_maintenance">Barang Maintenance</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4 float-right">
                            <div class="col-md">
                                <button type="submit" class="btn btn-info btn-icon-split">
                                    <span class="icon">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    <span class="text">
                                        Cetak
                                    </span>
                                </button>
                                <?= form_error('laporan', '<span class="text-danger small">', '</span>'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>