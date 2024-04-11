<?php

require_once ('../Shows/Show.php');

use Shows\Show as Show;

$show = new Show();
$show->setName($_POST['name']);
$show->setDescription($_POST['description']);
$show->setGenreId($_POST['genre_id']);
$show->setDirector($_POST['director']);
$show->setSetDesigner($_POST['set_designer']);
$show->setAgeGroup($_POST['age_group']);
$show->setHallNumber($_POST['hall_number']);
$show->setHallNumber($_POST['hall_number']);
$show->setCostumeDesigner($_POST['costume_designer']);
$show->setAssistantDirector($_POST['assistant_director']);
$show->setStageManager($_POST['stage_manager']);
$show->setImage($_POST['image']);

$response = [];
try {
    if ($show->store()) {
        $response = [
            'success' => true,
            'message' => 'Show added successfully'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Failed to insert show'
        ];
    }
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => 'Failed to insert show',
        'error' => $e->getMessage()
    ];
}

header('Content-Type: application/json');
echo json_encode($response);