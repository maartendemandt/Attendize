<?php

namespace Services\PaymentGateway;

class Mollie
{

    CONST GATEWAY_NAME = 'Mollie';

    private $transaction_data;

    private $gateway;

    private $extra_params = ['transaction_id'];

    public function __construct($gateway)
    {
        $this->gateway = $gateway;
        $this->options = [];
    }

    private function createTransactionData($order_total, $order_email, $event)
    {
        $returnUrl = 'https://neetteredde.nl/e/'.$event->id.'/checkout/success';

        $this->transaction_data = [
            'amount' => $order_total,
            'currency' => $event->currency->code,
            'description' => 'Bestelling voor: ' . $order_email,
            'billingEmail' => $order_email,
            'returnUrl' => $returnUrl
        ];

        return $this->transaction_data;
    }

    public function startTransaction($order_total, $order_email, $event)
    {

        $this->createTransactionData($order_total, $order_email, $event);
        $transaction = $this->gateway->purchase($this->transaction_data);
        $response = $transaction->send();

        return $response;
    }   

    public function getTransactionData() {
        return $this->transaction_data;
    }

    public function extractRequestParameters($request) {
        foreach ($this->extra_params as $param) {
            if (!empty($request->get($param))) {
                $this->options[$param] = $request->get($param);
            }
        }
    }

    public function completeTransaction($data = null) {
        $response = $this->gateway->completePurchase($data)->send();

        return $response;
    }

    public function getAdditionalData($response) { 
        $additionalData['transactionReference'] = $response->getTransactionReference();
        return $additionalData;
    }

    public function storeAdditionalData() {
        return true;
    }

    public function refundTransaction($order, $refund_amount, $refund_application_fee) {

        // $request = $this->gateway->refund([
        //     'transactionReference' => $order->transaction_id,
        //     'amount'               => $refund_amount,
        //     'currency'             => $order->event->currency->code
        // ]);

        // $response = $request->send();

        // if ($response->isSuccessful()) {
        //     $refundResponse['successful'] = true;
        // } else {
        //     $refundResponse['successful'] = false;
        //     $refundResponse['error_message'] = $response->getMessage();
        // }

        // return $refundResponse;

        $refundResponse['successful'] = true;

        return $refundResponse;
    }

}