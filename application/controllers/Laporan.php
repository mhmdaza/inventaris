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
		$this->form_validation->set_rules('laporan', 'Laporan', 'required|in_list[barang_masuk,barang_keluar,supplier,jenis,barang]');
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
			} elseif ($table == 'jenis') {
				$query = $this->admin->getJenis();
			} else {
				$query = $this->admin->getBarang();
			}

			$logo = $this->admin->getSetting();
			$this->_cetak($query, $table, $tanggal, $logo);
		}
	}

	public function penempatanbarang()
    {
        $data['title'] = "Penempatan Barang";
        $data['barang'] = $this->admin->getBarang();
		$data['penempatanbarang'] = $this->admin->get('penempatan_brg');
        $this->template->load('templates/dashboard', 'laporan_penempatanbrg/data', $data);
    }

	public function cetak_penempatan()
    {
		$pilih = $this->input->post('pilih');
        
        $data=array(
			'title'  => 'Cetak Penempatan Barang',
            'barang' => $this->admin->getCetakBarang($pilih),
        );
		
		$this->load->view('laporan_penempatanbrg/cetak', $data);
    }

	public function barangrusak()
    {
        $data['title'] = "Laporan Barang Rusak";
        $data['barangrusak'] = $this->admin->getBarangRusak();
		$this->template->load('templates/dashboard', 'laporan_brgrusak/data', $data);
    }

	public function cetak_barangrusak()
    {
		$start_date = $this->input->post('start_date');
		$end_date   = $this->input->post('end_date');

        $data=array(
			'title'  => 'Cetak Barang Rusak',
            'barangrusak' => $this->admin->getCetakBarangRusak($start_date,$end_date),
        );
		
		$this->load->view('laporan_brgrusak/cetak', $data);
    }

	public function barangmaintenance()
    {
        $data['title'] = "Laporan Barang Maintenance";
        $data['barangmaintenance'] = $this->admin->getBarangMaintenance();
		$this->template->load('templates/dashboard', 'laporan_brgmaintenance/data', $data);
    }

	public function cetak_barangmaintenance()
    {
		$pilih   	= $this->input->post('pilih');
		$start_date = $this->input->post('start_date');
		$end_date   = $this->input->post('end_date');

        $data=array(
			'title'  => 'Cetak Barang Maintenance',
            'barangmaintenance' => $this->admin->getCetakBarangMaintenance($pilih,$start_date,$end_date),
        );
		
		$this->load->view('laporan_brgmaintenance/cetak', $data);
    }

	public function masapakai_brg()
    {
        $data['title'] = "Laporan Masa Pakai Barang";
        $data['barang'] = $this->admin->getBarang();
		$this->template->load('templates/dashboard', 'laporan_masapakaibrg/data', $data);
    }

	public function cetak_masapakai()
    {
		$start_date = $this->input->post('start_date');
		$end_date   = $this->input->post('end_date');

        $data=array(
			'title'  => 'Cetak Masa Pakai Barang',
            'barang' => $this->admin->getCetakMasaPakaiBarang($start_date,$end_date),
        );
		
		$this->load->view('laporan_masapakaibrg/cetak', $data);
    }

	private function _cetak($data, $table_, $null, $logo)
	{
		$this->load->library('CustomPDF');

		$table = $table_ == 'barang_masuk' ? 'Barang Masuk' : ( $table_ == 'barang_keluar' ? 'Barang Keluar' : ($table_ == 'supplier' ? 'Data Supplier' : ( $table_ == 'jenis' ? 'Jenis Barang' : 'Data Barang')));

		$pdf = new FPDF();
		$pdf->AddPage('P', 'Letter');
		$pdf->Image(FCPATH . 'assets/img/logo/' . $logo['logo'],10,8, null,20);
		$pdf->SetFont('Arial','B',15);
		$pdf->Cell(80);
		$pdf->Cell(30,10,'BPJS KETENAGAKERJAAN',0,0,'c');
		$pdf->Ln();
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(70);
		$pdf->Cell(30, 3, 'BPJS Ketenagakerjaan Cabang Pratama Kapuas', 0, 0,'c');
		$pdf->Ln();
		$pdf->Cell(55);
		$pdf->SetFont('Times','',10);
		$pdf->Cell(30, 10, 'Jl. Tambun Bungai, Selat Tengah, Kec. Selat, Kabupaten Kapuas, Kalimantan Tengah 72516', 0, 0,'c');
		$pdf->Ln();
		$pdf->Cell(75);
		$pdf->SetFont('Times','',10);
		$pdf->Cell(30, 3, 'Telp. (0812) 2021061 Email: bpjsketenagakerjaan@gmail.com', 0, 0,'c');
		$pdf->Ln();
		$pdf->Line(10,40,205,40);
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

		} elseif ($table_ == 'barang_keluar') : {
			$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
			$pdf->Cell(25, 7, 'Tgl Keluar', 1, 0, 'C');
			$pdf->Cell(35, 7, 'ID Transaksi', 1, 0, 'C');
			$pdf->Cell(95, 7, 'Nama Barang', 1, 0, 'C');
			$pdf->Cell(30, 7, 'Jumlah Keluar', 1, 0, 'C');
			$pdf->Ln();
			}

		$no = 1;
			foreach ($data as $d) {
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
			$pdf->Cell(25, 7, $d['tanggal_keluar'], 1, 0, 'C');
			$pdf->Cell(35, 7, $d['id_barang_keluar'], 1, 0, 'C');
			$pdf->Cell(95, 7, $d['nama_barang'], 1, 0, 'L');
			$pdf->Cell(30, 7, $d['jumlah_keluar'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
			$pdf->Ln();

		} elseif ($table_ == 'supplier') : {
			$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
			$pdf->Cell(40, 7, 'Nama Supplier', 1, 0, 'C');
			$pdf->Cell(55, 7, 'No Telp', 1, 0, 'C');
			$pdf->Cell(88, 7, 'Alamat', 1, 0, 'C');
			$pdf->Ln();
			}
		
		$no = 1;
			foreach ($data as $d) {
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
			$pdf->Cell(40, 7, $d['nama_supplier'], 1, 0, 'C');
			$pdf->Cell(55, 7, $d['no_telp'], 1, 0, 'C');
			$pdf->Cell(88, 7, $d['alamat'], 1, 0, 'L');
			$pdf->Ln();
		
		} elseif ($table_ == 'jenis') : {
			$pdf->Cell(15, 7, 'No.', 1, 0, 'C');
			$pdf->Cell(35, 7, 'ID Jenis', 1, 0, 'C');
			$pdf->Cell(145, 7, 'Nama Jenis', 1, 0, 'C');
			$pdf->Ln();	
			}

		$no = 1;
			foreach ($data as $d) {
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(15, 7, $no++ . '.', 1, 0, 'C');
			$pdf->Cell(35, 7, $d['id_jenis'], 1, 0, 'C');
			$pdf->Cell(145, 7, $d['nama_jenis'], 1, 0, 'C');
			$pdf->Ln();
				
		} else : {
			$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
			$pdf->Cell(25, 7, 'ID Barang', 1, 0, 'C');
			$pdf->Cell(60, 7, 'Nama Barang', 1, 0, 'C');
			$pdf->Cell(50, 7, 'Jenis Barang', 1, 0, 'C');
			$pdf->Cell(20, 7, 'Stok', 1, 0, 'C');
			$pdf->Cell(30, 7, 'Satuan', 1, 0, 'C');
			$pdf->Ln();
			}

		$no = 1;
			foreach ($data as $d) {
			$pdf->SetFont('Arial', '', 10);
			$pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
			$pdf->Cell(25, 7, $d['id_barang'], 1, 0, 'C');
			$pdf->Cell(60, 7, $d['nama_barang'], 1, 0, 'C');
			$pdf->Cell(50, 7, $d['nama_jenis'], 1, 0, 'L');
			$pdf->Cell(20, 7, $d['stok'], 1, 0, 'C');
			$pdf->Cell(30, 7, $d['nama_satuan'], 1, 0, 'C');
			$pdf->Ln();
			}
			endif;

		
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		// Tambahkan nama tempat dan tanggal waktu sekarang
		$pdf->Cell(190, 5, 'Kuala Kapuas, '.date("d-m-Y") , 0, 1,'R');
		$pdf->Cell(188, 5, 'Kepala Kantor Cabang', 0, 1,'R');
		$pdf->Ln(20);
        $pdf->Cell(75);
        $pdf->Cell(106, 0, 'Agus Sutejo', 0, 1,'R');
		$pdf->Cell(191, 5, '_____________________', 0, 1,'R');
        $pdf->Cell(184, 5, 'NIP. 131149868', 0, 1,'R');
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(75);



		$file_name = $table_ . ' ' . $null;
		$pdf->Output('I', $file_name);
	}
}