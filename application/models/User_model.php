<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_users() {
        $users = $this->db->get('users');
        return [
            'users' => $users->result_array(),
            'count' => $users->num_rows()
        ];
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

    public function register_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user($id) {
        return $this->db->where('id', $id)->get('users')->row_array();
    }

    public function get_last_user_id($is_admin) {
        return $this->db->where('is_admin', $is_admin)->order_by('created_at', 'desc')->limit(1)->get('users')->row();
    }

    public function update_user($id, $data) {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function get_users_count() {
        return $this->db->get('users')->num_rows();
    }

    public function set_active($id) {
        $data = $this->db->where('id', $id)->get('users')->row_array();
        
        if($data['is_active'] == 1) {
            $this->db->where('id', $id)->update('users', ['is_active' => 0]);
            return [
                'message' => 'User ' . $id . ' is now inactive!'
            ];
        } else {
            $this->db->where('id', $id)->update('users', ['is_active' => 1]);
            return [
                'message' => 'User ' . $id . ' is now active again!'
            ];
        }
    }
}