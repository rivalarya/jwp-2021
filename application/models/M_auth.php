<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

	public function kirimEmail($type,$email)
    {
        $config = [
            'smtp_user' => 'phising.gilang1@gmail.com', // email untuk ngirim mail
            'smtp_pass'   => 'rifall.osd', // passwordnya
            'smtp_host' => 'smtp.gmail.com', // server google
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'priority' => 2,
            'protocol'  => 'smtp',
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('rival@arya.com', 'Rival Arya');
        $this->email->to($email);

        if($type == 'daftar'){
            $this->load->helper('string');
            $token = random_string('alnum', 36);
            $this->simpanToken($email,$token);

            $this->email->subject('Aktivasi Akun');
            $this->email->message('Akun ini belum di aktivasi. <a href='.base_url("aktivasi?email=$email&token=$token").'>Klik untuk aktivasi</a>');
        }

        if($this->email->send()){
            $this->session->set_flashdata('email_dikirim', 'Email untuk aktivasi telah dikirim. Silahkan cek email anda.');
            return true;
        }else{
            $this->session->set_flashdata('email_gagal_dikirim', 'Daftar gagal, silahkan coba lagi nanti.');
            // echo $this->email->print_debugger();
            die;
        }
    }

    public function simpanToken($email,$token)
    {  
        $data = [
            'email' => $email,
            'token'   => $token
        ];

        $this->db->insert('user_token', $data);
    }
}
