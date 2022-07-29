<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm mb-4 border-bottom-info">
	<div class="card-header bg-white py-3">
		<div class="row">
			<div class="col">
				<h4 class="h5 align-middle m-0 font-weight-bold text-info">
					Pengaturan Logo & Nama Web
				</h4>
			</div>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped dt-responsive nowrap">
			<thead>
				<tr>
					<th width="20%">Nama Aplikasi</th>
					<th width="20%">Logo</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?= $setting['nama'] ?></td>
					<td><img style="width: 100%; height: 100%; background-size: cover;" src="<?= base_url() ?>assets/img/logo/<?= $setting['logo']; ?>" class="img-thumbnail"></td>
					<td>
						<a href="<?= base_url('SettingWeb/edit/') . $setting['id'] ?>" class="btn btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
				</tr>
			</tbody>
		</table>
	</div>
</div>