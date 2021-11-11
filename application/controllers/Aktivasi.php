<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi extends CI_Controller {
	 
	public function index()
	{
        $this->cek();
		$this->load->view('aktivasi/index');
	}

    public function cek()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $cariEmail = $this->db->get_where('users', array('email' => $email))->result(); //cari email apakah sudah daftar atau belum
        // jika email belum daftar
        if ($cariEmail == []) return $this->session->set_flashdata('email_tidak_ditemukan', 'Email tidak ditemukan. Silahkan <a href="welcome">daftar</a>.');
        if ($email == '') redirect('welcome'); // jika parameter email kosong, arahkan ke welcome
        if ($token == '') redirect('welcome'); // jika parameter token kosong, arahkan ke welcome      

        $this->db->query("SELECT * FROM users WHERE email = '$email' AND is_active = 0"); //cek akunnya        
        $is_already = $this->db->affected_rows(); // lalu ubah ke affected row

        if ($is_already >= 1) // 1 = ditemukan
        {
            $cariAkun = $this->db->query("SELECT * FROM request_aktivasi WHERE email = '$email' AND token = '$token'")->row(); // jika memang user ada aktivasi
            if ($cariAkun != null) {
                $this->db->query("UPDATE users set is_active = 1 WHERE email = '$email'");
                return $this->session->set_flashdata('berhasil_aktivasi', 'Email berhasil di aktivasi. Silahkan <a href="welcome">login</a>.');
            } else {
                return $this->session->set_flashdata('token_salah', 'Token salah.');
            }
        } else {
            return $this->session->set_flashdata('sudah_aktivasi', 'Email ini sudah di aktivasi. Silahkan <a href="welcome">login</a>.');
        }
    }

}
