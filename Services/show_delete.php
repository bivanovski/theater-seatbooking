<?php
require_once('../Shows/Show.php');

use Shows\Show as Show;

$show = new Show();

$show->setId($_POST['show_id']);

if ($show->delete()) {
    $response = [
        'success' => true,
        'message' => 'Show deleted successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to delete show'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
