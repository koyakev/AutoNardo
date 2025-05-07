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

    public function get_cars() {
        $data = $this->db->get('cars')->result_array();
        return $data;
    }

    public function get_car($id) {
        $data = $this->db->where('id', $id)->get('cars')->row_array();
        return $data;
    }

    public function store_car($data) {
        $data = $this->db->insert('cars', $data);

        if($data) {
            return 1;
        } else {
            return 0;
        }
    }
}