<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Car_model');
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
		if ($this->session->userdata('user') && $this->session->userdata('isAdmin') !== 1) {
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
}
