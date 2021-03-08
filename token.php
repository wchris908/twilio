<?php
    require_once './vendor/autoload.php';
    use Twilio\Jwt\AccessToken;
    use Twilio\Jwt\ClientToken;
    use Twilio\Jwt\Grants\VoiceGrant;

    $accountSid = 'AC7a6f10c2ff7ebfc40287a34b5301125b';
    $authToken = '758ee094787a29726cf18a0790adedd3';
    $appSid = 'AP3045b943a034d70a6359438f759e729d';
    $signingKeySid = 'SKa6b091674395c3f4f682cafc4cadd285';
    $secret = 'Z0Jy0SxUKY0g5agpsxhtWwcEELjztrED';

    $accessToken = new ClientToken($accountSid, $authToken);
    // $accessToken->allowClientOutgoing($appSid);

    // $accessToken = new AccessToken($accountSid, $signingKeySid, $secret);
    // $accessToken->setIdentity('customer');

    $voiceGrant = new VoiceGrant();
    $voiceGrant->setOutgoingApplicationSid($appSid);
    $voiceGrant->setIncomingAllow(true);

    // $accessToken->addGrant($voiceGrant);
    // $token = $accessToken->toJWT();

    $token = $accessToken->generateToken();
    echo json_encode($token);
?>