<?php

require_once('../Shows/Show.php');

use Shows\Show as Show;

$show = new Show();

$selectedGenres = isset($_GET['genres']) ? explode(',', $_GET['genres']) : [];
$selectedAgeGroups = isset($_GET['age_groups']) ? explode(',', $_GET['age_groups']) : [];

$shows = $show->get($selectedGenres, $selectedAgeGroups);

$response = [
    'success' => true,
    'data' => $shows
];

header('Content-Type: application/json');
echo json_encode($response);

?>
