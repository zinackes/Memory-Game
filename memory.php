<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/colors.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/chatbot.css">
    <link rel="stylesheet" href="assets/css/memory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/1e46e56962.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">
    <title>Memory</title>
</head>

<?php $pageTitle = 'Memory'; ?>
<?php include('partials/head.php') ?>
<body>

<?php include('partials/header.php'); ?>

<div class="popup hide">
    <h3>Vous avec gagné</h3>
    <p>Votre temps: <span id="showTime"></span></p>
    <h4>Progression</h4>
    <p>+ <span id="xpGained"></span></p>
    <div class="progressbar">
        <div class="progressbar_number">
            <p id="level">2</p>
        </div>
        <div class="progressbar_inner">
            <p><span id="xp">23</span> <span id="xpAddedBar"></span> / <span id="goal_xp">50</span></p>
        </div>
        <div class="progressbar_inner progressbar_inner_second"></div>
        <div class="progressbar_number deux">
            <p id="next_level">3</p>
        </div>
    </div>
    <div style="margin-top: 10px">
        <button><a href="games/memory/index.php">Accueil</a></button>
        <button><a href="games/memory/scores.php">Scores</a></button>
        <button onclick="restartGame()">Rejouer</button>
    </div>
</div>
<section>
    <h1 class="animate__animated animate__fadeInDown">Résolvez le memory en un temps record !</h1>
    <div class="dif">
        <aside>
            <div>
                <p>Difficulté:</p>
                <select id="difficultySelect">
                    <option value="4" selected>Facile (4x4)</option>
                    <option value="6">Moyen (6x6)</option>
                    <option value="8">Difficile (8x8)</option>
                </select>
            </div>
            <div>
                <p>Theme:</p>
                <select id="themeSelect">
                    <option value="PlanteVsZombie">Plante vs Zombie</option>
                    <option value="Politique">Politique</option>
                    <option value="Meme">Même</option>
                </select>
            </div>
        </aside>

        <table class="displayNone">
            <tbody class="memoryGame">
            </tbody>
        </table>
    </div>
    <button class="launchGame" onclick="startGame()">Lancer La Partie</button>
    <div class="info displayNone">
        <p class="animate__animated animate__fadeInUp">Temps écoulé: <span id="time"> 0 seconde</span></p>
    </div>

</section>

<?php
require_once 'utils/database.php';
require_once 'utils/common.php';
$db = connectToDbAndGetPdo();
?>

<div class="chatbot">
    <div class="relative">
        <input type="checkbox" id="bot">
        <label for="bot" class="labelBot">
            <div class="icon">
                <img src="assets/images/chat.png" alt="">
            </div>
        </label>
        <div class="chat">
            <div class="top">
                <div>

                    <p>Chat général</p>
                </div>
                <label for="bot">
                    <i class="fa-solid fa-xmark"></i>
                </label>
            </div>
            <div class="textzone">
                <div class='messagebox lechat'>
                    <div>
                        <p class='author'>Chat</p>
                        <p class='text'><?php
                            $url = "https://api.thecatapi.com/v1/images/search?mime_types=gif";
                            $response = file_get_contents($url);
                            $Data = json_decode($response, true);
                            $gif_url = $Data[0]['url'];
                            echo "<img src='$gif_url' alt='GIF de chat'>";
                            ?></p>
                        <p class='date'>19h43</p>
                    </div>
                </div>
            </div>
            <form class="message" method="POST" id="form1">
                <label>
                    <input type="text" name="message" placeholder="Votre message..." id="messages">
                </label>
                <input type="submit" name="sendMessage" value="Envoyer">
            </form>
        </div>
    </div>
</div>


<?php include('partials/footer.php'); ?>


</body>
<script src="assets/Timer.js" type="text/javascript"></script>
<script src="assets/Popup.js" type="text/javascript"></script>
<script src="assets/memory.js" type="text/javascript"></script>
<script src="assets/Chat.js" type="text/javascript"></script>
</html>

