<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookingController extends CI_Controller {
    public function __construct() {
        parent::__construct();
		$this->load->model('Booking_model');
    }

    public function book_rental() {
			 $user_id = $this->input->post('user_id');
			 $car_id = $this->input->post('car_id');
			 $start_date = $this->input->post('start_date');
			 $end_date = $this->input->post('end_date');
			 $status = $this->input->post('status');
	 
			 // Prepare data for insertion
			 $data = [
				 'user_id' => $user_id,
				 'car_id' => $car_id,
				 'start_date' => $start_date,
				 'end_date' => $end_date,
				 'status' => $status,
				 'created_at' => date('Y-m-d H:i:s'),
				 'updated_at' => date('Y-m-d H:i:s'),
			 ];
	 
			 // Save booking data
			 $inserted = $this->Booking_model->create_booking($data);
	 
			 if ($inserted) {
				 $this->session->set_flashdata('message', 'Booking successful!');
				 redirect('/car_view/' . $car_id); // Redirect to a success page or car view
			 } else {
				 $this->session->set_flashdata('message', 'Booking failed. Please try again.');
				 redirect('/car_view/' . $car_id); // Redirect back to the car view
			 }
    }
}