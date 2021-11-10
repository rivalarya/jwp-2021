<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('m_auth');
		if($this->session->login != '') redirect('home'); // jika sudah punya sesi, langsung masuk ke home
	}
	 
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('index');
		$this->load->view('templates/footer');
	}
	
	public function daftar()
	{
		$this->m_auth->daftar();
	}

	public function login()
	{
		$this->m_auth->login();    
	}

	public function lupa_sandi()
	{
		$this->load->view('templates/header');
		$this->load->view('lupa_sandi/index');
		$this->load->view('templates/footer');   
	}
}
