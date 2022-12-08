<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HalamanLogin extends CI_Controller 
{ 
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Pengguna', 'Pengguna');
        
    }
    public function tampil()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');


        if($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Login';   
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/HalamanLogin');
            $this->load->view('templates/auth_footer');
        } else {
            // validasinya sukses
            $this->cekAkun();
        }
    } 
     public function cekAkun()
    {
        // $username = $this->input->post('username', true);
        $username = $this->input->post(null, true);
        $password = $this->input->post('password');

        // $cekAkun = $this->db->get_where('pengguna', ['username' => $username])->row_array();
        $cekAkun = $this->Pengguna->cek($username['username']);
        // var_dump($cekAkun);
        // die;
        // $cekAkun = $this->pengguna->cekAkun($username['username']);
         //penggunanya ada
        if($cekAkun['username']) {
           //jika penggunanya aktif
            if($cekAkun['isActive'] ==1) {
                //cek password
                if($password == $cekAkun['password']) {
                    $data = [
                        'username' => $cekAkun['username'],
                        'roleId' => $cekAkun['roleId']
                    ];
                    $this->session->set_userdata($data);
                    redirect('Pengguna');

                } 
                else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
                    redirect('HalamanLogin/tampil');
                }

            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum aktif</div>');
                redirect('HalamanLogin/tampil');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum terdaftar</div>');
            redirect('HalamanLogin/tampil');
        }
    }    
        
    // }
    // public function cekAkun()
    // {
    //     $username = $this->input->post('username');
    //     $password = $this->input->post('password');
    //     $cekAkun = $this->db->get_where('pengguna', ['username' => $username])->row_array();
    //     if ($cekAkun) {
    //         //jika user aktif
    //         if ($cekAkun['is_active'] == 1) {
    //             //check password
    //             if ($password == $cekAkun['password']) {
    //                 $membuat_session = [
    //                     'username' => $cekAkun['username'],
    //                     'roleId' => $cekAkun['roleId'],
    //                     'logged_in' => true
    //                 ];
    //                 $this->db->where('pengguna.idGtk', $cekAkun['idGtk']);
    //                 $this->session->set_userdata($membuat_session); //Memasukan / menyimpan data ke session
    //                 redirect('Pengguna');
    //             } else {
    //                 $this->session->set_flashdata('authmsg', '<div class="alert alert-danger" role="alert">Password Atau Username Salah!</div>');
    //                 redirect('HalamanLogin');
    //             }
    //         } else {
    //             $this->session->set_flashdata('authmsg', '<div class="alert alert-danger" role="alert">Akun Ini Belum Aktif, Silakan Hubungi Pihak Administrator!</div>');
    //             redirect('HalamanLogin');
    //         }
    //     } else {
    //         $this->session->set_flashdata('authmsg', '<div class="alert alert-danger" role="alert">Akun Belum Terdaftar!</div>');
    //         redirect('HalamanLogin');
    //     }
    // }
 
}