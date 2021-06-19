<?php
require_once "paypalsdk/vendor/autoload.php";
require_once "envsdk/vendor/autoload.php";

use Omnipay\Omnipay;
use Dotenv\Dotenv;

$dotenv=Dotenv::createImmutable(__DIR__);
$dotenv->load();
$MYSQL_DB_USERNAME = $_ENV['MYSQL_DB_USERNAME'];
$MYSQL_DB_PASSWORD = $_ENV['MYSQL_DB_PASSWORD'];
$MYSQL_DB_NAME = $_ENV['MYSQL_DB_NAME'];

define('CLIENT_ID', $_ENV['PAYPAL_CLIENT_ID']);//AZoUYiR4IFRqYmOoJWbMrZMKHcgUtGrIV0r4HccMJfp0I8eCFs75R_J2_uUYElEUa2nhIOYtUssWM0dL
define('CLIENT_SECRET', $_ENV['PAYPAL_CLIENT_SECRET']);//EFTB2dAjU0sZj65f4ZwgHbCqy9749Y6O6ylcjIcuG0jVatFvzRssPF_EkxnjqJk6MWhkpLyK3Jh-jS4F


define('PAYPAL_RETURN_URL', 'http://localhost/pound/public/payment/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/pound/public/payment/cancel.php');
define('PAYPAL_CURRENCY', 'USD'); // set your currency here

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'pound');

if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live
/*buis
Email ID:
sb-t47pfz6514006@business.example.com
System Generated Password:
i.w}*8rS

Email ID:
sb-gmw156513490@personal.example.com
System Generated Password:
u?^DGZy5
*/
