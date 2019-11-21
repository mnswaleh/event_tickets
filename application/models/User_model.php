<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function all() {
        return $this->db->get('users')->result_array();
    }

    function create_user($data) {
        return $this->db->insert('users', $data);
    }

    function select_where($select, $where) {
        $this->db->select($select);
        return $this->db->get_where('users', $where)->row_array();
    }

    function current_user(){
        $user = $this->select_where('firstName, lastName, email', ["id" => $_SESSION['user_id']]);
        $user_data['user'] = ucfirst($user['firstName']) . ' ' . ucfirst($user['lastName']);
        $user_data['user_email'] = $user['email'];

        return $user_data;
    }
}