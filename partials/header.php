<!DOCTYPE html>
<html lang="en">
<body>
<?php
$HeaderClass = "header_second";
if ($pageTitle == 'Accueil') {
    $HeaderClass = "header";
}
?>

<header class="<?php echo $HeaderClass ?>">
    <?php
    session_start();
    $linkRootPage = "";
    $connected = "";
    $notconnected = "displayNone";
    if (isset($_SESSION["id"])) {
        $connected = "displayNone";
        $notconnected = "";
    }
    if ($pageTitle == 'Accueil' || $pageTitle == 'Score') {
        $linkRootPage = "../../";
    }
    require("$linkRootPage" . "utils/common.php");
    require("$linkRootPage" . "utils/database.php");
    $db = connectToDbAndGetPdo();
    if ($pageTitle == 'Accueil') {
        ?>
        <div class="background_img"></div>
        <nav>
            <p class="title animate__animated animate__fadeInDown">Flip &
                <button>Find</button>
            </p>
            <input type="checkbox" id="menu">
            <label for="menu">
                <i class="fa-solid fa-bars fa-2xl"></i>
            </label>
            <ul class="ul_menu">
                <li class="active animate__animated animate__fadeInDown"><a href="index.php" class="active">Accueil</a>
                </li>
                <li class="active animate__animated animate__fadeInDown"><a href="#themes">Jeu</a></li>
                <li class="active animate__animated animate__fadeInDown"><a href="scores.php">Scores</a></li>
                <li class="active animate__animated animate__fadeInDown"><a href="../../Contact.php">Nous contacter</a>
                </li>
                <li class="<?php echo $connected ?> login animate__animated animate__fadeInDown">
                    <a href="../../login.php">
                        <i class="fa-solid fa-right-to-bracket fa-xl"></i>
                        <span class="displayNoneNav">Se connecter</span></a></li>
                <li class="<?php echo $connected ?> animate__animated animate__fadeInDown">
                    <a href="../../Inscription.php">
                        <i class="fa-solid fa-address-card fa-xl"></i>
                        <span class="displayNoneNav">S'enregistrer</span></a></li>
                <li class="pseudo animate__animated animate__fadeInDown">
                    <a href="../../myAccount.php">
                            <?php if (isset($_SESSION["id"])) {
                                echo get_name_for_header();
                            } ?>
                    </a>
                </li>
                <li class="<?php echo $notconnected ?> animate__animated animate__fadeInDown">
                    <a href="<?php echo $linkRootPage ?>logout.php">
                        <button type="submit" name="logout" class="Connexion animate__animated animate__fadeInUp">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                        <span class="displayNoneNav">Déconnexion</span>
                    </a></li>
                <li class="<?php echo $notconnected ?> animate__animated animate__fadeInDown">
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
                    </div>
                </li>


            </ul>
            <div class="darkmode login animate__animated animate__fadeInDown">
                <p>Dark Mode</p>
                <div class="select">
                    <label class="switch">
                        <input id="theme-toggle" type="checkbox" name="Mode" onclick="ToggleTheme(this)">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="absolute_center">
                <h1 class="animate__animated animate__fadeInLeft">L'Ultime memory <br> pour tous !</h1>
                <p class="animate__animated animate__fadeInRight">Venez challenger les cerveaux les plus agiles !</p>
                <a href="#themes" class="button animate__animated animate__fadeInLeft">Jouer !</a>
            </div>
        </nav>
        <?php
    } else {
        ?>
        <nav>
            <p class="animate__animated animate__fadeInDown">Flip & Find</p>
            <input type="checkbox" id="menu">
            <label for="menu">
                <i class="fa-solid fa-bars fa-2xl"></i>
            </label>
            <ul class="ul_menu">
                <li class="animate__animated animate__fadeInDown"><a
                            href="<?php echo $linkRootPage ?>games/memory/index.php">Accueil</a></li>
                <li class="animate__animated animate__fadeInDown"><a
                            class="<?= $pageTitle == 'Memory' ? 'active' : ''; ?>"
                            href="<?php echo $linkRootPage ?>games/memory/index.php#themes">Jeu</a></li>
                <li class="animate__animated animate__fadeInDown"><a
                            class="<?= $pageTitle == 'Score' ? 'active' : ''; ?>"
                            href="<?php echo $linkRootPage ?>games/memory/scores.php">Scores</a></li>
                <li class="animate__animated animate__fadeInDown"><a
                            class="<?= $pageTitle == 'Contact' ? 'active' : ''; ?>"
                            href="<?php echo $linkRootPage ?>Contact.php">Nous contacter</a></li>
                <li class="<?php echo $connected ?> login animate__animated animate__fadeInDown">
                    <a class="<?= $pageTitle == 'Connexion' ? 'active' : ''; ?>"
                       href="<?php echo $linkRootPage ?>login.php">
                        <i class="fa-solid fa-right-to-bracket fa-xl"></i>
                        <span class="displayNoneNav">Se connecter</span></a></li>
                <li class="<?php echo $connected ?> animate__animated animate__fadeInDown">
                    <a class="<?= $pageTitle == 'Inscription' ? 'active' : ''; ?>"
                       href="<?php echo $linkRootPage ?>Inscription.php">
                        <i class="fa-solid fa-address-card fa-xl"></i>
                        <span class="displayNoneNav">S'enregistrer</span></a></li>
                <li class="pseudo animate__animated animate__fadeInDown"><a
                            class="<?= $pageTitle == 'MonCompte' ? 'active' : ''; ?>"
                            href="<?php echo $linkRootPage ?>myAccount.php">
                        <?php if (isset($_SESSION["id"])) {
                                echo get_name_for_header();
                            } ?>
                    </a></li>
                <li class="<?php echo $notconnected ?> animate__animated animate__fadeInDown">
                    <a href="<?php echo $linkRootPage ?>logout.php">
                        <button type="submit" name="logout" class="Connexion animate__animated animate__fadeInUp">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                        <span class="displayNoneNav">Déconnexion</span>
                    </a></li>
                <li class="<?php echo $notconnected ?> animate__animated animate__fadeInDown">
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
                    </div>
                </li>
            </ul>
            <div class="darkmode login animate__animated animate__fadeInDown">
                <p>Dark Mode</p>
                <div class="select">
                    <label class="switch">
                        <input id="ToggleTheme" type="checkbox" name="Mode" onclick="ToggleTheme(this)">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </nav>
        <?php
    }
    ?>

</header>
</body>
</html>