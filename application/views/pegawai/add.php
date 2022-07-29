<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-info">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-info">
                            Form Tambah Pegawai
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('pegawai') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_pegawai">Nama pegawai</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_pegawai'); ?>" name="nama_pegawai" id="nama_pegawai" type="text" class="form-control">
                        <?= form_error('nama_pegawai', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nip">NIP</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nip'); ?>" name="nip" id="nip" type="text" class="form-control">
                        <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="jabatan" class="col-md-3 text-md-right">Jabatan</label>
                    <select class="form-control col-md-8" style="margin-left: 10px;" id="jabatan" name="jabatan">
                        <option selected disabled>Pilih Jabatan</option>
                        <option value="Kepala Kantor">Kepala Kantor</option>
                        <option value="Penata Madya Keuangan & IT">Penata Madya Keuangan & IT</option>
                        <option value="Account Representative Perwakilan">Account Representative Perwakilan</option>
                        <option value="Penata Madya Pelayanan & Umum">Penata Madya Pelayanan & Umum</option>
                        <option value="Alih Daya">Alih Daya</option>
                    </select>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="alamat">Alamat</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('alamat'); ?>" name="alamat" id="alamat" type="text" class="form-control">
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="telp">Telp</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('telp'); ?>" name="telp" id="telp" type="text" class="form-control">
                        <?= form_error('telp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="tmt">TMT</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('tmt'); ?>" name="tmt" id="tmt" type="date" class="form-control">
                        <?= form_error('tmt', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>