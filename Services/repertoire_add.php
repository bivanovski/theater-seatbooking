<?php

require_once ('../Repertoires/Repertoire.php');

use Repertoires\Repertoire as Repertoire;

$repertoire = new Repertoire();
$repertoire->setId($_POST['id']);
$repertoire->setShow_id($_POST['show_id']);
$repertoire->setDatetime($_POST['date_time']);

$response = [];
try {
    if ($repertoire->store()) {
        $response = [
            'success' => true,
            'message' => 'Repertoire added successfully'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to insert repertoire'
        ];
    }
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Failed to insert repertoire',
        'error' => $e->getMessage()
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>