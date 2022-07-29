<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();

		$this->load->model('Admin_model', 'admin');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('laporan', 'Laporan', 'required|in_list[barang_masuk,barang_keluar,supplier,barang,pengguna_brg,barang_rusak,barang_maintenance]');
		$this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

		if ($this->form_validation->run() == false) {
			$data['title'] = "Laporan";
			$this->template->load('templates/dashboard', 'laporan/form', $data);
		} else {
			$input = $this->input->post(null, true);
			$table = $input['laporan'];
			$tanggal = $input['tanggal'];
			$pecah = explode(' - ', $tanggal);
			$mulai = date('Y-m-d', strtotime($pecah[0]));
			$akhir = date('Y-m-d', strtotime(end($pecah)));

			$query = '';
			if ($table == 'barang_masuk') {
				$query = $this->admin->getBarangMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
			} elseif ($table == 'barang_keluar') {
				$query = $this->admin->getBarangKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
			} elseif ($table == 'supplier') {
				$query = $this->admin->getSupplier();
			} elseif ($table == 'barang') {
				$query = $this->admin->getBarang();
			} elseif ($table == 'pengguna_brg') {
				$query = $this->admin->getPengguna();
			} elseif ($table == 'barang_rusak') {
				$query = $this->admin->getBarangRusak();
			} else {
				$query = $this->admin->getBarangMaintenance();
			}

			$logo = $this->admin->getSetting();
			$this->_cetak($query, $table, $tanggal, $logo);
		}
	}


	// CETAK FILTER PENEMPATAN
	public function penempatanbarang()
	{
		$data['title'] = "Penempatan Barang";
		$data['penempatan'] = $this->admin->getPenempatan();
		$data['barang'] = $this->admin->get('barang');
		$data['pegawai'] = $this->admin->get('pegawai');
		$data['ruangan'] = $this->admin->get('ruangan');
		$this->template->load('templates/dashboard', 'laporan_penempatan/data', $data);
	}

	public function cetak_penempatan()
	{
		$pilih = $this->input->post('pilih');

		$data = array(
			'title'  => 'Cetak Penempatan Barang',
			'penempatan' => $this->admin->getCetakPenempatan($pilih),
		);

		$this->load->view('laporan_penempatan/cetak', $data);
	}
	// AKHIR CETAK PENEMPATAN


	private function _cetak($data, $table_, $null, $logo)
	{
		$this->load->library('CustomPDF');

		$table = $table_ == 'barang_masuk' ? 'Barang Masuk' : ($table_ == 'barang_keluar' ? 'Barang Keluar' : ($table_ == 'supplier' ? 'Data Supplier' : ($table_ == 'barang' ? 'Data Barang' : ($table_ == 'barang_rusak' ? 'Barang Rusak' : ($table_ == 'barang_maintenance' ? 'Barang Maintenance' : 'Pengguna Penunjukan Barang')))));

		$pdf = new FPDF();
		$pdf->AddPage('P', 'Letter');
		$pdf->Image(FCPATH . 'assets/img/logo/' . $logo['logo'], 10, 8, null, 20);
		$pdf->SetFont('Arial', 'B', 15);
		$pdf->Cell(80);
		$pdf->Cell(30, 10, 'BPJS KETENAGAKERJAAN', 0, 0, 'c');
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(70);
		$pdf->Cell(30, 3, 'BPJS Ketenagakerjaan Cabang Pratama Kapuas', 0, 0, 'c');
		$pdf->Ln();
		$pdf->Cell(55);
		$pdf->SetFont('Times', '', 10);
		$pdf->Cell(30, 10, 'Jl. Tambun Bungai, Selat Tengah, Kec. Selat, Kabupaten Kapuas, Kalimantan Tengah 72516', 0, 0, 'c');
		$pdf->Ln();
		$pdf->Cell(75);
		$pdf->SetFont('Times', '', 10);
		$pdf->Cell(30, 3, 'Telp. (0812) 2021061 Email: bpjsketenagakerjaan@gmail.com', 0, 0, 'c');
		$pdf->Ln();
		$pdf->Line(10, 40, 205, 40);
		$pdf->Ln(10);
		$pdf->SetFont('Times', 'B', 16);
		$pdf->Cell(200, 7, 'Laporan ' .  $table, 0, 1, 'C');
		$pdf->SetFont('Times', '', 10);
		$pdf->Ln(10);

		$pdf->SetFont('Arial', 'B', 10);

		if ($table_ == 'barang_masuk') :
			$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
			$pdf->Cell(25, 7, 'Tgl Masuk', 1, 0, 'C');
			$pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
			$pdf->Cell(55, 7, 'Nama Barang', 1, 0, 'C');
			$pdf->Cell(40, 7, 'Supplier', 1, 0, 'C');
			$pdf->Cell(30, 7, 'Jumlah Masuk', 1, 0, 'C');
			$pdf->Ln();

			$no = 1;
			foreach ($data as $d) {
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
				$pdf->Cell(25, 7, $d['tanggal_masuk'], 1, 0, 'C');
				$pdf->Cell(35, 7, $d['id_barang_masuk'], 1, 0, 'C');
				$pdf->Cell(55, 7, $d['nama_barang'], 1, 0, 'L');
				$pdf->Cell(40, 7, $d['nama_supplier'], 1, 0, 'L');
				$pdf->Cell(30, 7, $d['jumlah_masuk'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
				$pdf->Ln();
			}
		elseif ($table_ == 'barang_keluar') : {
				$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
				$pdf->Cell(34, 7, 'No Transaksi', 1, 0, 'C');
				$pdf->Cell(20, 7, 'Tanggal', 1, 0, 'C');
				$pdf->Cell(20, 7, 'ID Barang', 1, 0, 'C');
				$pdf->Cell(30, 7, 'Nama Barang', 1, 0, 'C');
				$pdf->Cell(30, 7, 'Ruangan', 1, 0, 'C');
				$pdf->Cell(36, 7, 'User', 1, 0, 'C');
				$pdf->Cell(15, 7, 'Jumlah', 1, 0, 'C');
				$pdf->Ln();
			}

			$no = 1;
			foreach ($data as $d) {
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
				$pdf->Cell(34, 7, $d['id_barang_keluar'], 1, 0, 'C');
				$pdf->Cell(20, 7, $d['tanggal_keluar'], 1, 0, 'C');
				$pdf->Cell(20, 7, $d['id_barang'], 1, 0, 'L');
				$pdf->Cell(30, 7, $d['nama_barang'], 1, 0, 'L');
				$pdf->Cell(30, 7, $d['nama_ruangan'], 1, 0, 'C');
				$pdf->Cell(36, 7, $d['nama'], 1, 0, 'L');
				$pdf->Cell(15, 7, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
				$pdf->Ln();
			}
		elseif ($table_ == 'supplier') : {
				$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
				$pdf->Cell(40, 7, 'Nama Supplier', 1, 0, 'C');
				$pdf->Cell(40, 7, 'Toko', 1, 0, 'C');
				$pdf->Cell(35, 7, 'No Telp', 1, 0, 'C');
				$pdf->Cell(70, 7, 'Alamat', 1, 0, 'C');
				$pdf->Ln();
			}

			$no = 1;
			foreach ($data as $d) {
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
				$pdf->Cell(40, 7, $d['nama_supplier'], 1, 0, 'C');
				$pdf->Cell(40, 7, $d['toko'], 1, 0, 'C');
				$pdf->Cell(35, 7, $d['no_telp'], 1, 0, 'C');
				$pdf->Cell(70, 7, $d['alamat'], 1, 0, 'L');
				$pdf->Ln();
			}
		elseif ($table_ == 'barang') : {
				$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
				$pdf->Cell(25, 7, 'ID Barang', 1, 0, 'C');
				$pdf->Cell(40, 7, 'Nama Barang', 1, 0, 'C');
				$pdf->Cell(50, 7, 'Harga Barang', 1, 0, 'C');
				$pdf->Cell(25, 7, 'Jenis Barang', 1, 0, 'C');
				$pdf->Cell(20, 7, 'Stok', 1, 0, 'C');
				$pdf->Cell(25, 7, 'Satuan', 1, 0, 'C');
				$pdf->Ln();
			}

			$no = 1;
			foreach ($data as $d) {
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
				$pdf->Cell(25, 7, $d['id_barang'], 1, 0, 'C');
				$pdf->Cell(40, 7, $d['nama_barang'], 1, 0, 'L');
				$pdf->Cell(50, 7, 'Rp.' . $d['harga_barang'], 1, 0, 'C');
				$pdf->Cell(25, 7, $d['nama_jenis'], 1, 0, 'L');
				$pdf->Cell(20, 7, $d['stok'], 1, 0, 'C');
				$pdf->Cell(25, 7, $d['nama_satuan'], 1, 0, 'C');
				$pdf->Ln();
			}
		elseif ($table_ == 'pengguna_brg') : {
				$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
				$pdf->Cell(35, 7, 'Nama Pegawai', 1, 0, 'C');
				$pdf->Cell(25, 7, 'NIP', 1, 0, 'C');
				$pdf->Cell(40, 7, 'Jabatan', 1, 0, 'C');
				$pdf->Cell(20, 7, 'ID Barang', 1, 0, 'C');
				$pdf->Cell(35, 7, 'Nama Barang', 1, 0, 'C');
				$pdf->Cell(30, 7, 'Jenis Barang', 1, 0, 'C');
				$pdf->Ln();
			}

			$no = 1;
			foreach ($data as $d) {
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
				$pdf->Cell(35, 7, $d['nama_pegawai'], 1, 0, 'C');
				$pdf->Cell(25, 7, $d['nip'], 1, 0, 'C');
				$pdf->Cell(40, 7, $d['jabatan'], 1, 0, 'C');
				$pdf->Cell(20, 7, $d['id_barang'], 1, 0, 'C');
				$pdf->Cell(35, 7, $d['nama_barang'], 1, 0, 'C');
				$pdf->Cell(30, 7, $d['nama_jenis'], 1, 0, 'C');
				$pdf->Ln();
			}
		elseif ($table_ == 'barang_rusak') : {
				$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
				$pdf->Cell(20, 7, 'Tanggal', 1, 0, 'C');
				$pdf->Cell(20, 7, 'ID Barang', 1, 0, 'C');
				$pdf->Cell(35, 7, 'Nama Barang', 1, 0, 'C');
				$pdf->Cell(15, 7, 'Jumlah', 1, 0, 'C');
				$pdf->Cell(40, 7, 'User', 1, 0, 'C');
				$pdf->Cell(40, 7, 'Deskripsi', 1, 0, 'C');
				$pdf->Cell(15, 7, 'Status', 1, 0, 'C');
				$pdf->Ln();
			}

			$no = 1;
			foreach ($data as $d) {
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
				$pdf->Cell(20, 7, $d['tgl_brg_rusak'], 1, 0, 'C');
				$pdf->Cell(20, 7, $d['id_barang'], 1, 0, 'C');
				$pdf->Cell(35, 7, $d['nama_barang'], 1, 0, 'C');
				$pdf->Cell(15, 7, $d['jumlah_rusak'], 1, 0, 'C');
				$pdf->Cell(40, 7, $d['nama'], 1, 0, 'C');
				$pdf->Cell(40, 7, $d['deskripsi'], 1, 0, 'C');
				$pdf->Cell(15, 7, $d['status_barang'], 1, 0, 'C');
				$pdf->Ln();
			}
		else : {
				$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
				$pdf->Cell(25, 7, 'Tanggal', 1, 0, 'C');
				$pdf->Cell(25, 7, 'ID Barang', 1, 0, 'C');
				$pdf->Cell(40, 7, 'Nama Barang', 1, 0, 'C');
				$pdf->Cell(15, 7, 'Jumlah', 1, 0, 'C');
				$pdf->Cell(50, 7, 'User', 1, 0, 'C');
				$pdf->Cell(30, 7, 'Status', 1, 0, 'C');
				$pdf->Ln();
			}

			$no = 1;
			foreach ($data as $d) {
				$pdf->SetFont('Arial', '', 10);
				$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
				$pdf->Cell(25, 7, $d['tgl_brg_maintenance'], 1, 0, 'C');
				$pdf->Cell(25, 7, $d['barang_id'], 1, 0, 'C');
				$pdf->Cell(40, 7, $d['nama_barang'], 1, 0, 'C');
				$pdf->Cell(15, 7, $d['jumlah_maintenance'], 1, 0, 'C');
				$pdf->Cell(50, 7, $d['nama'], 1, 0, 'C');
				$pdf->Cell(30, 7, $d['status_barang'], 1, 0, 'C');
				$pdf->Ln();
			}
		endif;

		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(190, 5, 'Kuala Kapuas, ' . date("d-m-Y"), 0, 1, 'R');
		$pdf->Cell(188, 5, 'Kepala Kantor Cabang', 0, 1, 'R');
		$pdf->Ln(20);
		$pdf->Cell(75);
		$pdf->Cell(106, 0, 'Agus Sutejo', 0, 1, 'R');
		$pdf->Cell(191, 5, '_____________________', 0, 1, 'R');
		$pdf->Cell(184, 5, 'NIP. 131149868', 0, 1, 'R');
		$pdf->SetFont('Times', '', 12);
		$pdf->Cell(75);



		$file_name = $table_ . ' ' . $null;
		$pdf->Output('I', $file_name);
	}
}
