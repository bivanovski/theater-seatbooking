<?php
require_once ('../Reservations/Reservation.php');

use Reservations\Reservation as Reservation;

$reservation = new Reservation();

$reservation->setId($_POST['id']);
$reservation->setUserId($_POST['user_id']);
$reservation->setRow($_POST['row']);
$reservation->setSeatNum($_POST['seat_num']);
$reservation->setRepertoireId($_POST['repertoire_id']);
$reservation->setSeatTypeId($_POST['seat_type_id']);
$reservation->setIsConfirmed($_POST['is_confirmed']);
$response = [];

if ($reservation->update()) {
    $response = [
        'success' => true,
        'message' => 'Reservation updated successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to update reservation'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);


