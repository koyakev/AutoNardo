<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Car_model');
    }

    public function index() {
        if($this->session->userdata('user')) {
            $data['users'] = $this->User_model->get_users_count();
            $data['cars'] = $this->Car_model->get_cars_count();
            $this->load->view('admin/dashboard', $data);
        } else {
            redirect('admin/login');
        }
    }

    public function login() {
        if($this->session->userdata('user')) {
            redirect('admin/');
        } else {
            $this->load->view('admin/login');
        }
    }

    public function verify() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->login_user($email, $password);

        if($user['status'] == 'success') {
            $this->session->set_flashdata('message', $user['status']);
            $this->session->set_userdata('user', $user['data']);
            redirect('admin/');
        } else {
            $this->session->set_flashdata('message', $user['data']);
            redirect('admin/login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();

        redirect('admin/login');
    }

    public function cars_list() {
        $data['cars'] = $this->Car_model->get_cars();
        $this->load->view('admin/cars_list', $data);
    }

    public function cars_add() {
        $this->load->view('admin/cars_add');
    }

    public function cars_store() {
        $car_type = $this->input->post('car_type');
        $brand = $this->input->post('make');
        $model = $this->input->post('model');
        $transmission = $this->input->post('transmission');
        $plate_number = $this->input->post('plate_number');
        $rate = $this->input->post('rate');
        $condition = $this->input->post('condition');

        $id = strtoupper($brand[0]) . "-" . strtoupper(str_replace(" ", "_", $model)) . "-" . $transmission[0];

        $config['upload_path'] = FCPATH . 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name'] = $id;

        $this->upload->initialize($config);

        if($this->upload->do_upload('photo')) {
            $upload_data = $this->upload->data();
            echo $upload_data['full_path'];
            $this->session->set_flashdata('message', 'Upload success');
        } else {
            $error = $this->upload->display_errors();
            echo $error;
        }

        $data = [
            'id' => $id,
            'make' => $brand,
            'car_type' => $car_type,
            'model' => $model,
            'transmission' => $transmission,
            'plate_number' => $plate_number,
            'rental_price_per_day' => $rate,
            'condition_status' => $condition,
            'is_available' => 1,
            'image' => $upload_data['file_name']
        ];

        $insert = $this->Car_model->store_car($data);

        redirect('admin/cars_list');
    }

    public function car_view($id) {
        $data['car'] = $this->Car_model->get_car($id);
        $this->load->view('admin/car_view', $data);
    }
}