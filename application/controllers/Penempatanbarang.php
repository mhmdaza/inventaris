<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penempatanbarang extends CI_Controller
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
        $data['penempatanbarang'] = $this->admin->get('penempatan_brg');
        $this->template->load('templates/dashboard', 'penempatan_brg/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_penempatan', 'Nama Penempatan', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Penempatan Barang";
            $this->template->load('templates/dashboard', 'penempatan_brg/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('penempatan_brg', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('penempatanbarang');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('penempatanbarang/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Penempatan Barang";
            $data['penempatanbarang'] = $this->admin->get('penempatan_brg', ['id_penempatan_brg' => $id]);
            $this->template->load('templates/dashboard', 'penempatan_brg/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('penempatan_brg', 'id_penempatan_brg', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('penempatanbarang');
            } else {
                set_pesan('data gagal diedit.');
                redirect('penempatanbarang/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('penempatan_brg', 'id_penempatan_brg', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('penempatanbarang');
    }
}
