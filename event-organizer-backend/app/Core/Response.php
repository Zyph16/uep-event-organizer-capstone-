<?php 
    namespace App\Core;

    class Response {
        public static function json($payload, $status=200){
            http_response_code($status);
            header('Content-Type: application/json');
            echo json_encode($payload);
            exit;
        }
    }
?>