<?php
require_once ('../Reservations/Reservation.php');

use Reservations\Reservation as Reservation;

if (!isset($_POST['reservation_id']) || empty($_POST['reservation_id'])) {
    $response = [
        'success' => false,
        'message' => 'Reservation ID is missing or empty'
    ];
} else {

    $reservation = new Reservation();

    $reservationId = $_POST['reservation_id'];

    if (!Reservation::checkReservationExists($reservationId)) {
        $response = [
            'success' => false,
            'message' => 'Reservation with the provided ID does not exist'
        ];
    } else {
       
        $newConfirmation = $reservation->toggleConfirmation($reservationId);

        $response = [
            'success' => true,
            'is_confirmed' => $newConfirmation
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
