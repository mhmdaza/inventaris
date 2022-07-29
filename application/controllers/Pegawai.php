<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (!is_admin()) {
            redirect('dashboard');
        }

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Pegawai";
        $data['pegawai'] = $this->admin->get('pegawai');
        $this->template->load('templates/dashboard', 'pegawai/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nip', 'NIP Pegawai', 'required|numeric');
        $this->form_validation->set_rules('nama_pegawai', 'Nama pegawai', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('telp', 'Telp', 'required|numeric');
        $this->form_validation->set_rules('tmt', 'TMT Pegawai', 'required');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Pegawai";
            $this->template->load('templates/dashboard', 'pegawai/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('pegawai', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('pegawai');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('pegawai/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();
        $data['jabatan'] = ['Kepala Kantor', 'Penata Madya Keuangan & IT', 'Account Representative Perwakilan', 'Penata Madya Pelayanan & Umum', 'Alih Daya', 'Security'];

        if ($this->form_validation->run() == false) {
            $data['title'] = "Pegawai";
            $data['pegawai'] = $this->admin->get('pegawai', ['id_pegawai' => $id]);
            $this->template->load('templates/dashboard', 'pegawai/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('pegawai', 'id_pegawai', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('pegawai');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('pegawai/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('pegawai', 'id_pegawai', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('pegawai');
    }
}
