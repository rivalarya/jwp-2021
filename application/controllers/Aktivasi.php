<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi extends CI_Controller {
	 
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('aktivasi/index');
		$this->load->view('templates/footer');

		$email = $this->input->get('email');
		$token = $this->input->get('token');
        $cariEmail = $this->db->get_where('request_aktivasi', array('email' => $email))->result(); //cari email di tabel request_aktivasi
        // jika email tidak ada
        if($cariEmail == [] ) return $this->session->set_flashdata('email_tidak_ditemukan', 'Email tidak ditemukan. Silahkan <a href="welcome">daftar</a>.');
        if($email == '') redirect('welcome'); // jika parameter email kosong, arahkan ke welcome
        if($token == '') redirect('welcome'); // jika parameter token kosong, arahkan ke welcome      
        
        $this->db->query("SELECT * FROM users WHERE email = '$email' AND is_active = 0");//cek akunnya        
        $is_already = $this->db->affected_rows();// lalu ubah ke affected row

        if ($is_already >= 1) // 1 = ditemukan
        {
            $cariAkun = $this->db->query("SELECT * FROM request_aktivasi WHERE email = '$email' AND token = '$token'")->row();
            if($cariAkun != null){                
                $this->db->query("UPDATE users set is_active = 1 WHERE email = '$email'");
                $this->session->set_flashdata('berhasil_aktivasi', 'Email berhasil di aktivasi. Silahkan <a href="welcome">login</a>.');
                redirect(base_url("aktivasi?email=$email&token=$token"), 'location');
            }else{
                $this->session->set_flashdata('token_salah', 'Token salah.');
                redirect(base_url("aktivasi?email=$email&token=$token"), 'location');
            }
        }
        else
        {
            $this->session->set_flashdata('sudah_aktivasi', 'Email ini sudah di aktivasi. Silahkan <a href="welcome">login</a>.');
            redirect(base_url("aktivasi?email=$email&token=$token"), 'location');
        }

	}

}
