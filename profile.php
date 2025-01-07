<!DOCTYPE html>
<html lang="en">
<?php  $pageTitle = 'MonCompte'; ?>
<?php include('partials/head.php') ?>
<body class="myaccount profilePage">
<?php include('partials/header.php'); ?>

<?php
require_once 'utils/database.php';
$db = connectToDbAndGetPdo();

if(isset($_GET['joueur'])){
    $id = $_GET['joueur'];
}
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

$req = $db->prepare("SELECT level, xp, goal_xp FROM utilisateur WHERE identifiant = $id");
$req->execute();
$level = $req->fetch();

$userLvl = $level['level'];

$barWidth = ($level['xp']/$level['goal_xp'])*100;



$stat_class = "";



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

    else if($game_playedEasy['partie_joue'] > 0){
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

    else if($game_playedMedium['partie_joue'] > 0){
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
    else if($game_playedHard['partie_joue'] > 0){
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

else{
    $stat_class = "displayNone";
}



/*if (isset($_POST['submitFile'])) {
    $uploaddir = 'UserFiles/';
    $id = $_SESSION['id'];
    $uploadfile = $uploaddir . $id . '.jpg';
    move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);

    $photo = $_FILES['photo']['name'];
}*/


?>

<div class="profile_bg"></div>

<form class="photo_profileForm" action="myAccount.php" method="post" enctype="multipart/form-data">
    <label for="photo">
        <div class="PhotoProfile">
            <img src="UserFiles/chat.jpg">
            <img src="assets/images/avatarBorder/<?php
            if($userLvl >= 0 && $userLvl < 5){
                echo "Level1";
            }
            if($userLvl >= 5 && $userLvl < 10){
                echo "Level2";
            }
            if($userLvl >= 10 && $userLvl < 15){
                echo "Level3";
            }
            if($userLvl >= 15 && $userLvl < 20){
                echo "Level4";
            }
            if($userLvl >= 20 && $userLvl < 25){
                echo "Level5";
            }
            if($userLvl >= 25 && $userLvl < 30){
                echo "Level6";
            }
            if($userLvl >= 30 && $userLvl < 35){
                echo "Level7";
            }
            if($userLvl >= 35 && $userLvl < 40){
                echo "Level8";
            }
            if($userLvl >= 40){
                echo "Level9";
            } ?>.png" alt="" id="avatarBorder">
        </div>
    </label>
    <button class="photo_btn" type="submit" name="submitFile">Uploader</button>

</form>

<section class="flex flex_column flex_center flex_align" style="gap: 50px">
    <div class="profile">
        <h1 class="h1Title animate__animated animate__fadeInDown">
            <?php
                echo get_name_for_playerProfile($id); ?></h1>
        <div class="progressbar">
            <div class="progressbar_number">
                <p id="level"><?php echo $level['level']?></p>
            </div>
            <div class="progressbar_inner <?php if($barWidth < 30){
                echo "progressbar_inner_small";
            } ?>" style=" width: <?php echo $barWidth . "%" ?>">
                <p><span id="xp"><?php echo $level['xp']?></span> /
                    <span id="goal_xp"><?php echo $level['goal_xp']?></span></p>
            </div>
            <div class="progressbar_number deux">
                <p id="next_level"><?php echo $level['level']+1?></p>
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
</section>
<?php include('partials/footer.php'); ?>
</body>
<script src="assets/statistic.js" type="text/javascript"></script>
</html>