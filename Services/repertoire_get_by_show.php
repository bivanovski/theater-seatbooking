<?php
require_once ('../Repertoires/Repertoire.php');

use Repertoires\Repertoire as Repertoire;

$repertoire = new Repertoire();
$repertoireData = $repertoire->getByShow($_GET['show_id']);

if ($repertoireData !== null) {
    $repertoireArray = [];
    foreach ($repertoireData as $repertoire) {
        $repertoireArray[] = [
            'id' => $repertoire->getId(),
            'show_id' => $repertoire->getShow_id(),
            'date_time' => $repertoire->getDatetime()
        ];
    }
    $response = [
        'success' => true,
        'data' => $repertoireArray
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to retrieve repertoires for the show'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>