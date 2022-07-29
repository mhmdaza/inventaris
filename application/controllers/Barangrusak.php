<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangrusak extends CI_Controller
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
        $data['title'] = "Barang Rusak";
        $data['barangrusak'] = $this->admin->getBarangRusak();
        $this->template->load('templates/dashboard', 'barang_rusak/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tgl_brg_rusak', 'Tanggal Rusak', 'required|trim');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('jumlah_rusak', 'Jumlah Rusak', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Rusak";
            $data['barang'] = $this->admin->get('barang');

            $this->template->load('templates/dashboard', 'barang_rusak/add', $data);
        } else {
            $barang_id    = $this->input->post('barang_id');
            $jumlah_rusak = $this->input->post('jumlah_rusak');

            $dataBrgRusak = array(
                'barang_id'     => $barang_id,
                'user_id'       => $this->session->userdata('login_session')['user'],
                'tgl_brg_rusak' => $this->input->post('tgl_brg_rusak'),
                'jumlah_rusak'  => $this->input->post('jumlah_rusak'),
                'deskripsi'  => $this->input->post('deskripsi'),
                'status_barang' => 'Rusak',
            );

            $data_barang = $this->db->query("SELECT * from barang where id_barang='$barang_id'")->result();
            foreach ($data_barang as $d) {
                $stok = $d->stok;
                $sisa = $stok - $jumlah_rusak;

                if ($jumlah_rusak > $stok) {
                    set_pesan('jumlah rusak lebih dari stok.');
                    redirect('barangrusak/add');
                } else {
                    $this->admin->insert('barang_rusak', $dataBrgRusak);
                    $this->db->query("UPDATE barang SET stok='$sisa' where id_barang='$barang_id'");
                    set_pesan('data berhasil disimpan.');
                    redirect('barangrusak');
                }
            }
        }
    }

    public function delete()
    {
        $id['id_barang_rusak']  = $this->input->post('id_barang_rusak');
        $barang_id              = $this->input->post('barang_id');
        $jumlah_rusak           = $this->input->post('jumlah_rusak');

        $data_barang = $this->db->query("SELECT * from barang where id_barang='$barang_id'")->result();
        foreach ($data_barang as $d) {
            $stok = $d->stok;
            $sisa = $stok + $jumlah_rusak;

            $this->db->query("UPDATE barang SET stok='$sisa' where id_barang='$barang_id'");
        }

        $this->admin->deleteData('barang_rusak', $id);

        set_pesan('data berhasil dihapus.');
        redirect("barangrusak");
    }
}
