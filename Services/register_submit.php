<?php

require_once ('../Users/User.php');

use Users\User as User;

$user = new User();
$user->setFirstName($_POST['firstname']);
$user->setLastName($_POST['lastname']);
$user->setPassword($_POST['password']);
$user->setEmail($_POST['email']);

$user->setRoleId(2);

session_start();

$response = [];

try {
    // Attempt to store the user
    $user->store();

    // If execution reaches here, no exception occurred, so registration was successful
    $_SESSION['firstname'] = $user->getFirstName();
    $_SESSION['lastname'] = $user->getLastName();
    $response = [
        'success' => true,
        'message' => 'User registered successfully'
    ];
} catch (PDOException $e) {
    // Handle the case where there's a duplicate email entry or any other database error
    $response = [
        'success' => false,
        'message' => 'Failed to register user. This email may already be in use or a database error occurred.'
    ];
}

// Encode response to JSON and output
header('Content-Type: application/json');
echo json_encode($response);

?>
