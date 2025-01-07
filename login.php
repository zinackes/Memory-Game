    <!DOCTYPE html>
<html lang="fr">
    <?php  $pageTitle = 'Connexion'; ?>
    <?php include('partials/head.php') ?>
<body>

<?php
    include('utils/userConnexion.php');
    include('partials/header.php');
    $error = validateConnexion();
?>

<section class="form_section">
<form action="login.php" method="post" class="gap">
    <div class="formulaire">
        <h1 class="h1Title animate__animated animate__fadeInDown">CONNEXION</h1>
        <input type="text" name="pseudo" class="Pseudo animate__animated animate__fadeInLeft" placeholder="Votre pseudo" size="20" required minlength="3">
        <input type="password" id="password" name="mot_de_passe" class="Mdp animate__animated animate__fadeInRight" placeholder="Votre mot de passe"  size="20" required minlength="0">
        <img   class="showPasswd" src="assets/red_eye.png" id="eye" onClick="changer()">
        <?php echo "<p class='error'>$error</p>"; ?>
        <button type="submit" name="submitConnexion" class="Connexion animate__animated animate__fadeInUp">Connexion</button>
        <p><a href="">Mot de passe oublié ?</a></p>
        <p><a href="Inscription.php">Pas de compte ? S'inscrire</a></p>
    </div>

    </form>
</section>
<?php include('partials/footer.php'); ?>
</body>
    <script src="assets/showPasswd.js" type="text/javascript"></script>
</html>

