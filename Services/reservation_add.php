<?php

require_once ('../Reservations/Reservation.php');

use Reservations\Reservation as Reservation;

$reservation = new Reservation();
$reservation->setUserId($_POST['user_id']);
$reservation->setRow($_POST['row']);
$reservation->setSeatNum($_POST['seat_num']);
$reservation->setRepertoireId($_POST['repertoire_id']);
$reservation->setSeatTypeId($_POST['seat_type_id']);

$response = [];
try {
    if ($reservation->store()) {
        $response = [
            'success' => true,
            'message' => 'Reservation created successfully'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to insert reservation'
        ];
    }
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Failed to insert reservation',
        'error' => $e->getMessage()
    ];
}

header('Content-Type: application/json');
echo json_encode($response);