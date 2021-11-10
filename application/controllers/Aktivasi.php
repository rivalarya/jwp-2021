<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi extends CI_Controller {
	 
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('aktivasi/index');
		$this->load->view('templates/footer');

		$email = $this->input->get('email');
        $cariEmail = $this->db->get_where('user_token', array('email' => $email))->result(); //cari email di tabel user_token
		$token = $this->input->get('token');
        if($email == '') redirect('home'); // jika parameter email kosong, arahkan ke home
        if($token == '') redirect('home'); // jika parameter token kosong, arahkan ke home
        
        $cariToken = $this->db->query("SELECT token from user_token WHERE token = '$token'");

        // jika email tidak ada
        if($cariEmail == [] ) return $this->session->set_flashdata('email_tidak_ditemukan', 'Email tidak ditemukan. Silahkan daftar.');

        if($cariToken->result() == []) return $this->session->set_flashdata('token_tidak_ditemukan', 'Token tidak ditemukan.');
        // foreach ($cariToken->result() as $row)
        // {
        // // jika token tidak ada

        // echo '000';
        // var_dump($row);
        //     if($token != $row->token) $this->session->set_flashdata('token_tidak_ditemukan', 'Token tidak ditemukan.');
        // }  
        //  $cekToken = $this->db->query("SELECT * FROM user_token WHERE email = 'rifall.osd26@gmail.com'");
        //     var_dump($cekToken->row());         
        
        $this->db->query("SELECT * FROM users WHERE email = '$email' AND is_active = 0");//cek akunnya        
        $is_already = $this->db->affected_rows();// lalu ubah ke affected row

        if ($is_already >= 1) // 1 = ditemukan
        {
            $cariAkun = $this->db->query("SELECT * FROM user_token WHERE email = '$email' AND token = '$token'")->row();
            if($cariAkun != null){                
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
