<?php

require_once (__DIR__ . '/../Database/Connection.php'); // Database connection
use Database\Connection as Connection; // Use the proper namespace

require_once __DIR__ . '/../Seat_types/Seat_type.php'; // Correct path
use Seat_types\Seat_type; // Use the correct class

// Retrieve all seat types from the database
function getAllSeatTypes() {
    $connectionObj = new Connection(); // Create a new connection object
    $connection = $connectionObj->getConnection(); // Get the PDO connection

    // Prepare SQL to get all seat types
    $statement = $connection->prepare('SELECT * FROM `seat_types`');
    $statement->execute(); // Execute the statement

    // Fetch all results
    $seatTypes = $statement->fetchAll(PDO::FETCH_ASSOC); 

    // Close the connection
    $connectionObj->destroy(); 

    return $seatTypes; // Return all seat types as an array
}

// Retrieve all seat types from the database
$allSeatTypes = getAllSeatTypes();

// Prepare the response for JSON output
$response = [
    'success' => true,
    'data' => $allSeatTypes
];

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

?>
