<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->login == '') redirect('welcome');
	}
	 
	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('home/index');
		$this->load->view('templates/footer');
	}

	public function logout()
	{
		unset($_SESSION['login'],$_SESSION['nama'],$_SESSION['email'],$_SESSION['password']);
		redirect('welcome');
	}
	
}
