<?php
require_once ('../Reservations/Reservation.php');

use Reservations\Reservation as Reservation;

$reservation = new Reservation();
$reservationData = $reservation->getReservationsByRepertoireId($_GET['repertoire_id']);

if ($reservationData !== null) {
    $response = [
        'success' => true,
        'data' => $reservationData
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to retrieve reservations for the show'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>