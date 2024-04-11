<?php
require_once ('../Repertoires/Repertoire.php');

use Repertoires\Repertoire as Repertoire;

$repertoire = new Repertoire();

$repertoire->setId($_POST['show_id']);

if ($repertoire->delete()) {
    $response = [
        'success' => true,
        'message' => 'Repertoire deleted successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to delete repertoire'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
