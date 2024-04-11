<?php
require_once ('../Shows/Show.php');

use Shows\Show as Show;

$show = new Show();
$show->setId($_POST['show_id']);
$show->setName($_POST['name']);
$show->setDescription($_POST['description']);
$show->setGenreId($_POST['genre_id']);
$show->setDirector($_POST['director']);
$show->setSetDesigner($_POST['set_designer']);
$show->setAgeGroup($_POST['age_group']);
$show->setHallNumber($_POST['hall_number']);
$show->setCostumeDesigner($_POST['costume_designer']);
$show->setAssistantDirector($_POST['assistant_director']);
$show->setStageManager($_POST['stage_manager']);
$show->setImage($_POST['image']);
$response = [];

if ($show->update()) {
    $response = [
        'success' => true,
        'message' => 'Show updated successfully'
    ];
} else {
    $response = [
        'success' => false,
        'message' => 'Failed to update show'
    ];
}



header('Content-Type: application/json');
echo json_encode($response);
