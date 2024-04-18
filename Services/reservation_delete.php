<?php
require_once ('../Reservations/Reservation.php');

use Reservations\Reservation as Reservation;

$reservation = new Reservation();

$reservation->setId($_POST['id']);

if ($reservation->delete()) {
    $response = [
        'success' => true,
        'message' => 'Reservation deleted successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to delete reservation'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
