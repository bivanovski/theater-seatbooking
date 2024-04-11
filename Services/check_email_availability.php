<?php

require_once('../Users/User.php');

use Users\User as User;

$user = new User();

$user->setEmail($_POST['email']);

$response = [];

if($user->getByEmail($user->getEmail())) {
    $response['status'] = 'taken';
} else {
    $response['status'] = 'available';
}

header('Content-Type: application/json');
echo json_encode($response);
