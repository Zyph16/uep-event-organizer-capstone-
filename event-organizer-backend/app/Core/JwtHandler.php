<?php 

    namespace Acer\EventOrganizerBackend\Core;

    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    
    class JwtHandler{
       private static string $secret;

       public static function init(): void {
        self::$secret = $_ENV['JWT_SECRET'];
       }

       public static function encode(array $payload, int $expiry = 3600): string {
        $issuedAt = time();
        $payload['iat'] = $issuedAt;
        $payload['exp'] = $issuedAt + $expiry;
        return JWT::encode($payload, self::$secret, 'HS256');
       }

       public static function decode(string $token): object {
        return JWT::decode($token, new Key(self::$secret, 'HS256'));
       }
    } 
?>