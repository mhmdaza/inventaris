<?php
$query = "SELECT * FROM setting_app";
$setting = $this->db->query($query)->row_array();
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title><?= $title; ?> | <?= $setting['nama'] ?></title>

	<!-- Custom fonts for this template-->
	<link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>assets/css/fonts.min.css" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Datepicker -->
	<link href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet">

	<!-- DataTables -->
	<link href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/datatables/buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/datatables/responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/gijgo/css/gijgo.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/caraosel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/caraosel/assets/owl.theme.default.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>assets/vendor/summernote/summernote.min.css" rel="stylesheet">

	<style>
		#accordionSidebar,
		.topbar {
			z-index: 2;
		}
	</style>
</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav sidebar sidebar-light accordion shadow-sm" id="accordionSidebar" style="background-color: rgba(192,192,192, 0.2);">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center bg-white justify-content-center" href="dashboard.php">
				<div class="sidebar-brand-icon mb-1">
					<img src="<?= base_url('assets/img/logo/') . $setting['logo'] ?>" alt="bpjamsostek" style="width: 185px; max-height: 185px; background-size: cover;">
				</div>
			</a>

			<!-- Nav Item - Dashboard -->
			<div class="wrapper font-weight-bold">
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('dashboard'); ?>">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Dashboard</span>
					</a>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider">

				<!-- Heading -->
				<div class="sidebar-heading">
					Data Master
				</div>

				<!-- Nav Item - Dashboard -->
				<li class="nav-item">
					<a class="nav-link pb-0" href="<?= base_url('supplier'); ?>">
						<i class="fas fa-fw fa-users"></i>
						<span>Supplier</span>
					</a>
				</li>

				<?php if (is_admin()) : ?>
					<li class="nav-item">
						<a class="nav-link pb-0" href="<?= base_url('pegawai'); ?>">
							<i class="fas fa-fw fa-user-tie"></i>
							<span>Pegawai</span>
						</a>
					</li>
				<?php endif; ?>

				<!-- Nav Item - Pages Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
						<i class="fas fa-fw fa-box"></i>
						<span>Barang</span>
					</a>
					<div id="collapseMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-light py-2 collapse-inner rounded">
							<h6 class="collapse-header">Master Barang:</h6>
							<a class="collapse-item" href="<?= base_url('jenis'); ?>">Jenis Barang</a>
							<a class="collapse-item" href="<?= base_url('satuan'); ?>">Satuan Barang</a>
							<a class="collapse-item" href="<?= base_url('barang'); ?>">Data Barang</a>
							<a class="collapse-item" href="<?= base_url('ruanganbarang'); ?>">Ruangan</a>
						</div>
					</div>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider">

				<!-- Heading -->
				<div class="sidebar-heading">
					Transaction
				</div>

				<!-- Nav Item -->
				<li class="nav-item">
					<a class="nav-link pb-0" href="<?= base_url('barangmasuk'); ?>">
						<i class="fas fa-fw fa-download"></i>
						<span>Barang Masuk</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link pb-0" href="<?= base_url('barangkeluar'); ?>">
						<i class="fas fa-fw fa-upload"></i>
						<span>Barang Keluar</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link pb-0" href="<?= base_url('penempatan'); ?>">
						<i class="fas fa-fw fa-thumbtack"></i>
						<span>Penempatan Barang</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link pb-0" href="<?= base_url('pengguna'); ?>">
						<i class="fas fa-fw fa-hand-holding-usd"></i>
						<span>Penunjukan Barang</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link pb-0" href="<?= base_url('barangrusak'); ?>">
						<i class="fas fa-fw fa-fire"></i>
						<span>Barang Rusak</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link pb-0" href="<?= base_url('barangmaintenance'); ?>">
						<i class="fas fa-fw fa-tools"></i>
						<span>Barang Maintenance</span>
					</a>
				</li>

				<!-- Divider -->
				<hr class="sidebar-divider">
				<!-- Laporan -->

				<div class="sidebar-heading">
					Reports
				</div>

				<!-- Nav Item - Pages Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link pb-0" href="<?= base_url('laporan'); ?>">
						<i class="fas fa-fw fa-book"></i>
						<span>Laporan Barang</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="<?= base_url('laporan/penempatanbarang'); ?>">
						<i class="fas fa-fw fa-book"></i>
						<span>Laporan Penempatan</span>
					</a>
				</li>

				<!-- Settings -->
				<?php if (is_admin()) : ?>
					<!-- Divider -->
					<hr class="sidebar-divider">

					<!-- Heading -->
					<div class="sidebar-heading">
						Settings
					</div>

					<!-- Nav Item - Utilities Collapse Menu -->
					<li class="nav-item">
						<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
							<i class="fas fa-fw fa-cog"></i>
							<span>Pengaturan</span>
						</a>
						<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
							<div class="bg-white py-2 collapse-inner rounded">
								<h6 class="collapse-header">Pengaturan Web:</h6>
								<a class="collapse-item" href="<?= base_url('user'); ?>">Manajemen User</a>
								<a class="collapse-item" href="<?= base_url('SettingWeb'); ?>">Nama & Logo Web</a>
								<a class="collapse-item" href="<?= base_url('slider'); ?>">Carousel</a>
								<a class="collapse-item" href="<?= base_url('SettingWeb/visimisi'); ?>">Visi & Misi</a>
							</div>
						</div>
					</li>
				<?php endif; ?>
			</div>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-dark bg-white topbar mb-4 static-top shadow-sm">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link bg-transparent d-md-none rounded-circle mr-3">
						<i class="fa fa-bars text-white"></i>
					</button>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline small text-capitalize text-dark">
									<?= userdata('nama'); ?>
								</span>
								<img class="img-profile rounded-circle" src="<?= base_url() ?>assets/img/avatar/<?= userdata('foto'); ?>">
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="<?= base_url('profile'); ?>">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>
								<a class="dropdown-item" href="<?= base_url('profile/setting'); ?>">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Settings
								</a>
								<a class="dropdown-item" href="<?= base_url('profile/ubahpassword'); ?>">
									<i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
									Change Password
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

					<?= $contents; ?>

				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-light">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; 2021 BPJS Ketenagakerjaan. All Right Reserved.</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Yakin ingin logout?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">??</span>
					</button>
				</div>
				<div class="modal-body">Klik "Logout" dibawah ini jika anda yakin ingin logout.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
					<a class="btn btn-info" href="<?= base_url('logout'); ?>">Logout</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- Custom scripts for all pages-->
	<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

	<!-- Datepicker -->
	<script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.min.js"></script>

	<!-- Page level plugins -->
	<script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/jszip/jszip.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/pdfmake.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/vfs_fonts.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.html5.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.print.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.colVis.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/caraosel/owl.carousel.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/gijgo/js/gijgo.min.js"></script>
	<script src="<?= base_url(); ?>assets/vendor/summernote/summernote.min.js"></script>

	<script type="text/javascript">
		$(function() {
			$('.date').datepicker({
				uiLibrary: 'bootstrap4',
				format: 'yyyy-mm-dd'
			});

			var start = moment().subtract(29, 'days');
			var end = moment();

			function cb(start, end) {
				$('#tangal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
			}

			$('#tanggal').daterangepicker({
				startDate: start,
				endDate: end,
				ranges: {
					'Hari ini': [moment(), moment()],
					'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'7 hari terakhir': [moment().subtract(6, 'days'), moment()],
					'30 hari terakhir': [moment().subtract(29, 'days'), moment()],
					'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
					'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
					'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
					'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
				}
			}, cb);

			cb(start, end);
		});
	</script>
	<script type="text/javascript">
		let hal = '<?= $this->uri->segment(1); ?>';

		let satuan = $('#satuan');
		let harga_barang = $('#harga_barang');
		let stok = $('#stok');
		let total = $('#total_stok');
		let total_harga = $('#total_harga');
		let jumlah = hal == 'barangmasuk' ? $('#jumlah_masuk') : $('#jumlah_keluar');

		$(document).on('change', '#barang_id', function() {
			let url = '<?= base_url('barang/getstok/'); ?>' + this.value;
			$.getJSON(url, function(data) {
				satuan.html(data.nama_satuan);
				stok.val(data.stok);
				harga_barang.val(data.harga_barang);
				total.val(data.stok);
				jumlah.focus();
			});
		});

		$(document).on('keyup', '#jumlah_masuk', function() {
			let totalStok = parseInt(stok.val()) + parseInt(this.value);
			total.val(Number(totalStok));
		});

		$(document).on('keyup', '#jumlah_masuk', function() {
			let totalHarga = parseInt(harga_barang.val()) * parseInt(this.value);
			total_harga.val(Number(totalHarga));
		});

		$(document).on('keyup', '#jumlah_rusak', function() {
			let totalStok = parseInt(stok.val()) - parseInt(this.value);
			total.val(Number(totalStok));
		});

		$(document).on('keyup', '#jumlah_maintenance', function() {
			let totalStok = parseInt(stok.val()) - parseInt(this.value);
			total.val(Number(totalStok));
		});

		$(document).on('keyup', '#jumlah_keluar', function() {
			let totalStok = parseInt(stok.val()) - parseInt(this.value);
			total.val(Number(totalStok));
		});
	</script>

	<?php if ($this->uri->segment(1) == 'dashboard') : ?>
		<!-- Chart -->
		<script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

		<script type="text/javascript">
			// Set new default font family and font color to mimic Bootstrap's default styling
			Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
			Chart.defaults.global.defaultFontColor = '#858796';

			function number_format(number, decimals, dec_point, thousands_sep) {
				// *     example: number_format(1234.56, 2, ',', ' ');
				// *     return: '1 234,56'
				number = (number + '').replace(',', '').replace(' ', '');
				var n = !isFinite(+number) ? 0 : +number,
					prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
					sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
					dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
					s = '',
					toFixedFix = function(n, prec) {
						var k = Math.pow(10, prec);
						return '' + Math.round(n * k) / k;
					};
				// Fix for IE parseFloat(0.55).toFixed(0) = 0;
				s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
				if (s[0].length > 3) {
					s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
				}
				if ((s[1] || '').length < prec) {
					s[1] = s[1] || '';
					s[1] += new Array(prec - s[1].length + 1).join('0');
				}
				return s.join(dec);
			}

			// Area Chart Example
			var ctx = document.getElementById("myAreaChart");
			var myLineChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
					datasets: [{
							label: "Total Barang Masuk",
							lineTension: 0.3,
							backgroundColor: "rgba(78, 115, 223, 0.05)",
							borderColor: "rgba(78, 115, 223, 1)",
							pointRadius: 3,
							pointBackgroundColor: "rgba(78, 115, 223, 1)",
							pointBorderColor: "rgba(78, 115, 223, 1)",
							pointHoverRadius: 3,
							pointHoverBackgroundColor: "#5a5c69",
							pointHoverBorderColor: "#5a5c69",
							pointHitRadius: 10,
							pointBorderWidth: 2,
							data: <?= json_encode($cbm); ?>,
						},
						{
							label: "Total Barang Keluar",
							lineTension: 0.3,
							backgroundColor: "rgba(231, 74, 59, 0.05)",
							borderColor: "#e74a3b",
							pointRadius: 3,
							pointBackgroundColor: "#e74a3b",
							pointBorderColor: "#e74a3b",
							pointHoverRadius: 3,
							pointHoverBackgroundColor: "#5a5c69",
							pointHoverBorderColor: "#5a5c69",
							pointHitRadius: 10,
							pointBorderWidth: 2,
							data: <?= json_encode($cbk); ?>,
						}
					],
				},
				options: {
					maintainAspectRatio: false,
					layout: {
						padding: 5
					},
					scales: {
						xAxes: [{
							time: {
								unit: 'date'
							},
							gridLines: {
								display: false,
								drawBorder: false
							},
							ticks: {
								maxTicksLimit: 7
							}
						}],
						yAxes: [{
							ticks: {
								maxTicksLimit: 5,
								padding: 10,
								// Include a dollar sign in the ticks
								callback: function(value, index, values) {
									return number_format(value);
								}
							},
							gridLines: {
								color: "rgb(234, 236, 244)",
								zeroLineColor: "rgb(234, 236, 244)",
								drawBorder: false,
								borderDash: [2],
								zeroLineBorderDash: [2]
							}
						}],
					},
					legend: {
						display: false
					},
					tooltips: {
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						titleMarginBottom: 10,
						titleFontColor: '#6e707e',
						titleFontSize: 14,
						borderColor: '#dddfeb',
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						intersect: false,
						mode: 'index',
						caretPadding: 10,
						callbacks: {
							label: function(tooltipItem, chart) {
								var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
								return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
							}
						}
					}
				}
			});

			// Pie Chart Example
			var ctx = document.getElementById("myPieChart");
			var myPieChart = new Chart(ctx, {
				type: 'doughnut',
				data: {
					labels: ["Barang Masuk", "Barang Keluar"],
					datasets: [{
						data: [<?= $barang_masuk; ?>, <?= $barang_keluar; ?>],
						backgroundColor: ['#4e73df', '#e74a3b'],
						hoverBackgroundColor: ['#5a5c69', '#5a5c69'],
						hoverBorderColor: "rgba(234, 236, 244, 1)",
					}],
				},
				options: {
					maintainAspectRatio: false,
					tooltips: {
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						borderColor: '#dddfeb',
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						caretPadding: 10,
					},
					legend: {
						display: false
					},
					cutoutPercentage: 80,
				},
			});
		</script>
	<?php endif; ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.owl-carousel').owlCarousel({
				items: 3,
				loop: true,
				margin: 10,
				autoplay: true,
				autoplayTimeout: 1500,
				autoplayHoverPause: true
			});
			$('.summernote').summernote({
				toolbar: [
					['style', ['style']],
					['font', ['bold', 'underline', 'clear']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
				]

			});
		});
	</script>
</body>

</html>