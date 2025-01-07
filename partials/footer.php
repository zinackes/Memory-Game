<!DOCTYPE html>
<html lang="en">
<?php $linkRoot = "";
if($pageTitle == 'Accueil' || $pageTitle == 'Score') {
    $linkRoot = "../../";
}
?>
<body>
<footer>
    <section>
        <h3 class="info animate__animated">Informations</h3>
        <p class="animate__animated"><span>Tel: </span> 07 67 20 50 68</p>
        <p class="animate__animated"><span>Email: </span> support@powerofmemory.com</p>
        <p class="animate__animated"><span>Emplacement: </span> 3 rue de la muse</p>
    </section>
    <section>
        <h3 class="animate__animated">Power Of Memory</h3>
        <ul>
            <li class="animate__animated"><a href="games/memory/index.php">Accueil</a></li>
            <li class="animate__animated"><a href="games/memory/index.php#themes">Jeu</a></li>
            <li class="animate__animated"><a href="games/memory/scores.php">Scores</a></li>
            <li class="animate__animated"><a href="Contact.php">Nous Contacter</a></li>
        </ul>
    </section>
    <div class="copyright">
        <p class="animate__animated">Copyright © 2024 Tous droit réservés</p>
    </div>
</footer>
</body>
<script src="<?php echo $linkRoot; ?>assets/DarkMode.js" type="text/javascript"></script>
<script src="<?php echo $linkRoot; ?>assets/level.js" type="text/javascript"></script>
</html>