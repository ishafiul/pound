<?php

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
$f =APPROOT;
define('HELPERS', $f.'/helpers');
// URL Root
define('URLROOT', 'http://localhost/pound');
define('DOCROOT', $_SERVER['DOCUMENT_ROOT'].'/pound');
// Site Name
define('SITENAME', 'SITE NAME');
// App Version
define('APPVERSION', '1.0.0');

//composer autoload
require_once APPROOT.'/helpers/vendor/autoload.php';
//dont env config
use Dotenv\Dotenv;
$dotenv=Dotenv::createImmutable(DOCROOT);//DOCROOT = your env file link
$dotenv->load();

/*
 * //paypal config
 *
 * make $gateway variable global for functions
 * */
use Omnipay\Omnipay;
$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId($_ENV['PAYPAL_CLIENT_ID']);
$gateway->setSecret($_ENV['PAYPAL_CLIENT_SECRET']);
$gateway->setTestMode(true); //make false for live
