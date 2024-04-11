<?php

require_once (__DIR__ . '/../Database/Connection.php');
use Database\Connection as Connection;

require_once ('../Repertoires/Repertoire.php');
use Repertoires\Repertoire as Repertoire;

$repertoire = new Repertoire();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the "id" parameter is provided
    if (isset($_GET['id'])) {
       
        $id = $_GET['id'];
        try {
            $connectionObj = new Connection();
            $connection = $connectionObj->getConnection();

            $statement = $connection->prepare('SELECT r.*, s.*,
                                                      g.genre AS genre_name
                                              FROM `repertoire` AS r
                                              INNER JOIN `shows` AS s ON r.show_id = s.id
                                              INNER JOIN `genres` AS g ON s.genre_id = g.id
                                              WHERE r.`id` = :id');
            $statement->execute(['id' => $id]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $connectionObj->destroy();

            if ($result) {

                $response = [
                    'success' => true,
                    'data' => [
                        'id' => $result['id'],
                        'show_id' => $result['show_id'],
                        'date_time' => $result['date_time'],
                        'show' => [
                            'id' => $result['id'],
                            'name' => $result['name'],
                            'description' => $result['description'],
                            'genre_id' => $result['genre_id'],
                            'director' => $result['director'],
                            'set_designer' => $result['set_designer'],
                            'age_group' => $result['age_group'],
                            'hall_number' => $result['hall_number'],
                            'costume_designer' => $result['costum_designer'],
                            'assistant_director' => $result['assistant_director'],
                            'stage_manager' => $result['stage_manager'],
                            'image' => $result['image'],
                            'genre_name' => $result['genre_name']
                        ],
                        
                    ]
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'No repertoire found for ID: ' . $id
                ];
            }
        } catch (Exception $e) {
            // Error occurred during data retrieval
            $response = [
                'success' => false,
                'message' => 'Error retrieving repertoire data: ' . $e->getMessage()
            ];
        }
    } else {
        // No "id" parameter provided
        $response = [
            'success' => false,
            'message' => 'Parameter "id" is required'
        ];
    }
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid request method'
    ];
}

header('Content-Type: application/json');
echo json_encode($response);

?>
