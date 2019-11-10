<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservations extends CI_Controller {

	function __construct() {
		parent::__construct();
		check_login();
		$this->load->model('reservation_model');
		$this->load->model('eventsmodel');
	}

	public function index()
	{
		$data['reservations'] = $this->reservation_model->all_bookings();
		$header_data = $this->user_model->current_user();
		$this->load->view('header');
		$this->load->view('user_head', $header_data);
		$this->load->view('reservations', $data);
		$this->load->view('footer');
	}

	public function make_reservation()
	{
		$user_inputs = $this->input->post(NULL, FALSE);
		$user_inputs = array_map('trim', $user_inputs);
		$total_tickets = $user_inputs['vip'] + $user_inputs['regular'];

		$response = [];

		if ($total_tickets < 1 || $total_tickets > 5){
			$response['error'] = "Make between 1 - 5 total reservations!";
		} else {
			$user_inputs['userId'] = $_SESSION['user_id'];
			$reservations = $this->reservation_model->select_where(
				'id, vip, regular', ["userId" => $_SESSION['user_id'], "eventId" => $user_inputs['eventId']]);
			$max_bookings = $this->eventsmodel->select_where('maxAttendees', ["id" => $user_inputs['eventId']]);
			$total_bookings = $this->reservation_model->total_bookings($user_inputs['eventId']);
			$remaining_slots = $max_bookings['maxAttendees'] - $total_bookings['total'];

			if(empty($reservations)){
				$this->reservation_model->make_reservation($user_inputs);
				$response['success'] = "Reservation made!";
			} elseif($remaining_slots == 0) {
				$response['error'] = "This event is fully booked!";
			} elseif($remaining_slots < $total_tickets) {
				$response['error'] = "Only " . $remaining_slots . " slots available for this event!";
			} elseif(($total_tickets + $reservations['vip'] + $reservations['regular']) > 5){
				$current_reservations = ($reservations['vip'] + $reservations['regular']);
				$response['error'] = "You already have " . $current_reservations
					. " reservetions. " . (5 - $current_reservations) . " more slots left!";
			} else {
				$this->reservation_model->update_reservation(
					$reservations['id'],
					array(
						'vip' => ($reservations['vip'] + $user_inputs['vip']),
						'regular' => ($reservations['regular'] + $user_inputs['regular'])
					)
				);
				$response['success'] = "Reservation made!";
			}
		}
		exit(json_encode($response));
	}
}
