<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function store_payment_details($data) {
        $this->db->insert('payments', $data);
    }

    public function get_monthly_sales($year = null) {
        $year = $year ?? date('Y');

        return [
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '1'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '2'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '3'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '4'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '5'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '6'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '7'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '8'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '9'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '10'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '11'", null, false)->from('payments')->get()->row(),
            $this->db->select('SUM(amount)')->where("YEAR(transaction_date) = '{$year}' AND MONTH(transaction_date) = '12'", null, false)->from('payments')->get()->row(),
        ];
    }

    public function get_yearly_sales() {
        $year = intval(date('Y'));
        $lyear = intval(date('Y')) - 1;
        $l2year = intval(date('Y')) - 2;

        return [
            'years' => [$l2year, $lyear, $year],
            'sales' => [
                $this->db->select('SUM(AMOUNT)')->where("YEAR(transaction_date) = '{$l2year}'", null, false)->from('payments')->get()->row(),
                $this->db->select('SUM(AMOUNT)')->where("YEAR(transaction_date) = '{$lyear}'", null, false)->from('payments')->get()->row(),
                $this->db->select('SUM(AMOUNT)')->where("YEAR(transaction_date) = '{$year}'", null, false)->from('payments')->get()->row(),
            ]
        ];
    }

    public function get_car_bookings() {
        $year = date('Y');
        $cars = $this->db->select('car_id, COUNT(*) AS count')->where("YEAR(created_at) = '{$year}'")->group_by('car_id')->get('bookings');
        
        return $cars->result_array();
    }
}