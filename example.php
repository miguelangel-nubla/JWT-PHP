<?php

/*
 * Copyright(c)2011 Miguel Angel Nubla Ruiz (miguelangel.nubla@gmail.com). All rights reserved
 */

$header = '{"typ":"JWT",
 "alg":"HS256"}';

$payload = '{"iss":"joe",
 "exp":1300819380,
 "http://example.com/is_root":true}';

$key = '46196053844814367107123';

$JWT = new JWT;
$token = $JWT->token($header, $payload, $key);

echo 'Header: '.$header."\n\n";
echo 'Payload: '.$payload."\n\n";
echo 'HMAC Key: '.$key."\n\n";

echo 'JSON Web Token: '.$token."\n\n";

?>
