<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
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
        $data['title'] = "Penunjukan Pengguna Barang";
        $data['pengguna'] = $this->admin->getPengguna();
        $data['jenis'] = $this->admin->get('jenis');

        $this->template->load('templates/dashboard', 'pengguna/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('barang_id', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('pegawai_id', 'Jenis Barang', 'required');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Pengguna Barang";
            $data['pegawai'] = $this->admin->get('pegawai');
            $data['barang'] = $this->admin->get('barang');

            $this->template->load('templates/dashboard', 'pengguna/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('pengguna_brg', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('pengguna');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('pengguna/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('pengguna_brg', 'id_pengguna', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('pengguna');
    }
}
