
<head>
    <?php $linkRoot = "";
        if($pageTitle == 'Accueil' || $pageTitle == 'Score') {
            $linkRoot = "../../";
        }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle?></title>
    <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/colors.css">
    <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/header.css">
    <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/footer.css">
    <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/chatbot.css">
    <script src="https://kit.fontawesome.com/1e46e56962.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!--    <link rel="stylesheet" href="assets/CSSInscription.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" type="text/javascript"></script>

    <?php
        if($pageTitle == 'Accueil'){
            ?>
            <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/swiper.css">
    <?php
        }
        else if($pageTitle == 'Score'){
            ?>
            <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/scores.css">
    <?php
        }
        else if($pageTitle == 'Contact'){
            ?>
            <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/contact.css">
            <?php
        }
        else if($pageTitle == 'Connexion'){
            ?>
            <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/connexion.css">
            <?php
        }
        else if($pageTitle == 'Inscription'){
            ?>
            <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/inscription.css">
            <?php
        }
        else if($pageTitle == 'MonCompte'){
            ?>
            <link rel="stylesheet" href="<?php echo $linkRoot ?>assets/css/myAccount.css">
            <?php
        }

    ?>

</head>