<?php

require_once ('../Seat_types/Seat_type.php');

use Seat_types\Seat_type as Seat_type;

$seat_type = new Seat_type();
$seat_type->setTypes($_POST['types']); // Changed method name
$seat_type->setPrice($_POST['price']); // Changed method name

$response = [];
try {
    if ($seat_type->store()) {
        $response = [
            'success' => true,
            'message' => 'types added successfully'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to insert type'
        ];
    }
    
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Failed to insert types',
        'error' => $e->getMessage()
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>
