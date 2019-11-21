<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function all() {
        $this->db->where('userId', $_SESSION['user_id']);
        return $this->db->get('reservations')->result_array();
    }

    function all_bookings() {
        $this->db->select('reservations.*, events.eventTitle, events.venue, events.eventDate');
        $this->db->where('reservations.userId', $_SESSION['user_id']);
        $this->db->where('events.eventDate >=', date('Y-m-d'));
        $this->db->where('events.date_deleted', NULL, FALSE);
        $this->db->join('events', 'events.id = reservations.eventId', 'inner');
        return $this->db->get('reservations')->result_array();
    }

    function total_bookings($event_id) {
        $this->db->select('SUM(vip + regular) as total');
        $this->db->where('eventId', $event_id);
        return $this->db->get('reservations')->row_array();
    }

    function select_where($select, $where) {
        $this->db->select($select);
        return $this->db->get_where('reservations', $where)->row_array();
    }

    function make_reservation($data) {
        return $this->db->insert('reservations', $data);
    }

    function update_reservation($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('reservations', $data);
    }
}