<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends CI_Controller {
	public function index()
	{
		$this->load->view('header');
		$this->load->view('user_head');
		$this->load->view('reservations');
		$this->load->view('footer');
	}
}
