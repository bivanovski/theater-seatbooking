<?php

require_once ('../Users/User.php');

use Users\User as User;

$user = new User();

$user->setEmail($_POST['email']);
$user->setPassword($_POST['password']);
$user->setFirstName($_POST['firstname']);
$user->setLastName($_POST['lastname']);


$isAuthenticated = $user->authenticate();

if ($isAuthenticated) {
   session_start();
   $_SESSION['email'] = $user->getEmail();
   $_SESSION['firstname'] = $user->getFirstName();
   $_SESSION['lastname'] = $user->getLastName();

   $response = [
      'success' => true,
      'message' => 'User authenticated successfully',
      'data' => [
         'email' => $_SESSION['email'],
         'firstname' => $_SESSION['firstname'],
         'lastname' => $_SESSION['lastname'],
         // You can include additional session data here if needed
      ]
   ];

   header('Content-Type: application/json');
   echo json_encode($response);
} else {
   $response = [
      'success' => false,
      'message' => 'Authentication failed'
   ];

   header('Content-Type: application/json');
   echo json_encode($response);
}

// return header('Location: login.php?errorMessage=User%20not%20found');