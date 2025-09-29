<?php 
    namespace App\Core;

    class Controller {
        protected function requestJson(){
            return json_decode(file_get_contents('php://input'), true);
        }
    }
?>