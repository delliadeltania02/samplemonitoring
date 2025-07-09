<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct(){
		parent:: __construct();

		$this->load->model('m_login');
	}

	public function index()
	{
		$this->load->view('portal_menu');
	}

	public function login_adidas()
	{
		$this->load->view('adidas/login/login.php');
	}

	public function login_other()
	{
		$this->load->view('other/login/login.php');
	}
}
