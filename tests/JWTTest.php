<?php

namespace HenryEticom\PHPJWT;


use PHPUnit\Framework\TestCase;
use HenryEticom\PHPJWT\JWT;

class JWTTest extends TestCase

{
    public function testJWTEncode()
    {

        $payload = array(
            'sub'       => 1,
            'name'      => 'Test',
            'exp' => (time() + (60 * 60))
        );

        $key = 'secret-key';

        $encoded = JWT::encode(['message' => 'abc'], $payload, $key);

        $decoded = (array) JWT::decode($encoded, $key);

        $expected =  array(
            (object) array(
            'sub' => 1,
            'name' => 'Test',
            'exp' => $payload['exp']
            )
        );

        $this->assertEquals($expected, $decoded);
    }
}