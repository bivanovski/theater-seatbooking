<?php

require_once (__DIR__ . '/../Database/Connection.php');
use Database\Connection as Connection;

require_once ('../Repertoires/Repertoire.php');
use Repertoires\Repertoire as Repertoire;

$repertoire = new Repertoire();

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the "id" parameter is provided
    if (isset($_GET['id'])) {
        // Get the value of the "id" parameter
        $id = $_GET['id'];

        // Retrieve repertoire data directly from the database based on the provided ID
        try {
            $connectionObj = new Connection();
            $connection = $connectionObj->getConnection();

            $statement = $connection->prepare('SELECT r.*, s.*,
                                                      g.genre AS genre_name,
                                                      s.name AS show_name,
                                                      s.description AS show_description,
                                                      s.director AS show_director,
                                                      s.set_designer AS show_set_designer,
                                                      s.age_group AS show_age_group,
                                                      s.hall_number AS show_hall_number,
                                                      s.costum_designer AS show_costume_designer,
                                                      s.assistant_director AS show_assistant_director,
                                                      s.stage_manager AS show_stage_manager,
                                                      s.image AS show_image
                                              FROM `repertoire` AS r
                                              INNER JOIN `shows` AS s ON r.show_id = s.id
                                              INNER JOIN `genres` AS g ON s.genre_id = g.id
                                              WHERE r.`id` = :id');
            $statement->execute(['id' => $id]);

            $result = $statement->fetch(PDO::FETCH_ASSOC);

            $connectionObj->destroy();

            if ($result) {
                // Output the repertoire data as JSON
                $response = [
                    'success' => true,
                    'data' => [
                        'id' => $result['id'],
                        'show_id' => $result['show_id'],
                        'date_time' => $result['date_time'],
                        // Include all columns from the shows table
                        'show_columns' => [
                            'id' => $result['s_id'],
                            'name' => $result['show_name'],
                            'description' => $result['show_description'],
                            'genre_id' => $result['genre_id'],
                            'director' => $result['show_director'],
                            'set_designer' => $result['show_set_designer'],
                            'age_group' => $result['show_age_group'],
                            'hall_number' => $result['show_hall_number'],
                            'costume_designer' => $result['show_costume_designer'],
                            'assistant_director' => $result['show_assistant_director'],
                            'stage_manager' => $result['show_stage_manager'],
                            'image' => $result['show_image']
                            // Include other columns as needed
                        ],
                        'genre_name' => $result['genre_name']
                    ]
                ];
            } else {
                // Repertoire data not found
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
    // Invalid request method
    $response = [
        'success' => false,
        'message' => 'Invalid request method'
    ];
}

// Set the response headers and echo the JSON response
header('Content-Type: application/json');
echo json_encode($response);

?>
