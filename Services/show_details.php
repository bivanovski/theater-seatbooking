<?php

require_once('../Shows/Show.php');

use Shows\Show as Show;

$show = new Show();
$showData = $show->getShowDetails($_GET['show_id']);
if ($showData) {
    $response = [
        'success' => true,
        'data' => $showData
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to retrieve show details'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>