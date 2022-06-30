<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangmaintenance extends CI_Controller
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
        $data['title'] = "Barang Maintenance";
        $data['barangmaintenance'] = $this->admin->getBarangMaintenance();
        $this->template->load('templates/dashboard', 'barang_maintenance/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tgl_brg_maintenance', 'Tanggal Maintenance', 'required|trim');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_maintenance', 'Jumlah Maintenance', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Maintenance";
            $data['barang'] = $this->admin->get('barang');

            $this->template->load('templates/dashboard', 'barang_maintenance/add', $data);
        } else {
            $barang_id          = $this->input->post('barang_id');
            $jumlah_maintenance = $this->input->post('jumlah_maintenance');

            $dataBrgMaintenance=array(
                'barang_id'           => $barang_id,
                'user_id'             => $this->session->userdata('login_session')['user'],
                'tgl_brg_maintenance' => $this->input->post('tgl_brg_maintenance'),
                'jumlah_maintenance'  => $this->input->post('jumlah_maintenance'),
                'status_barang'       => 'Maintenance',
            );
            
            $data_barang = $this->db->query("SELECT * from barang where id_barang='$barang_id'")->result();
            foreach($data_barang as $d)
            {
                $stok = $d->stok;
                $sisa = $stok-$jumlah_maintenance;

                if($jumlah_maintenance > $stok) {
                    set_pesan('jumlah maintenance lebih dari stok.');
                    redirect('barangmaintenance/add');
                }
                else {
                    $this->admin->insert('barang_maintenance', $dataBrgMaintenance);
                    $this->db->query("UPDATE barang SET stok='$sisa' where id_barang='$barang_id'");
                    set_pesan('data berhasil disimpan.');
                    redirect('barangmaintenance');
                }
            }
        }
    }
    
    public function delete(){
        $id['id_barang_maintenance']  = $this->input->post('id_barang_maintenance');
        $barang_id                    = $this->input->post('barang_id');
        $jumlah_maintenance           =  $this->input->post('jumlah_maintenance');

        $data_barang = $this->db->query("SELECT * from barang where id_barang='$barang_id'")->result();
        foreach($data_barang as $d)
        {
            $stok = $d->stok;
            $sisa = $stok+$jumlah_maintenance;

            $this->db->query("UPDATE barang SET stok='$sisa' where id_barang='$barang_id'");
        }
        
        $this->admin->deleteData('barang_maintenance',$id);
        
        set_pesan('data berhasil dihapus.');
        redirect("barangmaintenance");
    }

    public function selesai(){
        $id_barang_maintenance = $this->input->post('id_barang_maintenance');
        $status_barang         = 'Selesai';
        
        $this->db->set('status_barang', $status_barang);
        $this->db->where('id_barang_maintenance', $id_barang_maintenance);
        $this->db->update('barang_maintenance');

        $barang_id                    = $this->input->post('barang_id');
        $jumlah_maintenance           =  $this->input->post('jumlah_maintenance');

        $data_barang = $this->db->query("SELECT * from barang where id_barang='$barang_id'")->result();
        foreach($data_barang as $d)
        {
            $stok = $d->stok;
            $sisa = $stok+$jumlah_maintenance;

            $this->db->query("UPDATE barang SET stok='$sisa' where id_barang='$barang_id'");
        }

        set_pesan('barang selesai dimaintenance.');
        redirect("barangmaintenance");
    }
    
}
