<?php
session_start();

require_once 'utils/database.php';

// Read the JSON data from the request body
$json = file_get_contents("php://input");

// Decode the JSON data to a PHP array
$data = json_decode($json, true);

$db = connectToDbAndGetPdo();

$response = [];

echo $data['difficulty'];
$diff = "Aucune";
if($data['difficulty'] == 4){
    $diff = "Facile";
}
if($data['difficulty'] == 6){
    $diff = "Moyen";
}
if($data['difficulty'] == 8){
    $diff = "Difficile";
}

$req = $db -> prepare ("INSERT INTO score (id_joueur, difficulte, score, theme) 
                              VALUES (:id_joueur, :difficulte, :score, :theme)");

$req -> execute([
        'id_joueur' => $_SESSION['id'],
        'difficulte' => $diff,
        'score' => $data['score'],
        'theme' => $data['theme']
    ]
);

$response['data'] = [
    "difficulty" => $diff,
    "score" => $data['score'],
    "theme" => $data['theme']
];

// Output the received data
echo json_encode($response);
?>