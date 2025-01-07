<?php
session_start();
require_once ("../utils/database.php");
$db = connectToDbAndGetPdo();


$message = $db->prepare("SELECT *,  utilisateur.pseudo
                                FROM message
                                JOIN utilisateur ON message.id_exp = utilisateur.identifiant
                                WHERE date_temps_mess >= NOW() - INTERVAL 1 DAY");
$message->execute();
$message = $message->fetchAll();


if ($message) {
    $response = [
        "session" => $_SESSION['id'],
        "message" => $message,
    ];
} else {
    $response = [
        "error" => "Aucun message trouvé"
    ];
}

echo json_encode($response);
