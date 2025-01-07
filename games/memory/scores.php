<!DOCTYPE html>
<html lang="fr" class="dark_theme">

<?php  $pageTitle = 'Score'; ?>
<?php include('../../partials/head.php') ?>
<body class="scores">

<?php include('../../partials/header.php'); ?>

<section>
    <h1 class="animate__animated animate__fadeInDown">Meilleurs scores !</h1>
    <form class="search" method="POST">
        <div class="search_bar">
            <input type="text" value="" placeholder="Rechercher" class="input" name="pseudo">
            <input type="submit" name="submit" class="submit">
        </div>
    </form>
    <table>
        <thead>
        <tr>
            <th scope="col">Classement</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Niveau</th>
            <th scope="col">Thème</th>
            <th scope="col">Difficulté</th>
            <th scope="col">Score</th>
            <th scope="col">Date</th>
        </tr>
        </thead>
        <tbody>
        <?php
        require_once '../../utils/database.php';
        $db = connectToDbAndGetPdo();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $pseudo = $_POST['pseudo'];

            $req = $db->prepare("SELECT 
                                        utilisateur.identifiant AS id_joueur, 
                                        utilisateur.level as player_level,
                                        difficulte, score, id_joueur, utilisateur.pseudo, date_temps_partie, theme
                                        FROM score
                                        JOIN utilisateur ON score.id_joueur = utilisateur.identifiant
                                        JOIN jeu ON score.id_jeu = jeu.identifiant
                                        WHERE utilisateur.pseudo LIKE '%$pseudo%'
                                        ORDER BY score ASC
                                        LIMIT 10;");
            $req->execute();
        } else {
            $req = $db->prepare("SELECT utilisateur.identifiant AS id_joueur, 
                                        utilisateur.level as player_level,
                                        difficulte, score, id_joueur, utilisateur.pseudo, date_temps_partie, theme
                                        FROM score
                                        JOIN utilisateur ON score.id_joueur = utilisateur.identifiant
                                        JOIN jeu ON score.id_jeu = jeu.identifiant
                                        ORDER BY score ASC
                                        LIMIT 10;");
            $req->execute();
        }

        $data = $req->fetchAll();

        // Simuler le pseudo du joueur connecté

        if(isset($_SESSION["id"])){
            $connectedPlayer = isset($_SESSION['id_joueur']) ? $_SESSION['id_joueur'] : $_SESSION['id'];
        }
        else{
            $connectedPlayer = isset($_SESSION['id_joueur']) ? $_SESSION['id_joueur'] : '';
        }






        if ($data) {
            foreach ($data as $i => $row) {
                $tr_class = "";
                if($row['id_joueur'] == $connectedPlayer){
                    $tr_class = 'class="highlight"';
                }

                $req = $db->prepare("SELECT identifiant
                                        FROM utilisateur
                                        WHERE pseudo = :pseudo_joueur");
                $req->execute(['pseudo_joueur' => $row['pseudo']]);
                $selectedPlayerId = $req->fetch();

                echo "
                 <tr $tr_class>
                                <th scope='row'>" . ($i + 1) . "</th>
                                <td><a target=”_blank”  href='../../profile.php?joueur={$selectedPlayerId['identifiant']}'>{$row['pseudo']}</a></td>
                                <td>{$row['player_level']}</td>
                                <td>{$row['theme']}</td>
                                <td>{$row['difficulte']}</td>
                                <td>{$row['score']}</td>
                                <td>{$row['date_temps_partie']}</td>
                              </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Aucun résultat trouvé</td></tr>";
        }
        ?>
        </tbody>
    </table>
</section>

<?php include('../../partials/footer.php'); ?>

</body>
</html>