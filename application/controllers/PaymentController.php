<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_model');
        $this->load->model('Booking_model');
    }


    public function webhook()
    {
        // Read raw input
        $input = file_get_contents('php://input');
        $payload = json_decode($input, true);

        // Validate payload
        if (!$payload || !isset($payload['data']['type'])) {
            log_message('error', 'Invalid webhook payload');
            show_error('Invalid payload', 400);
            return;
        }

        $eventType = $payload['data']['type'];

        if ($eventType === 'payment_intent') {
            $transactionId = $payload['data']['id'];
            $status = $payload['data']['attributes']['status'];

            // Optional: log webhook
            log_message('debug', "Received payment_intent webhook: $transactionId - Status: $status");

            // Update payment record
            $updated = $this->Payment_model->update_status_by_reference($transactionId, [
                'transaction_status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($updated) {
                // Optionally update the booking status if payment is successful
                if ($status === 'succeeded') {
                    $payment = $this->Payment_model->get_payment_by_reference($transactionId);
                    if ($payment && isset($payment['booking_id'])) {
                        $this->Booking_model->update_booking_status($payment['booking_id'], 'confirmed');
                    }
                }

                echo json_encode(['status' => 'received']);
                return;
            } else {
                log_message('error', "No payment found with transaction_reference: $transactionId");
                show_error('Payment not found', 404);
                return;
            }
        }

        show_error('Unsupported event type', 400);
    }
}
