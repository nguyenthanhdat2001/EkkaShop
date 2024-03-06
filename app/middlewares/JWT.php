<?php
class JWT
{
    private static $secretKey = 'Vungtan2004';
    static function createJWT($payload, $time)
    {
        // (3 * 24 * 3600) 3 day
        $expiration = time() + $time;
        $header = [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ];
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($header)));

        // Payload
        $payload['exp'] = $expiration;
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));

        // Signature
        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, self::$secretKey, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        //result
        return $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;
    }

    static function verifyJWT($jwt)
    {
        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = explode('.', $jwt);

        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, self::$secretKey, true);
        $base64UrlSignatureComputed = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        if ($base64UrlSignature === $base64UrlSignatureComputed) {
            $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $base64UrlPayload)), true);

            // check exprired
            if (isset($payload['exp']) && $payload['exp'] < time()) {
                return ['valid' => false, 'error' => 'JWT hết hạn'];
            } else {
                return ['valid' => true, 'payload' => $payload];
            }
        } else {
            return ['valid' => false, 'error' => 'JWT không hợp lệ'];
        }
    }
}
