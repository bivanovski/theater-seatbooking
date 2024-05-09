<?php
require_once ('../Reservations/Reservation.php');

use Reservations\Reservation as Reservation;

if (isset($_GET['repertoire_id'])) {
    $repertoireId = $_GET['repertoire_id'];

    $reservation = new Reservation();

    $groupedReservations = $reservation->getReservationsByRepertoireIdGroupedByUser($repertoireId);

    echo json_encode(['success' => true, 'data' => $groupedReservations]);
} else {

    echo json_encode(['success' => false, 'error' => 'Repertoire ID is missing']);
}
?>