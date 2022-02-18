<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rumah_model extends CI_Model
{
    public function getLokasi($id)
    {
        $query = "SELECT `lokasi_rumah`.`id`, `list_rumah`.*
                  FROM `lokasi_rumah` JOIN `list_rumah`
                  ON `lokasi_rumah`.`id` = `list_rumah`.`lokasi_id`
                  WHERE `lokasi_rumah`.`id` = $id
                 ";

        return $this->db->query($query)->num_rows();
    }

    public function getRumah($id)
    {
        $query = "SELECT `list_rumah`.* , `tipe_rumah`.`nama_tipe`, `tipe_rumah`.`image`
                 FROM `list_rumah` INNER JOIN `tipe_rumah`
                  ON `list_rumah`.`tipe_id` = `tipe_rumah`.`id`
                  WHERE `list_rumah`.`lokasi_id` = $id
                 ";

        return $this->db->query($query)->result_array();
    }

    public function tersedia($id)
    {
        $query = "SELECT `lokasi_rumah`.`id`, `list_rumah`.*
                  FROM `lokasi_rumah` JOIN `list_rumah`
                  ON `lokasi_rumah`.`id` = `list_rumah`.`lokasi_id`
                  WHERE `lokasi_rumah`.`id` = $id AND `list_rumah`.`status` = 'AVAILABLE'
                 ";

        return $this->db->query($query)->num_rows();
    }

    public function terjual($id)
    {
        $query = "SELECT `lokasi_rumah`.`id`, `list_rumah`.*
                  FROM `lokasi_rumah` JOIN `list_rumah`
                  ON `lokasi_rumah`.`id` = `list_rumah`.`lokasi_id`
                  WHERE `lokasi_rumah`.`id` = $id AND `list_rumah`.`status` = 'NOT AVAILABLE'
                 ";

        return $this->db->query($query)->num_rows();
    }


    public function getRumahAdmin($id)
    {
        $query = "SELECT `list_rumah`.* , `tipe_rumah`.`nama_tipe`, `tipe_rumah`.`image`, `lokasi_rumah`.`lokasi`
                 FROM `list_rumah` INNER JOIN `tipe_rumah`
                  ON `list_rumah`.`tipe_id` = `tipe_rumah`.`id`
                  INNER JOIN `lokasi_rumah` ON `list_rumah`.`lokasi_id` = `lokasi_rumah`.`id`
                  WHERE `list_rumah`.`id` = $id
                 ";

        return $this->db->query($query)->row_array();
    }

    public function getRumahById($id)
    {
        $query = "SELECT `list_rumah`.* , `tipe_rumah`.`nama_tipe`, `tipe_rumah`.`image`, `lokasi_rumah`.`lokasi`
                 FROM `list_rumah` INNER JOIN `tipe_rumah`
                  ON `list_rumah`.`tipe_id` = `tipe_rumah`.`id`
                  INNER JOIN `lokasi_rumah` ON `list_rumah`.`lokasi_id` = `lokasi_rumah`.`id`
                  WHERE `list_rumah`.`id` = $id
                 ";

        return $this->db->query($query)->row_array();
    }

    public function getInvoiceByUser()
    {
        $user = $this->session->userdata('id');

        $query = "SELECT `transaksi`.*, `list_rumah`.`tipe_id`, `list_rumah`.`lokasi_id`,  `list_rumah`.`blok`, `list_rumah`.`nomor`, `list_rumah`.`harga`
                  FROM `transaksi` 
                                                                                                                            
                  INNER JOIN `list_rumah` ON `transaksi`.`rumah_id` = `list_rumah`.`id`
                  WHERE `transaksi`.`user_id` = $user";

        return $this->db->query($query)->result_array();
    }

    public function getInvoiceByUserById($id)
    {
        $user = $this->session->userdata('id');

        $query = "SELECT `transaksi`.*, `list_rumah`.`tipe_id`, `list_rumah`.`lokasi_id`, `list_rumah`.`status`, `list_rumah`.`blok`, `list_rumah`.`nomor`, `list_rumah`.`harga`
                  FROM `transaksi` 
                  INNER JOIN `list_rumah` ON `transaksi`.`rumah_id` = `list_rumah`.`id`
                  WHERE `transaksi`.`user_id` = $user AND `transaksi`.`id` = $id";

        return $this->db->query($query)->row_array();
    }

    public function getAllInvoice()
    {

        $query = "SELECT `transaksi`.*,`list_rumah`.`tipe_id`, `list_rumah`.`lokasi_id`,  `list_rumah`.`blok`, `list_rumah`.`nomor`, `list_rumah`.`harga`
                  FROM `transaksi`     
                  INNER JOIN `list_rumah` ON `transaksi`.`rumah_id` = `list_rumah`.`id`
                  ";

        return $this->db->query($query)->result_array();
    }

    public function getAllInvoiceById($id)
    {

        $query = "SELECT `transaksi`.*,  `list_rumah`.`tipe_id`, `list_rumah`.`lokasi_id`, `list_rumah`.`status`, `list_rumah`.`blok`, `list_rumah`.`nomor`, `list_rumah`.`harga`, `user`.`username`, `user`.`email`, `user`.`no_hp`
                  FROM `transaksi` 
                  INNER JOIN `list_rumah` ON `transaksi`.`rumah_id` = `list_rumah`.`id` 
                  INNER JOIN `user` ON `transaksi`.`user_id` = `user`.`id` 
                  WHERE `transaksi`.`id` = $id
                  ";

        return $this->db->query($query)->row_array();
    }

    public function konfirmasi($id)
    {

        $query = "SELECT `transaksi`.*, `list_rumah`.`id`,  
                  FROM `transaksi` 
                  INNER JOIN `list_rumah` ON `transaksi`.`rumah_id` = `list_rumah`.`id` 
                  WHERE `transaksi`.`id` = $id
                  ";

        return $this->db->query($query)->row_array();
    }
}
