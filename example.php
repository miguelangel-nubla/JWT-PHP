<?php

/*
 * Copyright(c)2011 Miguel Angel Nubla Ruiz (miguelangel.nubla@gmail.com). All rights reserved
 */

require_once "JWT.php";

$header = '{"typ":"JWT",
 "alg":"HS256"}';

$payload = '{"iss":"joe",
 "exp":1300819380,
 "http://example.com/is_root":true}';

$key = '46196053844814367107123';

$JWT = new JWT;

$token = $JWT->encode($header, $payload, $key);
$json = $JWT->decode($token, $key);

echo 'Header: '.$header."\n\n";
echo 'Payload: '.$payload."\n\n";
echo 'HMAC Key: '.$key."\n\n";

echo 'JSON Web Token: '.$token."\n\n";
echo 'JWT Decoded: '.$json."\n\n";

?>
