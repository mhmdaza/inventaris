<div class="row">
		<div class="col-12">
			<div class="owl-carousel owl-theme">
				<?php foreach ($slider as $key => $value): ?>
					<div class="item">
						<img src="<?= base_url() ?>assets/img/slider/<?= $value['foto']; ?>"  width="200px">
					</div>
				<?php endforeach ?>

			</div>
			
		</div>
	</div>
	<div class="row mt-1">
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header bg-success py-3">
					<h6 class="m-0 font-weight-bold text-white text-center">Visi</h6>
				</div>
				<div class="py-3 text-center">
					<?= $visimisi['visi'] ?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card shadow mb-4">
				<div class="card-header bg-info py-3">
					<h6 class="m-0 font-weight-bold text-white text-center">Misi</h6>
				</div>
				<div class="py-3 text-center">
					<?= $visimisi['misi'] ?>
				</div>
			</div>
		</div>
	</div>