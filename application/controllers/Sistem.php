<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistem extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
    }
    public function index()
    {

    }
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('roleId');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda telah keluar</div>');
        redirect('HalamanLogin/tampil');
        
    }

}