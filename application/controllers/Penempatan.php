<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Penempatan extends CI_Controller
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
        $data['title'] = "Penempatan Barang";
        $data['penempatan'] = $this->admin->getPenempatan();
        $this->template->load('templates/dashboard', 'penempatan/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tgl_penempatan', 'Tanggal Penempatan', 'required|trim');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('pegawai_id', 'Pegawai', 'required');
        $this->form_validation->set_rules('ruangan_id', 'Ruangan', 'required');

        $input = $this->input->post('barang_id', true);
        $stok = $this->admin->get('barang', ['id_barang' => $input])['stok'];
        $stok_valid = $stok + 1;

        $this->form_validation->set_rules(
            'jumlah_penempatan',
            'Jumlah Penempatan',
            "required|trim|numeric|greater_than[0]|less_than[{$stok_valid}]",
            [
                'less_than' => "Jumlah barang tidak boleh lebih dari {$stok}"
            ]
        );
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Penempatan Barang";
            $data['ruangan'] = $this->admin->get('ruangan');
            $data['pegawai'] = $this->admin->get('pegawai');
            $data['barang'] = $this->admin->get('barang', null, ['stok >' => 0]);

            // Mendapatkan dan men-generate kode transaksi penempatan barang
            $kode = 'T-PB-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('penempatan', 'id_penempatan', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_penempatan'] = $kode . $number;

            $this->template->load('templates/dashboard', 'penempatan/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('penempatan', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('penempatan');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('penempatan/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('penempatan', 'id_penempatan', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('penempatan');
    }
}
