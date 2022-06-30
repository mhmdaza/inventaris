<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-white py-3">
                <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                    Form Laporan
                </h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="laporan">Laporan Barang</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio">
                            <input value="barang_masuk" type="radio" id="barang_masuk" name="laporan" class="custom-control-input">
                            <label class="custom-control-label" for="barang_masuk">Barang Masuk</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="barang_keluar" type="radio" id="barang_keluar" name="laporan" class="custom-control-input">
                            <label class="custom-control-label" for="barang_keluar">Barang Keluar</label>
                        </div>

                        <?= form_error('laporan', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-lg-3 text-lg-right" for="tanggal">Tanggal Transaksi</label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input value="<?= set_value('tanggal'); ?>" name="tanggal" id="tanggal" type="text" class="form-control" placeholder="Periode Tanggal">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-fw fa-calendar"></i></span>
                            </div>
                        </div>
                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-lg-9 offset-lg-3">
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

                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="laporan">Data Master</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio">
                            <input value="supplier" type="radio" id="supplier" name="laporan" class="custom-control-input">
                            <label class="custom-control-label" for="supplier">Supplier</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="jenis" type="radio" id="jenis" name="laporan" class="custom-control-input">
                            <label class="custom-control-label" for="jenis">Jenis Barang</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input value="barang" type="radio" id="barang" name="laporan" class="custom-control-input">
                            <label class="custom-control-label" for="barang">Data Barang</label>
                        </div>
                        <div class="row form-group">
                    <div class="col-lg-9 offset-md-1 mt-3" style="margin-left:1px;">
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
                        <?= form_error('laporan', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>

                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>