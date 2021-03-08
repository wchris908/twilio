<?php
require_once './vendor/autoload.php';

use Twilio\Rest\Client;

$sid = 'AC7a6f10c2ff7ebfc40287a34b5301125b';
$token = '758ee094787a29726cf18a0790adedd3';
$tonumber = $_POST['number'];
$message = $_POST['message'];
$client = new Client($sid, $token);
$message = $client->messages->create(
    $tonumber, [
        "body" => $message,
        "from" => '+15618677744',
        "mediaUrl" => "https://gph.to/2L6cJxv"
    ]
);
print($message->sid);
?>