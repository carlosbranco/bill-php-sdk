<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include  '../vendor/autoload.php';
use EpicBit\BillPhpSdk\Api;

$api = new Api($mode = "demo");
$api->setlog(true);

$user = json_decode($api->getToken(['email' => "johndoe@example.com", 'password' => 'XXXXX']));

$api->setToken($user->api_token);



