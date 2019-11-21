<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

	function __construct() {
		parent::__construct();
		check_login();
		$this->load->model('eventsmodel');
		$this->load->model('reservation_model');
	}

	function refine_events(){
		$events = $this->eventsmodel->all();
		$events_booked = [];
		foreach ($events as $event){
			$total_bookings = $this->reservation_model->total_bookings($event['id']);
			$event['bookings'] = (int)$total_bookings['total'];
			array_push($events_booked, $event);
		}

		return $events_booked;
	}
	
	public function index()
	{
		$data['events'] = $this->refine_events();
		$header_data = $this->user_model->current_user();
		$this->load->view('header');
		$this->load->view('user_head', $header_data);
		$this->load->view('events', $data);
		$this->load->view('footer');
	}

	function process_data($user_inputs){
		$user_inputs = array_map('trim', $user_inputs);
		$response = empty_inputs($user_inputs);
		if (!empty($response)){
			// return the errors
		} elseif(stripos($user_inputs['maxAttendees'], '.')){
			$response['maxAttendees'] = "Invalid number of Attendees!";
		}

		return $response;
	}

	public function create_event()
	{
		$user_inputs = $this->input->post(NULL, FALSE);
		$response = $this->process_data($user_inputs);
		if (empty($response)){
			$this->eventsmodel->create_event($user_inputs);
			$response['success'] = "Event created!";
		}

		exit(json_encode($response));
	}

	public function update_event($event_id)
	{
		$user_inputs = $this->input->post(NULL, FALSE);
		$user_inputs = array_map('trim', $user_inputs);
		$response = $this->process_data($user_inputs);
		if (empty($response)){
			$this->eventsmodel->update_event($event_id, $user_inputs);
			$response['success'] = "Event updated!";
		}

		exit(json_encode($response));
	}

	public function delete_event($event_id)
	{
		$this->eventsmodel->delete_event($event_id);
		$response['success'] = "Event updated!";

		exit(json_encode($response));
	}
}
