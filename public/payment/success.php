<?php
require_once 'config.php';

// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $response = $transaction->send();

    if ($response->isSuccessful()) {
        // The customer has successfully paid.
        $arr_body = $response->getData();

        $payment_id = $arr_body['id'];
        $payer_id = $arr_body['payer']['payer_info']['payer_id'];
        $payer_email = $arr_body['payer']['payer_info']['email'];
        $amount = $arr_body['transactions'][0]['amount']['total'];
        $currency = PAYPAL_CURRENCY;
        $payment_status = $arr_body['state'];
        $id = $arr_body['transactions'][0]['item_list']['items'][0]['description'];

        // Insert transaction data into the database
        $isPaymentExist = $db->query("SELECT * FROM payments WHERE payment_id = '".$payment_id."'");

        if($isPaymentExist->num_rows == 0) {
            $insert = $db->query("UPDATE payments SET payment_id='$payment_id', payer_id='$payer_id', payer_email='$payer_email', amount='$amount', currency='$currency', payment_status='$payment_status' where id='$id'");
        }
        header('LOCATION: http://localhost/pound/cart/success?id='.$payment_id);
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declined';
}