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
}