<?php
// Partie PHP pour la mise à jour de la base de données avec PDO
session_start();
require_once 'utils/database.php';
$db = connectToDbAndGetPdo();
$data = json_decode(file_get_contents('php://input'), true);

// Récupérer et valider les données
$level = isset($data['level']) ? (int)$data['level'] : null;
$xp = isset($data['xp']) ? (int)$data['xp'] : null;
$goal_xp = isset($data['goal_xp']) ? (int)$data['goal_xp'] : null;
$user_id = $_SESSION["id"] ?? null;

$response = [];

if ($user_id && $level !== null && $xp !== null && $goal_xp !== null) {
    try {
        $stmt = $db->prepare("UPDATE utilisateur 
                                SET level = :level,
                                    xp = :xp,
                                    goal_xp = :goal_xp
                                WHERE identifiant = :identifiant");

        $stmt->execute([
            "level" => $level,
            "xp" => $xp,
            "goal_xp" => $goal_xp,
            "identifiant" => $user_id
        ]);

        if ($stmt->rowCount() > 0) {
            $response['success'] = true;
            $response['message'] = "Mise à jour réussie.";
            $response['data'] = [
                "level" => $level,
                "xp" => $xp,
                "goal_xp" => $user_id
            ];
        } else {
            $response['success'] = $user_id;
            $response['message'] = "Aucune modification apportée.";
        }
    } catch (PDOException $e) {
        $response['success'] = false;
        $response['error'] = "Erreur : " . $e->getMessage();
        http_response_code(500);
    }
} else {
    $response['success'] = false;
    $response['error'] = "Données manquantes ou utilisateur non connecté.";
    http_response_code(400);
}

echo json_encode($response);
exit;
?>
