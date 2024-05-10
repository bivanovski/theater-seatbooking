<?php

require_once __DIR__ . '/../Genres/Genre.php';

use Genres\Genre as Genre;

$genre = new Genre();

$genre->setId($_POST['id']);
    
    if ($genre->delete()) {
        $response = [
            'success' => true,
            'message' => 'Genre deleted successfully'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to delete genre'
        ];
    }

header('Content-Type: application/json');
echo json_encode($response);

?>
