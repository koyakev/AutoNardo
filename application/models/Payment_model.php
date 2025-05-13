<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function store($data)
	{
		return $this->db->insert('payments', $data);
	}

	public function get_all_payments()
	{
		return $this->db->get('payments')->result_array();
	}

    public function get_booking_payments()
    {
        return $this->db->select('bookings.*, payments.*')->from('bookings')->join('payments', 'bookings.id = payments.booking_id', 'left')->get()->result_array();
    }

    public function get_booking_payment_by_id($id)
    {
        return $this->db->select('bookings.*, payments.*')->from('bookings')->where('bookings.id', $id)->join('payments', 'bookings.id = payments.booking_id', 'left')->get()->row();
    }

	// Get payment by ID
	public function get_payment($id)
	{
		return $this->db->where('id', $id)->get('payments')->row_array();
	}

	// Get payments by user ID
	public function get_payments_by_user($user_id)
	{
		return $this->db->where('user_id', $user_id)->get('payments')->result_array();
	}

	// Get payments by booking ID
	public function get_payments_by_booking($booking_id)
	{
		return $this->db->where('booking_id', $booking_id)->get('payments')->result_array();
	}

	// Update payment status or any field
	public function update_payment($id, $data)
	{
		return $this->db->where('id', $id)->update('payments', $data);
	}

	// Delete a payment record
	public function delete_payment($id)
	{
		return $this->db->where('id', $id)->delete('payments');
	}

	public function update_status_by_reference($reference, $data)
	{
		$this->db->where('transaction_reference', $reference);
		return $this->db->update('payments', $data);
	}

	public function get_payment_by_reference($reference)
	{
		return $this->db->where('transaction_reference', $reference)->get('payments')->row_array();
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

    public function gett_yearly_rating() {
        $year = intval(date('Y'));
        $lyear = $year - 1;
        $l2year = $year - 2;

        return [
            $year => ($year/10000)
        ];
    }
}