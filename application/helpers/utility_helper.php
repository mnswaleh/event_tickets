<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function check_auth(){
    if (isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 1) {
            redirect('/reservations', 'refresh');
        }
        redirect('/events', 'refresh');
    }
}

function check_login(){
    if (!isset($_SESSION['user_id'])){
        redirect('/', 'refresh');
    }
}

function asset_url(){
    return base_url().'assets/';
}

function empty_inputs($input_array){
    $empty_inputs = [];
    foreach ($input_array as $k=>$v){
        if (empty($v)){
            $empty_inputs[$k] = "This field is empty!";
        }
    }
    return  $empty_inputs;
}