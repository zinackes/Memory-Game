<!DOCTYPE html>
<html lang="fr">

<?php  $pageTitle = 'Inscription'; ?>
<?php include('partials/head.php') ?>
<body >
<?php
    include('partials/header.php');
    require_once 'utils/userConnexion.php';
     $error = validateInscription();
?>
<section>
    <form action="Inscription.php" method="post">
        <div class="formulaire">
            <h1 class="animate__animated animate__fadeInDown h1Title">INSCRIPTION</h1>
            <input type="email" name="email" class="Email animate__animated animate__fadeInLeft" placeholder="Email" size="30" required>

            <input type="text" name="pseudo" class="Pseudo animate__animated animate__fadeInRight" placeholder="Pseudo" size="30" required minlength="3" maxlength="20">

            <input type="password" name="password" id="password" oninput='updatePasswordStrength()' class="Mdp animate__animated animate__fadeInLeft" placeholder="Mot de passe" size="30" required minlength="8">

            <input type="password" name="passwordConfirm" class="ValidMdp animate__animated animate__fadeInRight" placeholder="Confirmer votre mot de passe" size="30" required minlength="8">

            <div class="passwordChecker">
                <div class="passwordChecker_inner" id="register_indicator2"></div>
            </div>
            <img   class="showPasswd" src="assets/red_eye.png" id="eye" onClick="changer()">
            <?php echo "<p class='error'> $error </p>";?>
            <button type="submit" name="submitForm" class="Inscription animate__animated animate__fadeInUp">Inscription</button>

            <p><a href="">Adresse mail oublié ?</a></p>
            <p><a href="Inscription.php">Deja un compte ? Se connecter</a></p>
        </div>
    </form>
</section>

<?php include('partials/footer.php'); ?>
</body>
<script src="assets/password.js" type="text/javascript"></script>
<script src="assets/showPasswd.js" type="text/javascript"></script>
</html>