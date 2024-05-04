<?php
require_once ('../Genres/Genre.php');

use Genres\Genre as Genre;

$genreName = isset($_POST['genre']) ? $_POST['genre'] : null; // Get the 'genre' from POST

if (empty($genreName)) { // Validate the 'genre' value
    $response = [
        'success' => false,
        'message' => 'Genre name is required'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$genre = new Genre();
$genre->setGenre($_POST['genre']); // Only set the genre name

$response = [];

try {
    if ($genre->store()) { // Insert into the database
        $response = [
            'success' => true,
            'message' => 'Genre added successfully'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to insert genre'
        ];
    }
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Failed to insert genre',
        'error' => $e->getMessage()
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
