<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masapakaibarang extends CI_Controller
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
        $data['title'] = "Masa Pakai Barang Sudah Lewat";
        $data['barang'] = $this->admin->getBarang();
        $this->template->load('templates/dashboard', 'masapakai_brg/data', $data);
    }
}
