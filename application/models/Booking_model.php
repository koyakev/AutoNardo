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


	// public function get_bookings() {
	//     $data = $this->db->select('car_id, DATE_FORMAT(created_at)')->get('bookings')->result_array();

	//     return $data;
	// }
}
