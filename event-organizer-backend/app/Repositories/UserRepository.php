<?php 
    declare(strict_types=1);

    namespace App\Repositories;

    use App\Core\Database;
    use App\Models\User;
use Exception;
use PDO;

    class UserRepository{
        private PDO $db;

        public function __construct()
        {
            $this->db = Database::getConnection();        
        }

        public function findByUsername(string $username): ?User
        {
            $stmt = $this->db->prepare('SELECT UserID, Username, Password, Role, CreatedAt FROM users WHERE Username = :Username LIMIT 1');
            $stmt->execute(['Username' => $username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? new User($row) : null;
        
        }
        public function findByID(int $id): ?User
        {
            $stmt = $this->db->prepare('SELECT UserID, Username, Password, Role, CreatedAt FROM users WHERE UserID= :UserID LIMIT 1');
            $stmt->execute(['UserID' => $id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? new User($row) : null;
        }

        public function create(array $userData, array $personInfoData) : User
        {
            $password = $userData['password'];

            if (strlen($password) < 6){
                throw new Exception("Password must be at least 6 characters long.");
            }
            if (!preg_match('/[A-Z]/', $password)) {
                throw new Exception("Password must contain at least one uppercase letter.");
            }
            if (!preg_match('/[0-9]/', $password)) {
                throw new Exception("Password must contain at least one number.");
            }
            
            try{
                $this->db->beginTransaction();

                $check = $this->db->prepare("SELECT UserID FROM users WHERE username = :username LIMIT 1");
                $check->execute([':username' => $userData['username']]);
                if($check->fetch()) {
                    throw new Exception("Username already exists.");
                }

                //Insert User
                $stmt = $this->db->prepare("
                INSERT INTO users (Username, Password, Role, CreatedAt)
                VALUES(:Username, :Password, :Role, NOW())
                ");

                $stmt->execute([
                    ':Username' => $userData['username'],
                    ':Password' => $password,
                    ':Role'     => $userData['role'] ?? 'User'
                ]); 

                $UserID = (int) $this->db->lastInsertId();

                $stmt = $this->db->prepare("
                    INSERT INTO personalinfo(UserID, Firstname, Middlename, Lastname, Email, PhoneNumber)
                    VALUES (:UserID, :Firstname, :Middlename, :Lastname, :Email, :PhoneNumber)
                ");

                $stmt->execute([
                    ':UserID'       => $UserID,
                    ':Firstname'    => $personInfoData['Firstname'], 
                    ':Middlename'   => $personInfoData['Middlename'], 
                    ':Lastname'     => $personInfoData['Lastname'], 
                    ':Email'        => $personInfoData['Email'], 
                    ':PhoneNumber'  => $personInfoData['PhoneNumber'], 
                ]);

                $this->db->commit();
                return $this->findByID($UserID);
            
            } catch (Exception $e) {
                $this->db->rollBack();
                throw $e;
            }
        
            
        }
        
     
    }
?>