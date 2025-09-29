<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Services\AuthService;

class AuthMiddleware
{
    public function __invoke(array $params = []): mixed
    {
        $hdr = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        if (!$hdr || !str_starts_with($hdr, 'Bearer ')) {
            http_response_code(401);
            echo json_encode(['error' => 'Missing token']);
            return false;
        }

        $token = trim(substr($hdr, 7));
        $auth = new AuthService();
        $user = $auth->getUserFromToken($token);
        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid or expired token']);
            return false;
        }

        // return array that will be merged into route params
        return ['user' => $user];
    }
}
