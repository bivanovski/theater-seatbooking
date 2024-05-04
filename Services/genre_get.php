<?php

require_once (__DIR__ . '/../Database/Connection.php');
use Database\Connection as Connection;

require_once __DIR__ . '/../Genres/Genre.php'; // Ensure the correct path and case
use Genres\Genre;

// Retrieve all genres from the database
function getAllGenres() {
    $connectionObj = new Connection();
    $connection = $connectionObj->getConnection();

    $statement = $connection->prepare('SELECT * FROM `genres`');
    $statement->execute();

    $genres = $statement->fetchAll(PDO::FETCH_ASSOC);

    $connectionObj->destroy();
    return $genres;
}

// Get all genres from the database
$allGenres = getAllGenres();

// Prepare the response
$response = [
    'success' => true,
    'data' => $allGenres
];

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
