<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangmasuk extends CI_Controller
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
        $data['title'] = "Barang Masuk";
        $data['barangmasuk'] = $this->admin->getBarangMasuk();
        $data['barang'] = $this->admin->getBarang();
        $this->template->load('templates/dashboard', 'barang_masuk/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Masuk";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');

            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'T-BM-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_masuk', 'id_barang_masuk', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_barang_masuk'] = $kode . $number;

            $this->template->load('templates/dashboard', 'barang_masuk/add', $data);
        } else {
            $barang_id    = $this->input->post('barang_id');
            $jumlah_masuk = $this->input->post('jumlah_masuk');
            $masa_pakai   = $this->input->post('masa_pakai');

            $dataBrgMasuk=array(
                'id_barang_masuk'=> $this->input->post('id_barang_masuk'),
                'supplier_id'   => $this->input->post('supplier_id'),
                'user_id'       => $this->session->userdata('login_session')['user'],
                'barang_id'     => $barang_id,
                'jumlah_masuk'  => $this->input->post('jumlah_masuk'),
                'tanggal_masuk' => $this->input->post('tanggal_masuk'),
            );
            
            $data_barang = $this->db->query("SELECT * from barang where id_barang='$barang_id'")->result();
            foreach($data_barang as $d)
            {
                $stok = $d->stok;
                $sisa = $stok+$jumlah_masuk;

                $this->admin->insert('barang_masuk', $dataBrgMasuk);
                $this->db->query("UPDATE barang SET stok='$sisa', masa_pakai='$masa_pakai' where id_barang='$barang_id'");
                set_pesan('data berhasil disimpan.');
                redirect('barangmasuk');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang_masuk', 'id_barang_masuk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangmasuk');
    }
}
