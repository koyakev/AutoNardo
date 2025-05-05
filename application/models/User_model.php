<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_users_count() {
        $count = $this->db->count_all('users');
        return $count;
    }

    public function login_user($email, $password) {
        $user = $this->db->where('email', $email)->get('users')->row();

        // echo password_verify($password, $user->password);
        if($user) {
            if(password_verify($password, $user->password)) {
                return ['status' => 'success', 'data' => $user];
            } else {
                return ['status' => 'failed', 'data' => 'Incorrect credentials'];
            }
        } else {
            return ['status' => 'failed', 'data' => 'User not found'];
        }
    }
}