<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->model('User_model');
    }

    public function verify($level = '') {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->login_user($email, $password);

        // echo password_hash('user', PASSWORD_BCRYPT);
        if($user['status'] == 'success') {
            $this->session->set_flashdata('message', $user['status']);
            $this->session->set_userdata(['user' => $user['data'], 'isAdmin' => $user['data']->is_admin]);

            if($user['data']->is_admin && $level == 'admin') {
                redirect('admin/');
            } else {
                redirect('/');
            }
        } else {
            $this->session->set_flashdata('message', $user['data']);
            redirect($this->agent->referrer());
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
        $phone = '09' . $this->input->post('phone');
        $address = $this->input->post('address');
        $drivers_license_number = $this->input->post('drivers_license_number');
        $drivers_license_expiry = $this->input->post('drivers_license_expiry');
        $is_admin = $this->input->post('is_admin') ?? 0;
        $admin = $is_admin ?? 0;

        $user_type = 0;

        $user = $this->session->userdata('user');

        if($user) {
            $user_type = $user->is_admin;
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare data for insertion
        $data = [
            'id' => $this->generate_id($admin),
            'full_name' => $full_name,
            'email' => $email,
            'password' => $hashed_password,
            'phone' => $phone,
            'address' => $address,
            'drivers_license_number' => $drivers_license_number,
            'drivers_license_expiry' => $drivers_license_expiry,
            'is_admin' => $is_admin,
            'created_at' => date('Y:m:d H:i:s'),
        ];

        // Save user data
        $inserted = $this->User_model->register_user($data);

        if ($inserted) {
            $this->session->set_flashdata('message', 'Registration successful!');

            switch($user_type) {
                case 0: {
                    redirect('/login');
                } break;

                case 1: {
                    redirect('/admin/users_list');
                }
            }
        } else {
            $this->session->set_flashdata('message', 'Registration failed. Please try again.');
            
            switch($admin) {
                case 0: {
                    redirect('/login');
                } break;

                case 1: {
                    redirect('/admin/users_list');
                }
            }
        }

    }

    public function generate_id($admin) {
        $pre = $admin ? 'ADMIN-' : 'USER-';
        $number = $this->User_model->get_last_user_id($admin)->id;
        $last_id_number = explode('-', $number);
        $last_number = intval($last_id_number[1]);

        if($number) {
            return $pre . str_pad(($last_number + 1), 4, '0', STR_PAD_LEFT);
        } else {
            return $pre . '0001';
        }
    }
}