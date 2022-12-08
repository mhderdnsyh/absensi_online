<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Model 
{ 
    public function cek($username)
    {
        return $this->db->get_where('pengguna', ['username' => $username])->row_array();
    }
}