<?php

namespace HenryEticom\PHPJWT;

class JWT {

    public static function encode(array $headers, array $payload, string $secret)
    {
        $headers_encoded = base64_encode(json_encode($headers));
    
        $payload_encoded = base64_encode(json_encode($payload));
    
        $signature = hash_hmac('sha256', "$headers_encoded.$payload_encoded", $secret, true);
    
        $signature_encoded = base64_encode($signature);
    
        $jwt = "$headers_encoded.$payload_encoded.$signature_encoded";
    
        return $jwt;
    }

    public static function decode($jwt, $secret)
    {
        $tokenParts = explode('.', $jwt);

        //Decode header and payload
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature_provided = $tokenParts[2];

        //check expiration time
        $expiration = json_decode($payload)->exp;
        
        $is_token_expired = ($expiration - time()) < 0;

        //build a signature based on the header and payload
        $base64_header = base64_encode($header);
        $base64_payload = base64_encode($payload);
        $signature = hash_hmac('sha256', $base64_header . ".". $base64_payload, $secret, true);
        $base64_signature = base64_encode($signature);

        //verify the signature
        $is_signature_valid = ($base64_signature === $signature_provided);

        if($is_token_expired || !$is_signature_valid){
            return FALSE;
        }else{
            return array(
                json_decode($payload)
            );
        }
    }
}
