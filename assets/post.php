<?php
session_start();
// Read the JSON data from the request body
$json = file_get_contents("php://input");

// Decode the JSON data to a PHP array
$data = json_decode($json, true);
require ("../utils/database.php");
$db = connectToDbAndGetPdo();

$req = $db->prepare("INSERT INTO message (id_jeu, id_exp, message) VALUES (:id_jeu, :id_exp, :message)");

$id_jeu = $data['id_jeu'];
$id_exp = $_SESSION['id'];
$message = $data['message'];

$req->execute(array("id_jeu" => $id_jeu,"id_exp" => $id_exp, "message" => $message));

// Output the received data
echo json_encode($data);
