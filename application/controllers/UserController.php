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
				$total = 0;

				// Sum up the total payments for the booking
				foreach ($payments as $payment) {
					$total += $payment['amount'];
				}

				// Add the total to the booking data
				$booking['total'] = $total;
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
}
