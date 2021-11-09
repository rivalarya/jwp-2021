<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi extends CI_Controller {
	 
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('aktivasi/index');
		$this->load->view('templates/footer');

		$email = $this->input->get('email');
        $cariEmail = $this->db->get_where('users', array('email' => $email))->result();
		$token = $this->input->get('token');
        
        $cariToken = $this->db->query("SELECT token from user_token");

        // jika email dan token tidak ada
        if($cariEmail == [] && $cariToken == []) return $this->session->set_flashdata('akun_tidak_ditemukan', 'Akun tidak ditemukan.');

        foreach ($cariToken->result() as $row)
        {
        // jika token tidak ada
            if($token != $row->token) return $this->session->set_flashdata('token_tidak_ditemukan', 'Token tidak ditemukan.');
        }        
        
        // jika email tidak ada
        if($cariEmail == []) return $this->session->set_flashdata('email_tidak_ditemukan', 'Email tidak ditemukan. Silahkan daftar.');
        
        $this->db->query("SELECT * FROM users WHERE email = '$email' AND is_active = 0");//cek akunnya        
        $is_already = $this->db->affected_rows();// lalu ubah ke affected row

        if ($is_already >= 1)
        {
            $cekToken = $this->db->query("SELECT * FROM user_token WHERE email = '$email' AND token = '$token'");
            if($cekToken == true){                
                $this->db->query("UPDATE users set is_active = 1 WHERE email = '$email'");
                $this->session->set_flashdata('berhasil_aktivasi', 'Email berhasil di aktivasi. Silahkan login.');
            }
        }
        else
        {
            $this->session->set_flashdata('sudah_aktivasi', 'Email ini sudah di aktivasi. Silahkan login.');
        }

	}

}
