<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('User_model');
    }

    public function verify() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->login_user($email, $password);

        // echo password_hash('user', PASSWORD_BCRYPT);
        if($user['status'] == 'success') {
            $this->session->set_flashdata('message', $user['status']);
            $this->session->set_userdata(['user' => $user['data'], 'isAdmin' => $user['data']->is_admin]);

            if($user['data']->is_admin) {
                redirect('admin/');
            } else {
                redirect('/');
            }
        } else {
            $this->session->set_flashdata('message', $user['data']);
            redirect('/');
        }
    }

    public function logout() {
        $this->session->sess_destroy();

        redirect('/');
    }

    public function store() {
        // Get input data
        $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
        $drivers_license_number = $this->input->post('drivers_license_number');
        $drivers_license_expiry = $this->input->post('drivers_license_expiry');

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare data for insertion
        $data = [
            'full_name' => $full_name,
            'email' => $email,
            'password' => $hashed_password,
            'phone' => $phone,
            'address' => $address,
            'drivers_license_number' => $drivers_license_number,
            'drivers_license_expiry' => $drivers_license_expiry,
        ];

        // Save user data
        $inserted = $this->User_model->register_user($data);

        if ($inserted) {
            $this->session->set_flashdata('message', 'Registration successful!');
            redirect('/login');
        } else {
            $this->session->set_flashdata('message', 'Registration failed. Please try again.');
            redirect('/register'); 
        }
    }
}