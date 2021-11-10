<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model {

	public function login()
    {        
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $query = $this->db->query("SELECT * FROM users WHERE email = '$email'");
		if($query->result() !== []){ // jika data tidak kosong
			$is_active = $this->db->query("SELECT is_active FROM users WHERE email = '$email'");
			foreach ($is_active->result() as $row)
			{
				if($row->is_active == '1'){ // nilai 1 artinya sudah aktif, sedangkan 0 artinya belum diaktivasi
                    foreach($query->result() as $row){
                        if($pass = password_verify($password,$row->password)){//unhash password
                            $sesi = array(
                                'nama'  => $row->nama,
                                'login'  => true,
                                'email'     => $email,
                                'password' => $password,
                                'foto' => $row->foto
                            );

                            $this->session->set_userdata($sesi);
                            redirect('home');
                        }else{
                            $this->session->set_flashdata('password_salah', 'Password salah.');
					        redirect('welcome');
                        }
                    }
				}else{
					$this->session->set_flashdata('belum_aktivasi', 'Akun belum di aktivasi. Silahkan cek email anda. jika tidak ada, periksa folder spam.');
					redirect('welcome');
				}
			}  
		}else{
			$this->session->set_flashdata('belum_daftar', 'Akun anda belum terdaftar. Silahkan daftar terlebih dahulu.');
            redirect('welcome');
		}
    }

}
