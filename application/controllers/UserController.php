<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Car_model');
    }

    public function index() {
        $data['cars'] = $this->Car_model->get_cars()['cars'];

        $this->load->view('user/landing', $data);
    }

    public function login() {
        $this->load->view('user/login');
    }

	public function register() {
		$this->load->view('user/register');
	}

    public function car_view($id) {
        $data['car'] = $this->Car_model->get_car($id);

        $this->load->view('user/car_view', $data);
    }
}