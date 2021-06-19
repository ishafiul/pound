<?php
require_once 'config.php';

if (isset($_POST['pay'])) {
    $fname =$_POST['fname'];
    $lname=$_POST['l_name'];
    $email=$_POST['mail'];
    $phone=$_POST['phone'];
    $zip=$_POST['zip'];
    $address=$_POST['address'];
    $user_id = '';
    if (!empty($_POST['user_id'])){
        $user_id = $_POST['user_id'];
    }
    $product_ids=$_POST['p_ids'];
    $insert = $db->query("INSERT INTO payments(payment_id, payer_id, payer_email, amount, currency, payment_status,fname,lname,mail,phone,zip,address,user_id,products_ids) VALUES('', '', '', '', '', 'pending','$fname','$lname','$email','$phone','$zip','$address','$user_id','$product_ids')");
    $querry = "SELECT id FROM payments ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($db,$querry);
    $row = mysqli_fetch_assoc($result);
    $id= $row['id'];
    try {
        $response = $gateway->purchase(array(
            'amount' => $_POST['amount'],
            'items' => array(
                array(
                    'name' => '',
                    'price' => $_POST['amount'],
                    'description' => $id,
                    'quantity' => 1
                ),
            ),
            'currency' => PAYPAL_CURRENCY,
            'returnUrl' => PAYPAL_RETURN_URL,
            'cancelUrl' => PAYPAL_CANCEL_URL,
        ))->send();

        if ($response->isRedirect()) {
            $response->redirect(); // this will automatically forward the customer
        } else {
            // not successful
            echo $response->getMessage();
        }
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

