<?php 
    declare(strict_types=1);

    namespace App\Core;

    use PDO;
    use PDOException;

    class Database{
        private static ?PDO $instance = null;

        private function __construct(){}

        public static function getConnection() : PDO{
            if(self::$instance !== null) {
                return self::$instance;
            }

            $host = config::get('DB_HOST', '123.0.0.1');
            $port = config::get('DB_PORT', '3306');
            $db = config::get('DB_NAME', 'event_db');
            $user = config::get('DB_USER', 'root');
            $pass = config::get('DB_PASS', 'password');

            $dsn = "mysql:host={$host};
                    port={$port};
                    dbname={$db};
                    charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES      => false,
                PDO::ATTR_PERSISTENT            => false,
            ];

            try{
                self::$instance = new PDO($dsn, $user, $pass, $options);
            }
            catch(PDOException $e) {
                http_response_code(500);
                error_log('DB Connection error:' . $e->getMessage());
                echo json_encode(['error' => 'Internal Server Error']);
                exit;
            }

            return self::$instance;
        }
    }
?>