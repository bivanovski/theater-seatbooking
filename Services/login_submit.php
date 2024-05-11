<?php

session_start();

require_once ('../Users/User.php');

use Users\User as User;

$user = new User();

$user->setEmail($_POST['email']);
$user->setPassword($_POST['password']);


$isAuthenticated = $user->authenticate();

if ($isAuthenticated) {
   $_SESSION['email'] = $user->getEmail();
   $_SESSION['firstname'] = $user->getFirstName();
   $_SESSION['lastname'] = $user->getLastName();
   $_SESSION['role'] = $user->checkRole();

   $response = [
      'success' => true,
      'message' => 'User authenticated successfully',
      'data' => [
         'email' => $_SESSION['email'],
         'firstname' => $_SESSION['firstname'],
         'lastname' => $_SESSION['lastname'],
         'role'=>$user->checkRole()

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