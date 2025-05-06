<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookingController extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function book_rental() {
        if($this->session->userdata('user')) {

        } else {
            redirect('/login');
        }
    }
}