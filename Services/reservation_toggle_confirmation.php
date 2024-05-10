<?php
require_once('../Reservations/Reservation.php');

use Reservations\Reservation as Reservation;

if (!isset($_POST['user_id'], $_POST['repertoire_id'], $_POST['is_confirmed'])) {
    $response = [
        'success' => false,
        'message' => 'Required parameters are missing'
    ];
} else {
    $userId = $_POST['user_id'];
    $repertoireId = $_POST['repertoire_id'];
    $is_confirmed = $_POST['is_confirmed'];

    $reservation = new Reservation();

    $success = $reservation->toggleConfirmationForUser($userId, $repertoireId, $is_confirmed);

    if ($success) {
        $response = [
            'success' => true,
            'message' => 'Confirmation status toggled successfully for user '. $userId
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to toggle confirmation status for user '. $userId
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($response);