<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Count_model extends CI_Model
{
    public function konsumen()
    {
        $query = "SELECT * FROM `user` WHERE `role_id` = 2";

        return $this->db->query($query)->num_rows();
    }

    public function karyawan()
    {
        $query = "SELECT * FROM `user` WHERE `role_id` != 2";

        return $this->db->query($query)->num_rows();
    }

    public function transaksi()
    {
        $query = "SELECT * FROM `transaksi` WHERE `status` = 1";

        return $this->db->query($query)->num_rows();
    }
}
