<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Core\Config;
use Exception;  

class AuthController
{
    private AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function register($rawBody = null) {
    try {
            // Decode raw JSON from php://input if Router didn't pass it
            $request = $rawBody;
            if ($request === null || !is_array($request)) {
                $input = file_get_contents("php://input");
                $request = json_decode($input, true) ?? [];
            }

            // Extract User fields
            $userData = [
                'username' => $request['username'] ?? null,
                'password' => $request['password'] ?? null,
                'role'     => $request['role'] ?? 'User'
            ];

            // Extract Personal Info fields
            $personInfoData = [
                'Firstname'   => $request['first_name'] ?? null,
                'Middlename'  => $request['middle_name'] ?? null,
                'Lastname'    => $request['last_name'] ?? null,
                'Email'       => $request['email'] ?? null,
                'PhoneNumber' => $request['phone'] ?? null,
            
            ];

        $result = $this->auth->register($userData, $personInfoData);

        if (!$result) {
            http_response_code(400);
            echo json_encode([
                "success" => false,
                "message" => "Registration failed"
            ]);
            return;
        }

        echo json_encode([
            "success" => true,
            "message" => "Registration successful",
            "data"    => $result
        ]);
        } catch (Exception $e) {
            http_response_code(400);    
            echo json_encode([
                "success" => false,
                "message" => $e->getMessage()
            ]);
        }
    }


    public function login(array $body): void
    {
        $username = trim($body['username']);
        $password = $body['password'] ?? '';

        if (!$username || !$password) {
            http_response_code(422);
            echo json_encode(['error' => 'Invalid credentials']);
            return;
        }

        $token = $this->auth->authenticate($username, $password);
        if (!$token) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid username/password']);
            return;
        }

        echo json_encode([
                            'access_token' => $token, 
                            'token_type' => 'bearer', 
                            'expires_in' => (int)Config::get('JWT_EXP', 3600)]);
    }

    public function me(array $params): void
    {
        // $params expected to include 'user' set by middleware
        $user = $params['user'] ?? null;
        if (!$user) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        echo json_encode(['user' => $user->toArray()]);
    }
}
