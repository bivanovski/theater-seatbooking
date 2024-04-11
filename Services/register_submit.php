<?php

require_once('Users/User.php');

use Users\User as User;

$user = new User();
$user->setFirstName($_POST['firstname']);
$user->setLastName($_POST['lastname']);
$user->setPassword($_POST['password']);
$user->setEmail($_POST['email']);

$user->setRoleId(2);

session_start();

$user->store();

$response = [
    'success' => true,
    'message' => 'User registered successfully'
];

// Encode response to JSON and output
header('Content-Type: application/json');
echo json_encode($response);

?>