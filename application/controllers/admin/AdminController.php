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
}