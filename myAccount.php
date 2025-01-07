<!DOCTYPE html>
<html lang="en">
<?php
$pageTitle = 'MonCompte'; ?>
<?php include('partials/head.php') ?>
<body class="myaccount">
<?php include('partials/header.php'); ?>
<?php
if (!(isset($_SESSION["id"]))) {
    header('HTTP/1.0 404 Not Found');
    die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this server.</p></body></html>');
} ?>
<?php
require_once 'utils/database.php';
$db = connectToDbAndGetPdo();

$id = $_SESSION['id'];
$req = $db->prepare("SELECT COUNT(*) AS partie_joue FROM score WHERE id_joueur = $id");
$req->execute();
$game_played = $req->fetch();

$req = $db->prepare("SELECT COUNT(*) AS partie_joue FROM score WHERE id_joueur = $id AND difficulte = 'Facile'");
$req->execute();
$game_playedEasy = $req->fetch();

$req = $db->prepare("SELECT COUNT(*) AS partie_joue FROM score WHERE id_joueur = $id AND difficulte = 'Moyen'");
$req->execute();
$game_playedMedium = $req->fetch();

$req = $db->prepare("SELECT COUNT(*) AS partie_joue FROM score WHERE id_joueur = $id AND difficulte = 'Difficile'");
$req->execute();
$game_playedHard = $req->fetch();

$score_allTime = 0;
$allScore = 0;
$mediumTime = 0;
$favTheme['theme'] = "Aucun";
$favDifficulty['difficulte'] = "Aucun";

$score_allTimeEasy = 0;
$allScoreEasy = 0;
$mediumTimeEasy = 0;

$score_allTimeMedium = 0;
$allscoreMedium = 0;
$mediumTimeMedium= 0;

$score_allTimeHard = 0;
$allscoreHard = 0;
$mediumTimeHard = 0;

$stat_class = "";

if(isset($_SESSION["id"])){

    if($game_played['partie_joue'] > 0){
        $req = $db->prepare("SELECT COUNT(*) AS partie_joue FROM score WHERE id_joueur = $id");
        $req->execute();
        $game_played = $req->fetch();

        $req = $db->prepare("SELECT score FROM score WHERE id_joueur = $id ORDER BY score ASC LIMIT 1;");
        $req->execute();
        $score_allTime = $req->fetch();
        $score_allTime = getTimeInHoursMinutes($score_allTime['score']);

        $req = $db->prepare("SELECT theme, COUNT(theme) AS favorite_theme 
                            FROM score 
                            WHERE id_joueur = $id
                            GROUP BY theme 
                            ORDER BY favorite_theme DESC 
                            LIMIT 1");
        $req->execute();
        $favTheme = $req->fetch();

        $req = $db->prepare("SELECT difficulte, COUNT(difficulte) AS favorite_diff
                            FROM score 
                            WHERE id_joueur = $id
                            GROUP BY difficulte 
                            ORDER BY favorite_diff DESC 
                            LIMIT 1");
        $req->execute();
        $favDifficulty = $req->fetch();


        $req = $db->prepare("SELECT SUM(score) AS total_score FROM score WHERE id_joueur = $id ORDER BY score ASC LIMIT 1;");
        $req->execute();
        $allscoreSec = $req->fetch();
        $allScore = getTimeInHoursMinutes($allscoreSec['total_score']);

        $mediumTime = getTimeInHoursMinutes($allscoreSec['total_score'] / $game_played['partie_joue']);

    }

    if($game_playedEasy['partie_joue'] > 0){
        $req = $db->prepare("SELECT COUNT(*) AS partie_joue FROM score WHERE id_joueur = $id AND difficulte = 'Facile'");
        $req->execute();
        $game_playedEasy = $req->fetch();

        $req = $db->prepare("SELECT score FROM score WHERE id_joueur = $id AND difficulte = 'Facile' ORDER BY score ASC LIMIT 1;");
        $req->execute();
        $score_allTimeEasy = $req->fetch();
        $score_allTimeEasy = getTimeInHoursMinutes($score_allTimeEasy['score']);

        $req = $db->prepare("SELECT SUM(score) AS total_score FROM score WHERE id_joueur = $id AND difficulte = 'Facile' ORDER BY score ASC LIMIT 1;");
        $req->execute();
        $allscoreSecEasy = $req->fetch();
        $allScoreEasy = getTimeInHoursMinutes($allscoreSecEasy['total_score']);

        $mediumTimeEasy = getTimeInHoursMinutes($allscoreSecEasy['total_score'] / $game_playedEasy['partie_joue']);

    }

    if($game_playedMedium['partie_joue'] > 0){

        $req = $db->prepare("SELECT COUNT(*) AS partie_joue FROM score WHERE id_joueur = $id AND difficulte = 'Moyen'");
        $req->execute();
        $game_playedMedium = $req->fetch();

        $req = $db->prepare("SELECT score FROM score WHERE id_joueur = $id AND difficulte = 'Moyen' ORDER BY score ASC LIMIT 1;");
        $req->execute();
        $score_allTimeMedium = $req->fetch();
        $score_allTimeMedium = getTimeInHoursMinutes($score_allTimeMedium['score']);

        $req = $db->prepare("SELECT SUM(score) AS total_score FROM score WHERE id_joueur = $id AND difficulte = 'Moyen' ORDER BY score ASC LIMIT 1;");
        $req->execute();
        $allscoreSecMedium = $req->fetch();
        $allscoreMedium = getTimeInHoursMinutes($allscoreSecMedium['total_score']);

        $mediumTimeMedium = getTimeInHoursMinutes($allscoreSecMedium['total_score'] / $game_playedMedium['partie_joue']);

    }
    if($game_playedHard['partie_joue'] > 0){
        $req = $db->prepare("SELECT COUNT(*) AS partie_joue FROM score WHERE id_joueur = $id AND difficulte = 'Difficile'");
        $req->execute();
        $game_playedHard = $req->fetch();

        $req = $db->prepare("SELECT score FROM score WHERE id_joueur = $id AND difficulte = 'Difficile' ORDER BY score ASC LIMIT 1;");
        $req->execute();
        $score_allTimeHard = $req->fetch();
        $score_allTimeHard = getTimeInHoursMinutes($score_allTimeHard['score']);

        $req = $db->prepare("SELECT SUM(score) AS total_score FROM score WHERE id_joueur = $id AND difficulte = 'Difficile' ORDER BY score ASC LIMIT 1;");
        $req->execute();
        $allscoreSecHard = $req->fetch();
        $allscoreHard = getTimeInHoursMinutes($allscoreSecHard['total_score']);

        $mediumTimeHard = getTimeInHoursMinutes($allscoreSecHard['total_score'] / $game_playedHard['partie_joue']);

    }
    // -----------------------------PARTIES JOUES-----------------------------------


// -----------------------------TEMPS RECORDS-----------------------------------


// -----------------------------Theme favoris-----------------------------------


// -----------------------------Difficulte favoris-----------------------------------


// -----------------------------Temps total-----------------------------------

// -----------------------------Temps moyen-----------------------------------
}
else{
    $stat_class = "displayNone";
}



if (isset($_POST['submitFile'])) {
    $uploaddir = 'UserFiles/';
    $id = $_SESSION['id'];
    $uploadfile = $uploaddir . $id . '.jpg';
    move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);

    $photo = $_FILES['photo']['name'];
}
include('utils/userConnexion.php');
if(isset($_POST['Validation1'])){
    $error = newemail();
}else{
    $error = newpassword();
};

if(!isset($_SESSION["id"])){
    header("location: games/memory/index.php");
}
?>

<div class="profile_bg"></div>

    <form class="photo_profileForm" action="myAccount.php" method="post" enctype="multipart/form-data">
        <label for="photo">
            <div class="PhotoProfile">
                <img src="UserFiles/<?php echo $_SESSION['id']; ?>.jpg">
                <img src="" alt="" id="avatarBorder">
                <i class="fa-solid fa-pencil fa-xl"></i>
            </div>
            <input type="file" name="photo" id="photo" accept="image/*" required>
        </label>
        <button class="photo_btn" type="submit" name="submitFile">Uploader</button>

    </form>

<div class="level_list">
    <h2>Liste des paliers <i class="fa-solid fa-xmark" id="close_level_list"></i></h2>
    <div>
        <img src="assets/images/avatarBorder/Level1.png" alt="">
        <p>Level 0 - Level 5</p>
    </div>
    <div>
        <img src="assets/images/avatarBorder/Level2.png" alt="">
        <p>Level 5 - Level 10</p>
    </div>
    <div>
        <img src="assets/images/avatarBorder/Level3.png" alt="">
        <p>Level 10 - Level 15</p>
    </div>
    <div>
        <img src="assets/images/avatarBorder/Level4.png" alt="">
        <p>Level 15 - Level 20</p>
    </div>
    <div>
        <img src="assets/images/avatarBorder/Level5.png" alt="">
        <p>Level 20 - Level 25</p>
    </div>
    <div>
        <img src="assets/images/avatarBorder/Level6.png" alt="">
        <p>Level 25 - Level 30</p>
    </div>
    <div>
        <img src="assets/images/avatarBorder/Level7.png" alt="">
        <p>Level 30 - Level 35</p>
    </div>
    <div>
        <img src="assets/images/avatarBorder/Level8.png" alt="">
        <p>Level 35 - Level 40</p>
    </div>
    <div>
        <img src="assets/images/avatarBorder/Level9.png" alt="">
        <p>Level 40 +</p>
    </div>
</div>

<section class="flex flex_column flex_center flex_align" style="gap: 50px">
    <div class="profile">
        <h1 class="h1Title animate__animated animate__fadeInDown">
            <?php if (isset($_SESSION["id"])) {
                echo get_name_for_header();
            } ?></h1>
        <div class="progressbar">
            <div class="progressbar_number">
                <p id="level">2</p>
            </div>
            <div class="progressbar_inner">
                <p><span id="xp">23</span> / <span id="goal_xp">50</span></p>
            </div>
            <div class="progressbar_number deux">
                <p id="next_level">3</p>
            </div>
            <div class="progressbar_info">
                <div>
                    <p><strong>But des niveaux</strong> <br>
                        Chaque niveau attribue une réduction du temps
                        sur une partie. <br>
                        <span id="currentBoost"></span>
                    </p>
                    <i class="fa-solid fa-info fa-xs"></i>
                </div>
            </div>
        </div>
        <div class="<?php echo $stat_class ?> stat">
            <div class="flex flex_align" style="gap: 30px">
                <h2>Statistiques</h2>
                <select name="stat_categorie" id="stat_categorie" onchange="changeStatisticCategory()">
                    <option value="Global" selected>Global</option>
                    <option>----Difficultés----</option>
                    <option value="Facile">Facile</option>
                    <option value="Moyen">Moyen</option>
                    <option value="Difficile">Difficile</option>
                </select>
            </div>
            <div class="stat_inner Global category">
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$game_played['partie_joue']} </span>" ?> Parties Jouées</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$score_allTime} </span>" ?> Temps Record</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$allScore} </span>" ?> Temps De Jeu</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$mediumTime} </span>" ?> Temps Moyen</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$favTheme['theme']} </span>" ?> Thème Préféré</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$favDifficulty['difficulte']} </span>" ?> Difficulté Préféré</p>
                </div>
            </div>
            <div class="stat_inner Facile category">
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$game_playedEasy['partie_joue']} </span>" ?> Parties Jouées</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$score_allTimeEasy} </span>" ?> Temps Record</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$allScoreEasy} </span>" ?> Temps De Jeu</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$mediumTimeEasy} </span>" ?> Temps Moyen</p>
                </div>
            </div>
            <div class="stat_inner Moyen category">
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$game_playedMedium['partie_joue']} </span>" ?> Parties Jouées</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$score_allTimeMedium} </span>" ?> Temps Record</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$allscoreMedium} </span>" ?> Temps De Jeu</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$mediumTimeMedium} </span>" ?> Temps Moyen</p>
                </div>
            </div>
            <div class="stat_inner Difficile category">
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$game_playedHard['partie_joue']} </span>" ?> Parties Jouées</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$score_allTimeHard} </span>" ?> Temps Record</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$allscoreHard} </span>" ?> Temps De Jeu</p>
                </div>
                <div class="stat_component flex_allCenter">
                    <p><?php echo "<span> {$mediumTimeHard} </span>" ?> Temps Moyen</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex_align flex_wrap flex_center">
        <form action="myAccount.php" method="post" class="flex flex_column flex_center" style="width: auto; gap: 70px">
            <div class="FORMULAIRE">
                <div>
                    <input type="checkbox" id="change_email">
                    <label for="change_email">
                        <p>Je veux changer d'adresse mail</p>
                    </label>
                    <div class="form email">
                        <p class="adressemailtexte">Changer D'adresse Mail</p>
                        <input type="email" name="oldemail" class="AncienEmail" placeholder="Ancien Email" size="35" required>
                        <input type="email" name="newemail" class="Email" placeholder="Nouveau Email" size="35" required>
                        <input type="password" name="mdp" class="MdpForEmail" placeholder="Mot de passe" size="35"  maxlength="20">
                        <?php echo "<p class='erreur'>$error</p>" ?>
                        <button type="submit" name="Validation1" class="Validation1">Valider</button>
                    </div>
                </div>
            </div>
        </form>
        <form action="myAccount.php" method="post" class="flex flex_column flex_center" style="width: auto; gap: 70px">
            <div class="FORMULAIRE">
                <div>
                    <input type="checkbox" id="change_mdp">
                    <label for="change_mdp">
                        <p>Je veux changer de mot de passe</p>
                    </label>
                    <div class="form mdp">
                        <p class="mdptexte">Changer De Mot De Passe</p>
                        <input type="email" class="ActMdp" name="email" placeholder="Adresse mail" size="35" required>
                        <input type="password" name="newmdp" class="NewMdp" placeholder="Nouveau Mot de Passe" size="35" required minlength="3" maxlength="10">
                        <input type="password" name="passwordConfirm" class="ConfirmeMdp" placeholder="Confirmer le nouveau mot de passe" size="35" required minlength="8" maxlength="20">
                        <?php echo "<p class='erreur'>$error</p>" ?>
                        <button type="submit" name="Validation2" class="Validation2">Valider</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php include('partials/footer.php'); ?>
</body>
<script src="assets/statistic.js" type="text/javascript"></script>
</html>