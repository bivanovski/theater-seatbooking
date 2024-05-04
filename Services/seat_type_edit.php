<?php
require_once ('../Seat_types/Seat_type.php');

use Seat_types\Seat_type as Seat_type;

$seat_type = new Seat_type();

$seat_type->setId($_POST['id']);
$seat_type->setTypes($_POST['types']);
$seat_type->setPrice($_POST['price']);
$response = [];

if ($seat_type->update()) {
    $response = [
        'success' => true,
        'message' => 'type updated successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to update type'
    ];
}


header('Content-Type: application/json');
echo json_encode($response);