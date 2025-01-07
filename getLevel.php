<?php
// Partie PHP pour la mise à jour de la base de données avec PDO
session_start();
// Configuration de connexion à la base de données
require_once 'utils/database.php';
$db = connectToDbAndGetPdo();


$level = $db->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant;");
$level->execute(array("identifiant" => $_SESSION["id"]));
$level = $level->fetch();

$response = [
    "level" => $level["level"],
    "xp" => $level["xp"],
    "goal_xp" => $level["goal_xp"]
];

echo json_encode($response);

?>
