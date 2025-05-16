<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Booking_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create_booking($data)
	{
		return $this->db->insert('bookings', $data);
	}

	public function update_booking_status($booking_id, $status)
	{
		return $this->db->where('id', $booking_id)
			->update('bookings', ['status' => $status, 'updated_at' => date('Y-m-d H:i:s')]);
	}

	public function get_user_bookings($user_id)
	{
		return $this->db->where('user_id', $user_id)
			->get('bookings')
			->result_array();
	}

	public function get_bookings_by_car($car_id)
	{
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->where('car_id', $car_id);
		$query = $this->db->get();

		return $query->result_array(); // Return the result as an array
	}

	public function get_ongoing_bookings()
	{
		return $this->db->where('start_date <=', date('Y-m-d'))->where('end_date >=', date('Y-m-d'))->get('bookings')->result_array();
	}

	public function get_upcoming_bookings()
	{
		return $this->db->where('start_date >=', date('Y-m-d'))->where('status', 'confirmed')->get('bookings')->num_rows();
	}
}
