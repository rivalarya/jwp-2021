<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('m_daftar');
		if($this->session->login != '') redirect('home'); // jika sudah punya sesi, langsung masuk ke home
	}
	 
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('index');
		$this->load->view('templates/footer');
	}

	public function login()
	{
        $this->load->model('m_login');
		$this->m_login->login();    
	}

	public function daftar()
	{
		$nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $foto = $_FILES['foto'];

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run() == FALSE){
            $this->index();
        }else{
            
            if(!$foto == ''){
                $config['upload_path'] = './assets/img';
                $config['allowed_types'] = 'jpg|jpeg|png';
    
                $this->load->library('upload', $config);
                if($this->upload->do_upload('foto')){
                    $foto = $this->upload->data('file_name');
                }else{
                    $this->index();
                }
            }else{};
    
			if($this->m_daftar->kirimEmail('daftar',$email)){
				$data = array(
					'nama' => html_escape($nama),
					'email' => html_escape($email),
					'password' => password_hash(html_escape($password), PASSWORD_BCRYPT),
					'foto' => $foto,
					'is_active' => 0
				);
				$this->db->insert('users', $data);
				redirect('home');
			}
		
        }
	}
}
