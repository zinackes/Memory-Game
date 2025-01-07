<?php
    function current_page()
    {
        return basename($_SERVER['PHP_SELF']);
    }
    $currentPage = current_page();

    function getMessages(){
        $db = connectToDbAndGetPdo();
        $req = $db->prepare("SELECT message, utilisateur.pseudo, date_temps_mess, id_exp
                     FROM message
                     JOIN utilisateur ON message.id_exp = utilisateur.identifiant
                     WHERE date_temps_mess >= NOW() - INTERVAL 1 DAY
                     ORDER BY date_temps_mess ASC;");
        return $req;
    }
    function sendMessageToBd(){
        $db = connectToDbAndGetPdo();
        if (isset($_POST['sendMessage'])) {
            $message = $_POST['message'];
            $message = htmlspecialchars(trim($message));
            $stmt = $db->prepare("INSERT INTO `message` (`id_jeu`, `id_exp`, `message`) VALUES (:id_jeu, :id_exp, :message)");

            $id_jeu = 1;
            $id_exp = $_SESSION["id"];

            $stmt->execute([
                ':id_jeu' => $id_jeu,
                ':id_exp' => $id_exp,
                ':message' => $message
            ]);
//            echo '<meta http-equiv="refresh" content="0">';
        }
    }

function get_utilisateur_name(){
    global $db;
    $name = $db->prepare("SELECT pseudo FROM utilisateur WHERE identifiant = :identifiant;");
    $name->execute(array("identifiant" => $_SESSION["id"]));
    $name = $name->fetch();
    return $name["pseudo"];
}
function get_utilisateur_email(){
    global $db;
    $name = $db->prepare("SELECT email FROM utilisateur WHERE identifiant = :identifiant;");
    $name->execute(array("identifiant" => $_SESSION["id"]));
    $name = $name->fetch();
    return $name["email"];
}
function get_utilisateur_password(){
    global $db;
    $name = $db->prepare("SELECT mot_de_passe FROM utilisateur WHERE identifiant = :identifiant;");
    $name->execute(array("identifiant" => $_SESSION["id"]));
    $name = $name->fetch();
    return $name["mot_de_passe"];
}

function get_name_for_header(){
    if (isset($_SESSION["id"])) {
        return  get_utilisateur_name();
    }else{
        return "";
    }
}

function get_name_for_playerProfile($id){
    global $db;
    $name = $db->prepare("SELECT pseudo FROM utilisateur WHERE identifiant = :identifiant;");
    $name->execute(array("identifiant" => $id));
    $name = $name->fetch();
    return $name["pseudo"];
}

function getTimeInHoursMinutes($seconds) {
    $t = round($seconds);
    if($t <= 3600){
        return sprintf('%02dmin %02dsec', floor($t/60)%60, $t%60);
    }
    else{
        return sprintf('%02dh%02dmin%02dsec', $t/3600, floor($t/60)%60, $t%60);
    }
}

?>


