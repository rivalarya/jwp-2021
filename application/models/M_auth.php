<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function daftar()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $foto = $_FILES['foto'];

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('index');
            $this->load->view('templates/footer');
        } else {

            if (!$foto == '') {
                $config['upload_path'] = './assets/img';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('foto')) {
                    $foto = $this->upload->data('file_name');
                } else {
                    redirect("welcome", 'location');
                }
            } else {};

            if ($this->kirimEmail('daftar', $email)) {
                $data = array(
                        'nama' => html_escape($nama),
                        'email' => html_escape($email),
                        'password' => password_hash(html_escape($password), PASSWORD_BCRYPT),
                        'foto' => $foto,
                        'is_active' => 0
                    );
                $this->db->insert('users', $data);
                redirect("welcome", 'location');
            }
        }
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('index');
            $this->load->view('templates/footer');
        }else{
            $query = $this->db->query("SELECT * FROM users WHERE email = '$email'");
            if ($query->result() !== []) { // jika email ada
                $is_active = $this->db->query("SELECT is_active FROM users WHERE email = '$email'");
                foreach ($is_active->result() as $row) {
                    if ($row->is_active == '1') { // nilai 1 artinya sudah aktif, sedangkan 0 artinya belum diaktivasi
                        foreach ($query->result() as $row) {
                            if ($pass = password_verify($password, $row->password)) { //unhash password
                                $sesi = array(
                                    'nama'  => $row->nama,
                                    'login'  => true,
                                    'email'     => $email,
                                    'password' => $password,
                                    'foto' => $row->foto
                                );
    
                                $this->session->set_userdata($sesi);
                                redirect('home');
                            } else {
                                $this->session->set_flashdata('password_salah', 'Password salah.');
                                redirect("welcome", 'location');
                            }
                        }
                    } else {
                        $this->session->set_flashdata('belum_aktivasi', 'Akun belum di aktivasi. Silahkan cek email anda. jika tidak ada, periksa spam.');
                        redirect("welcome", 'location');
                    }
                }
            } else {
                $this->session->set_flashdata('belum_daftar', 'Akun anda belum terdaftar. Silahkan daftar terlebih dahulu.');
                redirect("welcome", 'location');
            }
        }

    }

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
            
            $this->email->subject('Aktivasi Akun');
            $this->email->message('Akun ini belum di aktivasi. <a href='.base_url("aktivasi?email=$email&token=$token").'>Klik untuk aktivasi</a>');
            if($this->email->send()){
                $this->simpanToken($email,$token); // jika berhasil dikirim, simpan ke database
                $this->session->set_flashdata('email_dikirim', 'Email untuk aktivasi telah dikirim. Silahkan cek email anda.');
                return true;
            }else{
                $this->session->set_flashdata('email_gagal_dikirim', 'Daftar gagal, silahkan coba lagi nanti.');
                redirect("welcome", 'location');
                // echo $this->email->print_debugger();
                // die;
            }

        }else{
            $this->load->helper('string');
            $kode = random_string('numeric', 6);
            
            $this->email->subject('Ganti kata sandi');
            $this->email->message('Anda lupa kata sandi anda. <br>Kode verifikasi : '.$kode. ' <br><a href='.base_url("lupa_sandi?email=$email&kode=$kode").'>Klik untuk mengganti</a>');
            
            if($this->email->send()){
                $this->simpanKode($email,$kode); // jika berhasil dikirim, simpan ke database
                $this->session->set_flashdata('email_dikirim', 'Email untuk ganti sandi telah dikirim. Silahkan cek email anda.');
                return true;
            }else{
                $this->session->set_flashdata('email_gagal_dikirim', 'Gagal, silahkan coba lagi nanti.');
                redirect("welcome", 'location');
                // echo $this->email->print_debugger();
                // die;
            }
        }

    }

    public function simpanToken($email,$token)
    {  
        $data = [
            'email' => $email,
            'token'   => $token
        ];

        $this->db->insert('request_aktivasi', $data);
    }

    public function simpankode($email,$kode)
    {
        $sudahMinta = $this->db->query("SELECT * FROM request_forgot WHERE email = '$email'");
        if($sudahMinta->result() == []){
            $data = [
                'email' => $email,
                'kode'   => $kode
            ];
            $this->db->insert('request_forgot', $data);
        }else {// jika user sudah pernah dikirim email untuk ganti namun minta lagi, ganti kode nya di database
            $this->db->query("UPDATE request_forgot set kode = '$kode' WHERE email = '$email'");
        }

    }
}
