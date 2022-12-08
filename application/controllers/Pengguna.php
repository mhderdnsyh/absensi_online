<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller 
{ 
    public function index() 
    {
        $data['title'] = 'Absensi SD Negeri 37 Kota Pekanbaru';
        $data['pengguna'] = $this->db->get_where('pengguna', ['username' =>
        $this->session->userdata('username')])->row_array();
        // echo 'Selamat datang ' . $data['pengguna']['namaLengkap'];
        $this->load->view('pengguna/HalamanPengguna',$data);
    }
}