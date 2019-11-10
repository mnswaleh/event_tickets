<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index()
	{
		check_auth();
		$this->load->view('header');
		$this->load->view('login_page');
		$this->load->view('footer');
	}

	public function set_session($user_id, $user_role)
	{
		$_SESSION['user_id'] = $user_id;
		$_SESSION['user_role'] = $user_role;
	}

	public function login()
	{
		$user_inputs = $this->input->post(NULL, FALSE);
		$user_inputs = array_map('trim', $user_inputs);
		$empty_inputs = empty_inputs($user_inputs);
		$response = TRUE;
		if (!empty($empty_inputs)){
			$response = FALSE;
		} else if(!filter_var($user_inputs['email'], FILTER_VALIDATE_EMAIL)){
			$response = FALSE;
		} else{
			$user = $this->user_model->select_where('id, role, password', ["email" => $user_inputs['email']]);

			if (empty($user) || !password_verify($user_inputs['password'], $user['password'])){
				$response = FALSE;
			} else{
				$this->set_session($user['id'], $user['role']);
			}
		}

		exit(json_encode($response));
	}

	public function sign_up()
	{
		$user_inputs = $this->input->post(NULL, FALSE);
		$user_inputs = array_map('trim', $user_inputs);
		$response = empty_inputs($user_inputs);
		if (empty($response)){
			if(!filter_var($user_inputs['email'], FILTER_VALIDATE_EMAIL)){
				$response['email'] = "Invalid email!";
			} else if($user_inputs['password'] != $user_inputs['confirmPass']) {
				$response['confirmPass'] = "Password do not match!";
			} else {
				unset($user_inputs['confirmPass']);
				$user_inputs['password'] = password_hash($user_inputs['password'], PASSWORD_BCRYPT);
				$user_inputs['role'] = 1;
				$this->user_model->create_user($user_inputs);
				$user = $this->user_model->select_where('id, role', ["email" => $user_inputs['email']]);
				$this->set_session($user['id'], $user['role']);
				$response['success'] = "Event created!";
			}
		}

		exit(json_encode($response));
	}


	public function logout()
	{
		unset(
			$_SESSION['user_id'],
			$_SESSION['user_role']
		);
		redirect('/', 'refresh');
	}
}
