<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function create_booking($data) {
        return $this->db->insert('bookings', $data);
    }

    // public function get_bookings() {
    //     $data = $this->db->select('car_id, DATE_FORMAT(created_at)')->get('bookings')->result_array();

    //     return $data;
    // }
}
