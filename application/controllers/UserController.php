<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Car_model');
		$this->load->model('Booking_model');
		$this->load->model('Payment_model');
		$this->load->library('session');
	}

	public function load_nav()
	{
		$data['user'] = $this->session->userdata('user');
		$this->load->view('user/nav', $data);
	}

	public function index()
	{
		$data['title'] = "Autonardo | Rentals";
		$data['cars'] = $this->Car_model->get_cars()['cars'];
		$this->load->view('user/header', $data);
		$this->load_nav();
		$this->load->view('user/landing', $data);
		$this->load->view('user/footer', $data);
	}

	public function login()
	{
		$this->load->view('user/login');
	}

	public function register()
	{
		$this->load->view('user/register');
	}

	public function car_view($id)
	{
		if ($this->session->userdata('user')) {
			$car = $this->Car_model->get_car($id);
			$data['title'] = "Autonardo | Booking | " . $car['make'] . " " . $car['model'];
			$data['car'] = $car;
			$this->load->view('user/header', $data);
			$this->load_nav();
			$this->load->view('user/car_view', $data);
			$this->load->view('user/footer', $data);
		} else {
			redirect('/login');
		}
	}

	public function rental_history()
	{
		if ($this->session->userdata('user')) {
			$user = $this->session->userdata('user');
			$user_id = $user->id;
			$data['title'] = "Autonardo | Rental History ";

			// Get user bookings
			$data['bookings'] = $this->Booking_model->get_user_bookings($user_id);
			

			
			$bookings_with_totals = [];
			
			foreach ($data['bookings'] as $booking) {
				$payments = $this->Payment_model->get_payments_by_booking($booking['id']);
				$checkout_urls = $this->Payment_model->get_payments_by_booking($booking['id']);
				$total = 0;
				$checkout_url = "";

				// Sum up the total payments for the booking
				foreach ($payments as $payment) {
					$total += $payment['amount'];
					$checkout_url = $payment ['checkout_url'];
				}

				// Add the total to the booking data
				$booking['total'] = $total;
				$booking['checkout_url'] = $checkout_url;
				$bookings_with_totals[] = $booking;
			}

			$data['bookings'] = $bookings_with_totals;

			if (empty($data['bookings'])) {
				$data['error'] = "No rental history found.";
			}

			$this->load->view('user/header', $data);
			$this->load_nav();
			$this->load->view('user/rental_history', $data);
			$this->load->view('user/footer', $data);
		} else {
			redirect('/login');
		}
	}

	public function get_booked_dates()
	{
		$car_id = $this->input->get('car_id');
		$bookings = $this->Booking_model->get_bookings_by_car($car_id);

		$booked_dates = [];
		foreach ($bookings as $booking) {
			$start_date = $booking['start_date'];
			$end_date = $booking['end_date'];

			// Create a DatePeriod to get all dates between start and end date
			$period = new DatePeriod(
				new DateTime($start_date),
				new DateInterval('P1D'),
				new DateTime($end_date . ' +1 day')
			);

			foreach ($period as $date) {
				$booked_dates[] = $date->format('Y-m-d');
			}
		}

		echo json_encode($booked_dates);
	}

	public function edit_user()
	{
		if ($this->session->userdata('user')) {
			$user = $this->session->userdata('user');
			$user_id = $user->id;

			
			if ($this->input->post()) {
				
				$data = [
					'full_name' => $this->input->post('full_name'),
					'email' => $this->input->post('email'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'drivers_license_number' => $this->input->post('drivers_license_number'),
					'drivers_license_expiry' => $this->input->post('drivers_license_expiry'),
				];
				
				$this->User_model->update_user($user_id, $data);
				
				$this->session->set_flashdata('success', 'User data updated successfully.');

				
				redirect('/profile'); 
			} else {
				// Load the current user data to pre-fill the form
				$data['user'] = $this->User_model->get_user($user_id);
				$data['title'] = "Edit Profile";
				$this->load->view('user/header', $data);
				$this->load->view('user/edit_profile', $data); // Create this view for the form
				$this->load->view('user/footer', $data);
				
			}
		} else {
			redirect('/login');
		}
	}

	public function profile()
	{
		if ($this->session->userdata('user')) {
			$user = $this->session->userdata('user');
			$data['user'] = $this->User_model->get_user($user->id);
			$data['title'] = "User Profile";
			$this->load->view('user/header', $data);
			$this->load_nav();
			$this->load->view('user/profile_view', $data);
			$this->load->view('user/footer', $data);
		} else {
			redirect('/login');
		}
	}

	public function change_password()
	{
		if ($this->session->userdata('user')) {
			$user = $this->session->userdata('user');
			$user_id = $user->id;

			if ($this->input->post()) {
				$current_password = $this->input->post('current_password');
				$new_password = $this->input->post('new_password');
				$confirm_password = $this->input->post('confirm_password');

				// Validate current password
				$user_data = $this->User_model->get_user($user_id);
				if (password_verify($current_password, $user_data['password'])) {
					if ($new_password === $confirm_password) {
						// Update password
						$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
						$this->User_model->update_user($user_id, ['password' => $hashed_password]);
						$this->session->set_flashdata('success', 'Password changed successfully.');
					} else {
						$this->session->set_flashdata('error', 'New passwords do not match.');
					}
				} else {
					$this->session->set_flashdata('error', 'Current password is incorrect.');
				}

				redirect('/profile');
			}
		} else {
			redirect('/login');
		}
	}
}
