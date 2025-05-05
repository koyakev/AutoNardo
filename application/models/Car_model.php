<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_cars_count() {
        $count = $this->db->count_all('cars');
        return $count;
    }
}