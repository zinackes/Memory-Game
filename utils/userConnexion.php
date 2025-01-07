<?php

function validateInscription(){
    $db = connectToDbAndGetPdo();
    $error = "";
    if (isset($_POST['submitForm'])) {
        $count1 = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE :email;");
        $count1->execute(array("email"=>$_POST['email']));
        $count1 = $count1->fetch();
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && $count1['COUNT(*)'] === 0) {
        } else {
            $error = $_POST['email'];
        }
        $count2 = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE :pseudo;");
        $count2->execute(array("pseudo" => $_POST['pseudo']));
        $count2 = $count2->fetch();
        if (strlen($_POST["pseudo"]) >= 4) {
            if ($count2['COUNT(*)'] === 0) {
            } else {
                $error = "pseudo existe deja";
            }
        } else {
            $error = "pseudo trop court (4 caracteres minimum)";
        }
        if (preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/', $_POST['password']) && $_POST['password'] == $_POST['passwordConfirm']) {
            $password = $_POST["password"];
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $error = "Le mot de passe doit comporter au moins 8 caractères, incluant une majuscule, une minuscule, un chiffre et un caractère spécial.";
        }
        if($error === ""){
            $sql = $db->prepare("INSERT INTO utilisateur (pseudo, email, mot_de_passe, level, xp, goal_xp) VALUES (:pseudo, :email, :mot_de_passe, :level, :xp, :goal_xp);");
            $sql->execute(array("pseudo" => $_POST['pseudo'],"email" => $_POST['email'],"mot_de_passe" => $password, "level" => 0, "xp" => 0, "goal_xp" => 100));
            $error = "votre compte a été créer et enregistré";
            return $error;
        }else {
            return $error;
        }
    }

}

function validateConnexion(){
    $db = connectToDbAndGetPdo();
    $error = '';
    if (isset($_POST['submitConnexion'])) {
        $count = $db->prepare("SELECT COUNT(*) FROM utilisateur WHERE pseudo = ?;");
        $count->execute(array($_POST['pseudo']));
        $count = $count->fetch();
        $mot_de_passe = $db->prepare("SELECT mot_de_passe FROM utilisateur WHERE pseudo = :pseudo;");
        $mot_de_passe->execute(array("pseudo" => $_POST['pseudo']));
        $mot_de_passe = $mot_de_passe->fetch();
        $id = $db->prepare("SELECT identifiant FROM utilisateur WHERE pseudo = :pseudo;");
        $id->execute(array("pseudo" => $_POST['pseudo']));
        $id = $id->fetch();
        if ($count['COUNT(*)'] > 0 && password_verify($_POST['mot_de_passe'], $mot_de_passe["mot_de_passe"])) {
            $error = "vous etes connectés";
            $_SESSION["id"] = $id['identifiant'];
        }else{
            $error = "mot de passe ou email incorrect";
        }
    }
    return $error;
}

function newpassword(){
    $db = connectToDbAndGetPdo();
    $error = "";
    if (isset($_POST['Validation2'])) {
        if($_POST['newmdp'] === $_POST['passwordConfirm'] &&  $_POST['email'] === get_utilisateur_email()) {
            $newmdp = password_hash($_POST['newmdp'], PASSWORD_DEFAULT);
            $query = $db->prepare("
                                        UPDATE utilisateur
                                        SET mot_de_passe = :newmdp
                                        WHERE email = :email;");
            $query->execute(array("newmdp" => $newmdp, ":email" => $_POST['email']));
            $error = "Mot de passe changé";
        }else{
            $error = "Adresse mail invalide";
        }

    }
    return $error;
}
function newemail(){
    $db = connectToDbAndGetPdo();
    $error = "";
    if (isset($_POST['Validation1'])) {
        if ($_POST['oldemail'] === get_utilisateur_email()) {
                if (password_verify($_POST['mdp'], get_utilisateur_password())){
                    $query = $db->prepare("
                                        UPDATE utilisateur
                                        SET email = :newemail
                                        WHERE identifiant = :identifiant;");
                    $query->execute(array(":newemail" => $_POST['newemail'], "identifiant" => $_SESSION['id']));
                    $error = "Adresse mail changé";
                }else{
                    $error = "mot de passe incorrect1";
                }
        }else{
            $error = "oldemail incorrect";
        }

    }
    return $error;
}
?>