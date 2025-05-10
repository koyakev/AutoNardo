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
}
