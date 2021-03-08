<?php
require_once './vendor/autoload.php';

use Twilio\Rest\Client;

$sid = 'AC7a6f10c2ff7ebfc40287a34b5301125b';
$token = '758ee094787a29726cf18a0790adedd3';
$tonumber = $_POST['number'];
$client = new Client($sid, $token);

$call = $client->calls->create(
    $tonumber,
    '+18144581566',
    ["url" => "https://handler.twilio.com/twiml/EHc2c95b74a072bf9d433d2e8f71463156"]
);
echo $call->sid;

header("location: index.php");
?>

