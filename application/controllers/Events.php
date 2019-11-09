<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('eventsmodel');
	}
	
	public function index()
	{
		$data['events'] = $this->eventsmodel->all();
		$this->load->view('header');
		$this->load->view('user_head');
		$this->load->view('events', $data);
		$this->load->view('footer');
	}
}
