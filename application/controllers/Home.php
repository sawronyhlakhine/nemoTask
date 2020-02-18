<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->layout = "frontend";
		$this->parts['header'] = $this->load->view('includes/header', null, true);
		$this->parts['footer'] = $this->load->view('includes/footer', null, true);
	}

	public function index()
	{
		$this->title = "Home - Nemo Task";
		$this->load->view('home');
	}
}
