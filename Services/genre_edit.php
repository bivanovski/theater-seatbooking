<?php

require_once __DIR__ . '/../Genres/Genre.php'; // Correct file path

use Genres\Genre as Genre;

$genre = new Genre();

$response = [];

$genre->setId($_POST['id']);
$genre->setGenre($_POST['genre']);

if ($genre->update()) {
        $response = [
            'success' => true,
            'message' => 'Genre updated successfully'
        ];
} else {
        $response = [
            'success' => false,
            'message' => 'Failed to update genre'
        ];
    }

header('Content-Type: application/json');
echo json_encode($response);

?>
