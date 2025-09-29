<?php 
    declare(strict_types=1);

    namespace App\Core;

    use Dotenv\Dotenv;

    class Config{
        private static array $data = [];

        public static function load(string $basePath): void{
            
            $dotenv = Dotenv::createImmutable($basePath);
            $dotenv->safeLoad();
            self::$data = $_ENV;
        }

        public static function get(string $key, $default = null){
            return $_ENV[$key] ?? $default;
        }
    }
?>