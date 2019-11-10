<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventsmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function all() {
        $this->db->where('eventDate >=', date('Y-m-d'));
        $this->db->where('date_deleted', NULL, FALSE);
        $this->db->order_by('eventDate');
        return $this->db->get('events')->result_array();
    }

    function select_where($select, $where) {
        $this->db->select($select);
        return $this->db->get_where('events', $where)->row_array();
    }

    function create_event($data) {
        return $this->db->insert('events', $data);
    }

    function update_event($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('events', $data);
    }

    function delete_event($id) {
        $this->db->set('date_deleted', 'CURRENT_TIMESTAMP', FALSE);
        $this->db->where('id', $id);
        $this->db->update('events');
    }
}