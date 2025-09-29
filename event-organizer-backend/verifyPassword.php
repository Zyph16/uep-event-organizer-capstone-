<?php 
    $hash = '$2y$12$qkLg195ZWHyPIJiz5d3RQOUeYH0iTj1E1fVcqG7w6hix6A3CoTY3a';
    $password = 'admin';

if (password_verify($password, $hash)) {
    echo "Password OK";
} else {
    echo "Password FAIL";
}
?>