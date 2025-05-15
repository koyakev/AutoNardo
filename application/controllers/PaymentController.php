<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Add the ngrok header
		header('ngrok-skip-browser-warning: any-value');
		
		$this->load->model('Payment_model');
		$this->load->model('Booking_model');
	}


	public function webhook()
	{
		// Read raw input
		$input = file_get_contents('php://input');
		$payload = json_decode($input, true);

		// Log the entire payload for debugging
		log_message('debug', 'Received webhook payload: ' . print_r($payload, true));

		// Validate payload
		if (!$payload || !isset($payload['data']['type'])) {
			log_message('error', 'Invalid webhook payload');
			show_error('Invalid payload', 200);
			return;
		}

		$eventType = $payload['data']['attributes']['type'];

		if ($eventType) {
			$transactionId = $payload['data']['attributes']['data']['attributes']['payment_intent_id'];
			$status = $payload['data']['attributes']['data']['attributes']['status'];
			$payment_method= $payload['data']['attributes']['data']['attributes']['source']['type'];

			
			log_message('debug', "Received payment_intent webhook: $transactionId - Status: $status");

			// Update payment record
			$updated = $this->Payment_model->update_status_by_reference($transactionId, [
				'transaction_status' => $status,
				'payment_method' => $payment_method,
				'updated_at' => date('Y-m-d H:i:s')
			]);

			if ($updated) {
				// Optionally update the booking status if payment is successful
				if ($status) {
					$this->confirm_booking_by_transaction($transactionId);
					
				}

				echo json_encode(['status' => 'received']);
				return;
			} else {
				log_message('error', "No payment found with transaction_reference: $transactionId");
				show_error('Payment not found', 200);
				return;
			}
		}

		show_error('Unsupported event type', 200);
	}


	public function confirm_booking_by_transaction($transactionId)
	{
		// Get payment details by transaction ID
		$payment = $this->Payment_model->get_payment_by_reference($transactionId);

		if ($payment && isset($payment['booking_id'])) {
			// Update booking status to confirmed
			$this->Booking_model->update_booking_status($payment['booking_id'], 'confirmed');
		}

		// Always return 200 status
		http_response_code(200);
		echo json_encode(['status' => 'confirmed']);
	}
}
