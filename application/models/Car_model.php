<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Car_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_cars() {
        $cars = $this->db->get('cars');
        return [
            'cars' => $cars->result_array(),
            'count' => $cars->num_rows()
        ];
    }

    public function get_car($id) {
        $data = $this->db->where('id', $id)->get('cars')->row_array();
        return $data;
    }

    public function store_car($data) {
        $car = $this->db->insert('cars', $data);

        if($car) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_car($id, $data) {
        $car = $this->db->where('id', $id)->update('cars', $data);

        if($car) {
            return 'Car Edit Successful!';
        } else {
            return 'Car Edit Failed!';
        }
    }

    public function delete_car($id) {
        $car = $this->db->where('id', $id)->delete('cars');

        if($car) {
            return 'Car Deleted!';
        } else {
            return 'Failed to delete car.';
        }
    }

    public function get_available_cars() {
        return $this->db->where('is_available', 1)->from('cars')->get()->num_rows();
    }
}