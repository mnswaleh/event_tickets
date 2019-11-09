<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eventsmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function all() {
        return $this->db->get('events')->result_array();
    }
}