<!DOCTYPE html>
<html lang="fr">

<?php  $pageTitle = 'Contact'; ?>
<?php include('partials/head.php') ?>
<body class="contact">

<?php include('partials/header.php'); ?>
<h1 class="animate__animated animate__fadeInDown">NOUS CONTACTER</h1>
<section class="flex1">
    <div class="col animate__animated animate__fadeInLeft">
        <div class="rond">
            <i class="fa-solid fa-phone fa-2xl" style="color: #ffffff;"></i>
        </div>
        <p>
            07 67 20 50 68
        </p>
    </div>
    <div class="col animate__animated animate__fadeInDown">
        <div class="rond">
        <i class="fa-solid fa-envelope fa-2xl" style="color: #ffffff;"></i>
        </div>
        <p>
            support@powerofmemory.com
        </p>
    </div>
    <div class="col animate__animated animate__fadeInRight">
        <div class="rond">
        <i class="fa-solid fa-location-dot fa-2xl" style="color: #ffffff;"></i>
            </div>
            <p>
                3 rue de la muse
            </p>
        </div>
    </div>

</section>


<section class="flex taille">
    <form class="formulaire" method="POST">
        <div class="flex gap animate__animated animate__fadeInDown">
        <input placeholder="Nom" type="name" name="name" required>
        <input placeholder="Email" type="email" name="email" required>
        </div>
        <div class="form2 animate__animated animate__fadeInRight">
        <input placeholder="Sujet" type="text" name="sujet"required>
        <textarea placeholder="Description" name="description" required></textarea>
        </div>
        <button class="animate__animated animate__fadeInUp" type="submit" class="button">Envoyer</button>
    </form>
</section>


<?php
function EnvoieEmail () {
if(isset($_POST['formulaire'])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // RECUPERATION
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $sujet = htmlspecialchars(trim($_POST['sujet']));
    $message = htmlspecialchars(trim($_POST['message']));

    // VALIDATION
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email invalide.";
    }

    // DESTINATION
    $to = "support@powerofmemory.com";
    $headers = "From: $nom <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // CORPS
    $corps = "Nom: $nom\n";
    $corps .= "Email: $email\n";
    $corps .= "Sujet: $sujet\n";
    $corps .= "Message:\n$message\n";

    // ENVOI D'EMAIL

    if (mail($to, $sujet, $corps, $headers)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur est survenue lors de l'envoi de votre message.";
    }
} else {
    echo "Méthode de requête non valide.";
}
}
}
EnvoieEmail();
?>

<?php include('partials/footer.php');?>


</html>