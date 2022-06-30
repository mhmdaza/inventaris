<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }
    
    public function deleteData($table,$data)
    {
        $this->db->delete($table,$data);
    }

    public function getUsers($id)
    {
        /**
         * ID disini adalah untuk data yang tidak ingin ditampilkan. 
         * Maksud saya disini adalah 
         * tidak ingin menampilkan data user yang digunakan, 
         * pada managemen data user
         */
        $this->db->where('id_user !=', $id);
        return $this->db->get('user')->result_array();
    }

    public function getSupplier() {
        $sql = ('SELECT * FROM `supplier` `s` JOIN `barang_masuk` `bm` ON `s`.`supplier_id` = `bm`.`id_supplier` ORDER BY `id_supplier`');
        return $this->db->get('supplier s')->result_array();
    }

    public function getJenis() {
        $sql = ('SELECT * FROM `jenis` `j` JOIN `barang` `b` ON `j`.`jenis_id` = `b`.`id_supplier` ORDER BY `id_supplier`');
        return $this->db->get('jenis j')->result_array();
    }
    
    public function getBarang()
    {
        $this->db->join('penempatan_brg pb', 'pb.id_penempatan_brg = b.penempatan_id');
        $this->db->join('jenis j', 'b.jenis_id = j.id_jenis');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
        $this->db->order_by('id_barang');
        return $this->db->get('barang b')->result_array();
    }

    function getCetakBarang($pilih){
        return $this->db->query("SELECT b.*, j.nama_jenis, s.nama_satuan, pb.nama_penempatan from barang b join jenis j on j.id_jenis=b.jenis_id 
                                 join satuan s on s.id_satuan=b.satuan_id join penempatan_brg pb on pb.id_penempatan_brg=b.penempatan_id
                                 where b.penempatan_id='$pilih'")->result_array();
    }

    function getCetakMasaPakaiBarang($start_date,$end_date){
        return $this->db->query("SELECT b.*, j.nama_jenis, s.nama_satuan, pb.nama_penempatan from barang b join jenis j on j.id_jenis=b.jenis_id 
                                 join satuan s on s.id_satuan=b.satuan_id join penempatan_brg pb on pb.id_penempatan_brg=b.penempatan_id
                                 where b.masa_pakai BETWEEN '$start_date' and '$end_date'")->result_array();
    }

    public function getBarangRusak()
    {
        $this->db->join('user u', 'u.id_user = br.user_id');
        $this->db->join('barang b', 'b.id_barang = br.barang_id');
        $this->db->join('jenis j', 'b.jenis_id = j.id_jenis');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
        $this->db->order_by('id_barang_rusak');
        return $this->db->get('barang_rusak br')->result_array();
    }

    function getCetakBarangRusak($start_date,$end_date){
        return $this->db->query("SELECT br.*, u.nama, b.nama_barang, s.nama_satuan from barang_rusak br join user u on u.id_user=br.user_id
                                 join barang b on b.id_barang=br.barang_id join satuan s on s.id_satuan=b.satuan_id 
                                 where br.tgl_brg_rusak BETWEEN '$start_date' and '$end_date'")->result_array();
    }

    public function getBarangMaintenance()
    {
        $this->db->join('user u', 'u.id_user = br.user_id');
        $this->db->join('barang b', 'b.id_barang = br.barang_id');
        $this->db->join('jenis j', 'b.jenis_id = j.id_jenis');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
        $this->db->order_by('id_barang_maintenance');
        return $this->db->get('barang_maintenance br')->result_array();
    }

    function getCetakBarangMaintenance($pilih,$start_date,$end_date){
        return $this->db->query("SELECT br.*, u.nama, b.nama_barang, s.nama_satuan from barang_maintenance br join user u on u.id_user=br.user_id
                                 join barang b on b.id_barang=br.barang_id join satuan s on s.id_satuan=b.satuan_id 
                                 where br.tgl_brg_maintenance BETWEEN '$start_date' and '$end_date' 
                                 AND br.status_barang='$pilih'")->result_array();
    }

    public function getBarangMasuk($limit = null, $id_barang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('user u', 'bm.user_id = u.id_user');
        $this->db->join('supplier sp', 'bm.supplier_id = sp.id_supplier');
        $this->db->join('barang b', 'bm.barang_id = b.id_barang');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
        if ($limit != null) {
            $this->db->limit($limit);
        }

        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }

        if ($range != null) {
            $this->db->where('tanggal_masuk' . ' >=', $range['mulai']);
            $this->db->where('tanggal_masuk' . ' <=', $range['akhir']);
        }

        $this->db->order_by('id_barang_masuk', 'DESC');
        return $this->db->get('barang_masuk bm')->result_array();
    }

    public function getBarangKeluar($limit = null, $id_barang = null, $range = null)
    {
        $this->db->select('*');
        $this->db->join('user u', 'bk.user_id = u.id_user');
        $this->db->join('barang b', 'bk.barang_id = b.id_barang');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan');
        if ($limit != null) {
            $this->db->limit($limit);
        }
        if ($id_barang != null) {
            $this->db->where('id_barang', $id_barang);
        }
        if ($range != null) {
            $this->db->where('tanggal_keluar' . ' >=', $range['mulai']);
            $this->db->where('tanggal_keluar' . ' <=', $range['akhir']);
        }
        $this->db->order_by('id_barang_keluar', 'DESC');
        return $this->db->get('barang_keluar bk')->result_array();
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function sum($table, $field)
    {
        $this->db->select_sum($field);
        return $this->db->get($table)->row_array()[$field];
    }

    public function min($table, $field, $min)
    {
        $field = $field . ' <=';
        $this->db->where($field, $min);
        return $this->db->get($table)->result_array();
    }

    public function chartBarangMasuk($bulan)
    {
        $like = 'T-BM-' . date('y') . $bulan;
        $this->db->like('id_barang_masuk', $like, 'after');
        return count($this->db->get('barang_masuk')->result_array());
    }

    public function chartBarangKeluar($bulan)
    {
        $like = 'T-BK-' . date('y') . $bulan;
        $this->db->like('id_barang_keluar', $like, 'after');
        return count($this->db->get('barang_keluar')->result_array());
    }

    public function laporan($table, $mulai, $akhir)
    {
        $tgl = $table == 'barang_masuk' ? 'Barang Masuk' : 'Barang Keluar';
        $this->db->where($tgl . ' >=', $mulai);
        $this->db->where($tgl . ' <=', $akhir);
        return $this->db->get($table)->result_array();
    }

    public function cekStok($id)
    {
        $this->db->join('satuan s', 'b.satuan_id=s.id_satuan');
        return $this->db->get_where('barang b', ['id_barang' => $id])->row_array();
    }

    public function getSetting()
    {
	    return $this->db->get('setting_app')->row_array();
    }
}
