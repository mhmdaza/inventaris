<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruanganbarang extends CI_Controller
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
        $data['title'] = "Ruangan";
        $data['ruanganbarang'] = $this->admin->get('ruangan');
        $this->template->load('templates/dashboard', 'ruangan_brg/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_ruangan', 'Nama ruangan', 'required');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Ruangan";
            $this->template->load('templates/dashboard', 'ruangan_brg/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('ruangan', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('ruanganbarang');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('ruanganbarang/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Ruangan";
            $data['ruanganbarang'] = $this->admin->get('ruangan', ['id_ruangan' => $id]);
            $this->template->load('templates/dashboard', 'ruangan_brg/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('ruangan', 'id_ruangan', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('ruanganbarang');
            } else {
                set_pesan('data gagal diedit.');
                redirect('ruanganbarang/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('ruangan', 'id_ruangan', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('ruanganbarang');
    }
}
