<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;
use App\Core\Config;

class AuthService
{
    private UserRepository $repo;
    private string $jwtSecret;
    private int $jwtExp;

    public function __construct()
    {
        $this->repo = new UserRepository();
        $this->jwtSecret = (string)Config::get('JWT_SECRET', '');
        $this->jwtExp = (int)Config::get('JWT_EXP', 3600);
    }

    public function register(array $userData, array $personInfoData): ?User
    {

        $userData['username'] = $personInfoData['Email'];

        if ($this->repo->findByUsername($userData['username'])) {
            return null; // already exists
        }

        $userData['password'] = password_hash(
            $userData['password'],
            PASSWORD_ARGON2ID
        ) ?: password_hash($userData['password'], PASSWORD_BCRYPT);

        return $this->repo->create($userData, $personInfoData);
    }


    public function authenticate(string $username, string $password): ?string
    {
        $user = $this->repo->findByUsername($username);
        if (!$user) return null;

        if (!password_verify($password, $user->password)) {
            return null;
        }

        $now = time();
        $payload = [
            'iat' => $now,
            'nbf' => $now,
            'exp' => $now + $this->jwtExp,
            'iss' => Config::get('JWT_ISS'),
            'aud' => Config::get('JWT_AUD'),
            'sub' => (string)$user->id,
            'username' => $user->username,
            'role' => $user->role,
        ];

        return JWT::encode($payload, $this->jwtSecret, 'HS256');
    }

    public function verifyToken(string $token): ?array
    {
        try {
            $decoded = (array) JWT::decode($token, new Key($this->jwtSecret, 'HS256'));
            return $decoded;
        } catch (\Throwable $e) {
            error_log('JWT verify failed: ' . $e->getMessage());
            return null;
        }
    }

    public function getUserFromToken(string $token): ?User
    {
        $payload = $this->verifyToken($token);
        if (!$payload || !isset($payload['sub'])) return null;
        return $this->repo->findById((int)$payload['sub']);
    }
}
