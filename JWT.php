<?php

/*
 * Copyright(c)2011 Miguel Angel Nubla Ruiz (miguelangel.nubla@gmail.com). All rights reserved
 */

class JWT {
    private $alg;
    private $hash;
    private $data;
    
    private function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
    
    public function encode($header, $payload, $key) {
        $this->data = $this->base64url_encode($header) . '.' . $this->base64url_encode($payload);
        return $this->data.'.'.$this->JWS($header, $key);
    }
    
    public function decode($token, $key) {
        list($header, $payload, $signature) = explode('.', $token);
        $this->data = $header . '.' . $payload;
        if ($signature == $this->JWS($this->base64url_decode($header), $key)) {
            return $this->base64url_decode($payload);
        }
        exit('Invalid Signature');
    }
    
    private function setAlgorithm($algorithm) {
        switch ($algorithm[0]) {
            case n:
                $this->alg = 'plaintext';
                break;
            case H:
                $this->alg = 'HMAC';
                break;
            // By now, the only native is HMAC
            /* 
            case R:
                $this->alg = 'RSA';
                break;
            case E:
                $this->alg = 'ECDSA';
                break;
            */
            default: exit("RSA and ECDSA not implemented yet!");
        }
        switch ($algorithm[2]) {
            case a:
                $this->alg = 'plaintext';
                break;
            case 2:
                $hash = 'sha256';
                break;
            case 3:
                $hash = 'sha384';
                break;
            case 5:
                $hash = 'sha512';
                break;
        }
        if (in_array($hash, hash_algos())) $this->hash = $hash;
    }

    private function JWS($header, $key) {
        $json = json_decode($header);
        $this->setAlgorithm($json->alg);
        if ($this->alg == 'plaintext') {
            return '';
        }
        return $this->base64url_encode(hash_hmac($this->hash, $this->data, $key, true));
    }
}

?>