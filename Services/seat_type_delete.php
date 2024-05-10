<?php
require_once ('../Seat_types/Seat_type.php');

use Seat_types\Seat_type as Seat_type;

$seat_type = new Seat_type();

$seat_type->setId($_POST['id']);

if ($seat_type->delete()) {
    $response = [
        'success' => true,
        'message' => 'type deleted successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to delete type'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);