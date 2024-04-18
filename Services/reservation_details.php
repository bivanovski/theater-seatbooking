<?php

require_once('../Reservations/Reservation.php');

use Reservations\Reservation as Reservation;

$reservation = new Reservation();
$reservationData = $reservation->getReservationDetails($_GET['reservation_id']);
if ($reservationData) {
    $response = [
        'success' => true,
        'data' => $reservationData
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to retrieve reservation details'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>