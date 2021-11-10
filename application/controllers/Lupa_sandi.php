<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_sandi extends CI_Controller {

    public function __construct(){
		parent::__construct();
        $this->load->model('m_auth');
		if($this->session->login != '') redirect('home'); // jika sudah punya sesi, langsung masuk ke home
	}
	 
	public function index()
	{        

		$email = $this->input->get('email');
        $this->session->set_userdata('email_ganti',$email);// beri sesi berisi email agar auto terisi saat pertama kali halaman dibuka

        $this->load->view('templates/header');
		$this->load->view('lupa_sandi/cek_kode');
		$this->load->view('templates/footer');        
        
	}

	public function kirim_kode()
	{
        $email = $this->input->post('email');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            redirect("welcome/index", 'location');
        }else{
            $cariEmail = $this->db->query("SELECT * FROM users WHERE email = '$email'");
            if ($cariEmail->result() !== []) { // jika email ad(sudah pernah daftar)
                $this->m_auth->kirimEmail('lupa_sandi',$email);
                $this->index();
            }else{
                $this->session->set_flashdata('belum_daftar', 'Akun anda belum terdaftar. Silahkan <a href="../">daftar</a> terlebih dahulu.');
                redirect(base_url("welcome/lupa_sandi"), 'location');
            }
        }
	}

	public function cek_kode()
	{
        $email = $this->input->post('email');
        $kode = $this->input->post('kode');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect("lupa_sandi", 'location');
        }else{  

            $cariAkunDiForgot = $this->db->query("SELECT * FROM request_forgot WHERE email = '$email'")->row();
            if ($cariAkunDiForgot != []) {

                $cekKode = $this->db->query("SELECT * FROM request_forgot WHERE email = '$email' AND kode = '$kode'")->row();
                if($cekKode != []){
                    $this->session->set_userdata('ganti_sandi',true);
                    $this->ganti();
                }else{
                    $this->session->set_flashdata('kode_salah', 'Kode salah, silahkan periksa lagi.');
                    redirect(base_url("lupa_sandi?email=$email"),'location');
                }
            }else{
                $this->session->set_flashdata("akun_tidak_minta", "Akun tidak meminta ganti sandi, silahkan <a href='welcome/lupa_sandi'>ke halaman lupa sandi</a>.");
                redirect(base_url("lupa_sandi?email=$email"), 'location');
            }
        }
        
	}

    public function ganti()
    {
        if($this->session->userdata('ganti_sandi') == '') redirect('lupa_sandi'); // jika di direct,arahkan ke form cek_kode
        $this->load->view('templates/header');
        $this->load->view('lupa_sandi/ganti_sandi');
        $this->load->view('templates/footer');
    }

	public function ganti_sandi()
    {
        if ($this->session->userdata('ganti_sandi') == '') redirect('lupa_sandi'); // jika di direct,arahkan ke form cek_kode
        $email = $this->input->post('email');
        $passwordbaru = $this->input->post('password');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect("lupa_sandi/ganti", 'location');
        }else{
            $cariAkun = $this->db->query("SELECT * FROM users WHERE email = '$email'")->row();
            if($cariAkun != null){                
                $passhass = password_hash(html_escape($passwordbaru), PASSWORD_BCRYPT);
                $this->db->query("UPDATE users set password = '$passhass' WHERE email = '$email'");
                $this->session->set_flashdata('berhasil_diganti', 'Sandi akun sudah di ganti sandi. Silahkan login.');
                unset($_SESSION['ganti_sandi']); // hapus session untuk ganti sandi
                $this->db->delete('request_forgot', array('email' => $email));  // jika sandi sudah terganti, hapus di request_forgot

                redirect(base_url("welcome"), 'location');
            }else{
                echo 'Akun tidak ditemukan';
            }

	    }
    }

}