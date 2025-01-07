<!DOCTYPE html>
<html lang="fr">
<?php  $pageTitle = 'Accueil';
include('../../partials/head.php');
?>
<body class="index">
<?php
require ('../../partials/header.php');
?>

<section class="text_section reveal">
    <h2 class="animate__animated animate__fadeInDown">Qu'est ce que le <span>Memory</span> ?</h2>
    <div class="text_container">
        <div class="component">
            <img src="../../assets/images/cerveau.png" alt="Illustration de cerveau">
            <div class="text_component">
                <aside><p class="animate__animated animate__fadeInLeft">01</p></aside>
                <article>
                    <h3 class="underline animate__animated animate__fadeInDown" style="background-image:
                linear-gradient(90deg, rgba(2,62,115,0.5), rgba(2,48,89,0.5)); max-width: 210px">Jeu de Mémoire</h3>
                    <p class="animate__animated animate__fadeInUp">
                        La mémoire est le point central du jeu. Il s'agit de la capacité à se souvenir de
                        l'emplacement des cartes ou des paires précédemment retournées pour les associer rapidement.
                        Une bonne mémoire visuelle est donc essentielle.</p>
                </article>
            </div>
        </div>
        <div class="component">
            <img src="../../assets/images/chaussure.png" alt="Illustration de chaussure rapide">
            <div class="text_component">
                <aside><p class="animate__animated animate__fadeInLeft">02</p></aside>
                <article>
                    <h3 class="underline animate__animated animate__fadeInDown" style="background-image:
                linear-gradient(90deg, rgba(96,50,122,0.6), rgba(98,39,115,0.6)); max-width: 210px">Jeu de Rapidité</h3>
                    <p class="animate__animated animate__fadeInUp">
                        Deuxième point central du jeu. Il est important de rester attentif pendant toute la partie, sans
                        se laisser distraire.
                        La concentration permet de suivre les mouvements de l'adversaire et d'anticiper les prochaines
                        cartes
                        à retourner..</p>
                </article>
            </div>
        </div>
        <div class="component">
            <img src="../../assets/images/concentre.png" alt="Illustration de la concentration">
            <div class="text_component">
                <aside><p class="animate__animated animate__fadeInLeft">03</p></aside>
                <article>
                    <h3 class="underline animate__animated animate__fadeInDown" style="background-image:
                linear-gradient(90deg, rgba(133,52,84,0.6), rgba(161,73,72,0.6));">Jeu de Concentration</h3>
                    <p class="animate__animated animate__fadeInUp">
                        Une fois que les cartes sont mémorisées, la vitesse avec laquelle on retourne les paires
                        correctement
                        est cruciale, surtout pour les joueurs les plus compétitifs.
                        La rapidité à trouver les paires peut faire la différence entre une victoire et une défaite.</p>
                </article>
            </div>
        </div>
    </div>
</section>
<section class="themes_section reveal" id="themes">
    <h2 class="animate__animated animate__fadeInDown">Découvre les Thèmes du Memory</h2>
    <div class="swipeFlex flex_wrap flex_center flex_around flex_wrap" style="width: 100%">
        <div class="green flex_center flex_column" style="gap: 20px">
            <h3><span class="animate__animated animate__fadeIn">Plantes Vs Zombies</span></h3>
            <div class="swiper PVZ">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i <= 32; $i++) : ?>
                        <div class="swiper-slide pvztheme">
                            <img src="../../assets/images/PlanteVsZombie/<?php echo $i; ?>.jpg" alt="Meme <?php echo $i; ?>">
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <button onclick="changeTheme('PlanteVsZombie')" class="button animate__animated animate__fadeInLeft">Sélectionner</button>
        </div>
        <div class="red flex_center flex_column" style="gap: 20px">
            <h3><span class="animate__animated animate__fadeIn" style="background:
            -webkit-linear-gradient(360deg, #c1554d, #fe8a7e); -webkit-background-clip: text;">Politiques</span></h3>
            <div class="swiper PVZ">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i <= 32; $i++) : ?>
                        <div class="swiper-slide">
                            <img src="../../assets/images/Politique/<?php echo $i; ?>.jpg" alt="Meme <?php echo $i; ?>">
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <button onclick="changeTheme('Politique')" class="button animate__animated animate__fadeInLeft">Sélectionner</button>
        </div>
        <div class="flex_center flex_column" style="gap: 20px">
            <h3><span class="animate__animated animate__fadeIn" style="background:
            -webkit-linear-gradient(360deg, #c1554d, #fe8a7e);
             -webkit-background-clip: text;">Même</span></h3>
            <div class="swiper PVZ">
                <div class="swiper-wrapper">
                    <?php for ($i = 0; $i <= 32; $i++) : ?>
                        <div class="swiper-slide">
                            <img src="../../assets/images/Meme/<?php echo $i; ?>.jpg" alt="Meme <?php echo $i; ?>">
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
            <button onclick="changeTheme('Meme')" class="button animate__animated animate__fadeInLeft">Sélectionner</button>
        </div>
    </div>
</section>

<?php

// Genere Error
error_reporting(E_ALL);
ini_set('display_errors', 'On');

//Connecter a la base de donnée
$db = connectToDbAndGetPdo();

//Requete nbPlayer
$req = $db->prepare("SELECT COUNT(identifiant) as nbPlayer FROM utilisateur");
$req->execute();
$rowPlayer = $req->fetch();

//Requete bestTime
$req = $db->prepare("SELECT MIN(score) as bestTime FROM score");
$req->execute();
$rowTime = $req->fetch();

//Requete gamePlay
$req = $db->prepare("SELECT COUNT(*) as gamePlay FROM score");
$req->execute();
$rowGamer = $req->fetch();

//Requete playerOnline
$req = $db->prepare("SELECT COUNT(date_temps_derniere_co)  as playerOnline FROM utilisateur WHERE DATE(date_temps_derniere_co) = CURRENT_DATE()");
$req->execute();
$rowPlayerOn = $req->fetch();
?>


<section class="stat_section reveal">
    <article>
        <div class="box animate__animated animate__fadeInDown">
            <div class="content">
                <?php echo "<p><span>" .$rowPlayerOn['playerOnline'] . "</span><br>Joueurs Connectés</p>";?>
            </div>
        </div>
        <div class="box animate__animated animate__fadeInRight">
            <div class="content">
                <?php echo "<p><span>" .$rowGamer['gamePlay'] . "</span><br>Parties Jouées</p>";?>
            </div>
        </div>
        <div class="box animate__animated animate__fadeInUp">
            <div class="content">
                <?php echo "<p><span>" .getTimeInHoursMinutes($rowTime['bestTime']). "</span><br>Temps Record</p>";?>
            </div>
        </div>
        <div class="box animate__animated animate__fadeInRight">
            <div class="content">
                <?php echo "<p><span>" .$rowPlayer['nbPlayer'] . "</span><br>Joueurs Inscrits</p>";?>
            </div>
        </div>
    </article>
</section>

<section class="team_section reveal">
    <h2 class="animate__animated animate__fadeInDown">Notre Équipe</h2>
    <p class="team_desc animate__animated animate__fadeInUp">Découvrez notre équipe d'exception qui à développer ce jeu
        !</p>
    <div class="separator animate__animated animate__fadeIn"></div>
    <article>
        <div class="card_floating">
            <div class="card animate__animated animate__fadeInLeft">
                <img src="../../assets/images/mathys.png" alt="">
                <h3>Mathys</h3>
                <p>Développeur</p>
            </div>
        </div>
        <div class="card_floating">
            <div class="card animate__animated animate__fadeInUp">
                <img src="../../assets/images/nino.png" alt="">
                <h3>Nino</h3>
                <p>Scrum Master</p>
            </div>
        </div>
        <div class="card_floating">
            <div class="card animate__animated animate__fadeInUp">
                <img src="../../assets/images/idris.png" alt="">
                <h3>Idris</h3>
                <p>Développeur</p>
            </div>
        </div>
        <div class="card_floating">
            <div class="card animate__animated animate__fadeInRight">
                <img src="../../assets/images/lucas.png" alt="">
                <h3>Lucas</h3>
                <p>Développeur</p>
            </div>
        </div>
    </article>
</section>

<?php include('../../partials/footer.php'); ?>

</body>
<script src="../../assets/reveal.js"></script>
<script src="../../assets/memory.js"></script>
</html>