<?php
require_once ('../Repertoires/Repertoire.php');

use Repertoires\Repertoire as Repertoire;

$show = new Repertoire();

$repertoire->setId($_POST['id']);
$repertoire->setShow_id($_POST['show_id']);
$repertoire->setDatetime($_POST['date_time']);
$response = [];

if ($repertoire->update()) {
    $response = [
        'success' => true,
        'message' => 'Repertoire updated successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to update repertoire'
    ];
}


header('Content-Type: application/json');
echo json_encode($response);
