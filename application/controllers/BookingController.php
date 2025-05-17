<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BookingController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_model');
		$this->load->model('Car_model');
		$this->load->model('Payment_model');
		$this->load->library('form_validation');
	}

	public function book_rental()
	{
		$user_id = $this->input->post('user_id');
		$car_id = $this->input->post('car_id');
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$status = $this->input->post('status');

		// Prepare data for insertion
		$data = [
			'user_id' => $user_id,
			'car_id' => $car_id,
			'start_date' => $start_date,
			'end_date' => $end_date,
			'status' => $status,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		];

		// Save booking data
		$inserted = $this->Booking_model->create_booking($data);
		$booking_id = $this->db->insert_id(); // Get the last inserted booking ID

		if (!$inserted) {
			$this->session->set_flashdata('message', 'Booking failed. Please try again.');
			redirect('/car_view/' . $car_id);
			return;
		}

		// Fetch car details
		$car = $this->Car_model->get_car($car_id);
		if (!$car) {
			$this->session->set_flashdata('message', 'Car not found.');
			redirect('/car_view/' . $car_id);
			return;
		}

		// Calculate rental duration in days
		$date1 = new DateTime($start_date);
		$date2 = new DateTime($end_date);
		$interval = $date1->diff($date2);
		$rental_days = $interval->days ?: 1; // fallback to 1 if 0

		// Prepare line items for PayMongo
		$lineItems[] = [
			'amount' => intval(round($car['rental_price_per_day'] * 100)), // in centavos
			'currency' => 'PHP',
			'quantity' => $rental_days,
			'name' => $car['make'] . ' ' . $car['model']
		];

		// Static list of payment methods
		$paymentMethods = ['card', 'gcash', 'grab_pay', 'dob', 'billease', 'paymaya'];

		$payload = [
			'data' => [
				'attributes' => [
					'payment_method_types' => $paymentMethods,
					'cancel_url' => site_url('/car_view/' . $car_id),
					'success_url' => site_url('/rental-history'),
					'return_url' => base_url(),
					'billing_address_collection' => 'required',
					'send_email_receipt' => true,
					'line_items' => $lineItems,
				],
			],
		];

		$client = new \GuzzleHttp\Client();

		// Before the API call
		log_message('info', 'Payload for PayMongo: ' . json_encode($payload));

		try {
			$response = $client->post('https://api.paymongo.com/v1/checkout_sessions', [
				
				'headers' => [
					'Content-Type' => 'application/json',
					'accept' => 'application/json',
					'authorization' => 'Basic c2tfdGVzdF94RXBYSGFuRFloWGZWd1k1WHlYTlV0Qlk6',
				],
				'json' => $payload,
			]);

			// After the API call
			log_message('info', 'PayMongo response: ' . $response->getBody());

			$responseData = json_decode($response->getBody(), true);

			if (isset($responseData['data']['attributes']['checkout_url'])) {
				// Save to payments table
				$this->Payment_model->store([
					'user_id' => $user_id,
					'booking_id' => $booking_id,
					'amount' => $car['rental_price_per_day'] * $rental_days,
					'payment_method' => 'not_selected_yet',
					'transaction_status' => $responseData['data']['attributes']['payment_intent']['attributes']['status'],
					'transaction_date' => date('Y-m-d H:i:s'),
					'transaction_reference' => $responseData['data']['attributes']['payment_intent']['id'],
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
					'checkout_url' => $responseData['data']['attributes']['checkout_url'],
				]);

				// Redirect user to checkout page
				redirect($responseData['data']['attributes']['checkout_url']);
			} else {
				$this->session->set_flashdata('message', 'Checkout session failed.');
				redirect('/car_view/' . $car_id);
			}
		} catch (Exception $e) {
			log_message('error', 'Checkout session error: ' . $e->getMessage());
			$this->session->set_flashdata('message', 'Error creating payment session.');
			redirect('/car_view/' . $car_id);
		}
	}
}
