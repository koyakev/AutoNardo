<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Car_model');
        $this->load->model('Payment_model');
        $this->load->model('Booking_model');
    }

    public function index() {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            $data['title'] = "Admin Dashboard";
            $data['users'] = $this->User_model->get_users()['count'];
            $data['cars'] = $this->Car_model->get_cars()['count'];
            $data['yearly'] = $this->Payment_model->get_yearly_sales();
            $data['monthly'] = $this->Payment_model->get_monthly_sales();
            $data['car_portions'] = $this->Payment_model->get_car_bookings();
            $data['ongoing_bookings'] = $this->Booking_model->get_ongoing_bookings();
            $data['upcoming_bookings'] = $this->Booking_model->get_upcoming_bookings();
            $data['available_cars'] = $this->Car_model->get_available_cars();
            $data['user_count'] = $this->User_model->get_users_count();

            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar');
            $this->load->view('admin/dashboard', $data);
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function login() {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            redirect('admin/');
        } else {
            $data['title'] = "Admin Login";

            $this->load->view('admin/header', $data);
            $this->load->view('admin/login');
            $this->load->view('admin/footer');
        }
    }

    public function cars_list() {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            $data['title'] = "Car List";
            $data['cars'] = $this->Car_model->get_cars()['cars'];

            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar');
            $this->load->view('admin/cars_list', $data);
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function cars_add() {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            $data['title'] = "Add Car";
            
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar');
            $this->load->view('admin/cars_add');
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function cars_store() {
        $car_type = $this->input->post('car_type');
        $brand = $this->input->post('make');
        $model = $this->input->post('model');
        $transmission = $this->input->post('transmission');
        $plate_number = $this->input->post('plate_number');
        $rate = $this->input->post('rate');

        $id = strtoupper($brand[0]) . "-" . strtoupper(str_replace(" ", "_", $model)) . "-" . $transmission[0] . "-" . $plate_number;

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
            'is_available' => 1,
            'image' => $upload_data['file_name'],
            'created_at' => date('Y:m:d H:i:s')
        ];

        $insert = $this->Car_model->store_car($data);

        redirect('admin/cars_list');
    }

    public function car_update($id) {
        $car = $this->Car_model->get_car($id);

        if (!empty($_FILES['photo']['name'])) {
            if(FCPATH . 'uploads/' . $car['image'])
                unlink(FCPATH . 'uploads/' . $car['image']);

            $new_id = strtoupper($this->input->post('brand')[0]) . "-" . strtoupper(str_replace(" ", "_", $this->input->post('model'))) . "-" . $this->input->post('transmission')[0] . '-' . $this->input->post('plate_number');

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
                'id' => $new_id,
                'plate_number' => $this->input->post('plate_number'),
                'rental_price_per_day' => $this->input->post('rate'),
                'updated_at' => date('Y:m:d H:i:s'),
                'image' => $upload_data['file_name']
            ];

            $car_update = $this->Car_model->update_car($id, $data);
            $this->session->set_flashdata('message', $car_update);
            redirect('/admin/car_view/' . $id);
        } else {
            $new_id = strtoupper($this->input->post('brand')[0]) . "-" . strtoupper(str_replace(" ", "_", $this->input->post('model'))) . "-" . $this->input->post('transmission')[0] . '-' . $this->input->post('plate_number');

            $data = [
                'id' => $new_id,
                'plate_number' => $this->input->post('plate_number'),
                'rental_price_per_day' => $this->input->post('rate'),
                'updated_at' => date('Y:m:d H:i:s'),
                // 'image' => $upload_data['file_name']
            ];

            $car_update = $this->Car_model->update_car($id, $data);
            $this->session->set_flashdata('message', $car_update);
            redirect('/admin/car_view/' . $new_id);
        }
    }

    public function car_delete($id) {
        $car_delete = $this->Car_model->delete_car($id);

        $this->session->set_flashdata('message', $car_delete);
        redirect('admin/cars_list');
    }

    public function car_view($id) {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            $data['title'] = $id;
            $data['car'] = $this->Car_model->get_car($id);
            
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar');
            $this->load->view('admin/car_view', $data);
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function users_list() {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            $data['title'] = 'User List';
            $data['users'] = $this->User_model->get_users()['users'];
    
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar');
            $this->load->view('admin/users_list', $data);
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function user_view($id) {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            $data['title'] = $id;
            $data['user'] = $this->User_model->get_user($id);
    
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar');
            $this->load->view('admin/user_view', $data);
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function sales_view() {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            $data['title'] = "Yearly Sales";
            $data['sales'] = $this->Payment_model->get_booking_payments();

            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar');
            $this->load->view('admin/sales_view');
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function get_transaction() {
        $id = $this->input->post('id');
        $transaction = $this->Payment_model->get_booking_payment_by_id($id);

        echo json_encode($transaction);
    }

    public function users_add() {
        if($this->session->userdata('user') && $this->session->userdata('isAdmin') == 1) {
            $data['title'] = "Create User";
    
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar');
            $this->load->view('admin/users_add');
            $this->load->view('admin/footer');
        } else {
            redirect('admin/login');
        }
    }

    public function set_active($id) {
        $user = $this->User_model->set_active($id);

        if($user) {
            $this->session->set_flashdata('message', $user['message']);
            redirect('admin/users_list');
        } else {
            $this->session->set_flashdata('message', 'Error!');
            redirect('admin/users_list');
        }
    }
}