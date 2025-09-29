<?php 
    declare(strict_types=1);

    namespace App\Models;

    class User{
        public ?int $id =null;
        public string $username;
        public string $password;
        public ?string $role= 'user';
        public ?\DateTime $createdAt = null;

        public function __construct(array $data = []){
            $this->id = $data['UserID'] ?? null; 
            $this->username = $data['Username'] ?? '';
            $this->password = $data['Password'] ?? '';
            $this->role = $data['Role'] ?? 'user';
            $this->createdAt = isset($data['CreatedAt']) ? new \DateTime($data['CreatedAt']) : null;
        }

        public function toArray() : array{
            return [
                'id' => $this->id,
                'username' => $this->username,
                'role' => $this->role,
                'created_at' => $this->createdAt?->format('c'),
            ];
        }
    }
?>