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
    <script src="https://kit.fontawesome.com/1e46e56962.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/1e46e56962.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">
    <title>Memory</title>
</head>
<body>
<header>
    <nav>
        <p class="animate__animated animate__fadeInDown">Flip & Find</p>
        <input type="checkbox" id="menu">
        <label for="menu">
            <i class="fa-solid fa-bars fa-2xl"></i>
        </label>
        <ul class="ul_menu">
            <li class="animate__animated animate__fadeInDown"><a href="games/memory/index.php">Accueil</a></li>
            <li class="animate__animated animate__fadeInDown"><a href="games/memory/index.php#themes" class="active">Jeu</a></li>
            <li class="animate__animated animate__fadeInDown"><a href="games/memory/scores.php">Scores</a></li>
            <li class="animate__animated animate__fadeInDown"><a href="Contact.php">Nous contacter</a></li>
            <li class="login animate__animated animate__fadeInDown">
                <a href="login.php">
                    <i class="fa-solid fa-right-to-bracket fa-xl"></i>
                    <span class="displayNone">Se connecter</span></a></li>
            <li class="animate__animated animate__fadeInDown">
                <a href="Inscription.php">
                    <i class="fa-solid fa-address-card fa-xl"></i>
                    <span class="displayNone">S'enregistrer</span></a></li>
            <li class="animate__animated animate__fadeInDown"><a href="myAccount.html"><i class="fa-solid fa-user fa-xl"></i>
                <span class="displayNone">Profile</span></a></li>
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
</header>
<section>
    <h1 class="animate__animated animate__fadeInDown">Résolvez le memory en un temps record !</h1>
    <div class="dif">
    <aside>
        <div>
            <p>Difficulté:</p>
            <select>
                <option value="Facile">Facile (4x4)</option>
                <option value="Moyen">Moyen (8x8)</option>
                <option value="Difficile">Difficile (12x12)</option>
            </select>
        </div>
        <div>
            <p>Theme:</p>
            <select onchange="location = this.value;">
                <option value="memory.html">Plante vs Zombie</option>
                <option value="memorytheme2.html">Politique</option>
                <option value="memorytheme3.html">Même</option>
            </select>
        </div>
    </aside>
    <table>
        <tbody>
            <tr>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/6.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/7.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/8.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/8.jpg" alt=""></div>
                </div></td>
            </tr>
            <tr>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/7.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/9.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/10.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/9.jpg" alt=""></div>
                </div></td>
            </tr>
            <tr>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/10.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/11.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/1.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/6.jpg" alt=""></div>
                </div></td>
            </tr>
            <tr>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/13.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/13.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/1.jpg" alt=""></div>
                </div></td>
                <td><div class="card_inner">
                    <div class="card_front"><span>?</span></div>
                    <div class="card_back"><img src="assets/images/Meme/11.jpg" alt=""></div>
                </div></td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="info">
        <p class="animate__animated animate__fadeInUp">Temps écoulé: <span>3 min : 30 secondes</span></p>
        <p class="animate__animated animate__fadeInUp">Cartes trouvées: <span>8</span></p>
    </div>

</section>

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
                    <img src="assets/images/robot.png" alt="">
                    <p>Chat général</p>
                </div>
                <label for="bot">
                    <i class="fa-solid fa-xmark"></i>
                </label>
            </div>
            <div class="textzone">
                <div class="messagebox moi">
                    <aside><img src="assets/images/robot.png" alt=""></aside>
                    <div>
                        <p class="author">Moi</p>
                        <p class="text">Adhoashdo h ios dizasaodza
                            hisjaziojz oiai</p>
                        <p class="date">Aujourd'hui à 14h18</p>
                    </div>
                </div>
                <div class="messagebox">
                    <aside><img src="assets/images/robot.png" alt=""></aside>
                    <div>
                        <p class="author">Bertrand</p>
                        <p class="text">Adhoashdo h ios dizasaodza
                            hisjaziojz oiai</p>
                        <p class="date">Aujourd'hui à 14h19</p>
                    </div>
                </div>
            </div>
            <div class="message">
                <input type="text" placeholder="Votre message...">
                <button>Envoyer</button>
            </div>
        </div>
    </div>
</div>

<footer>
    <section>
        <h3 class="info">Informations</h3>
        <p><span>Tel: </span> 06 73 84 93 86</p>
        <p><span>Email: </span> support@powerofmemory.com</p>
        <p><span>Emplacement: </span> Paris</p>
    </section>
    <section>
        <h3>Power Of Memory</h3>
        <ul>
            <li>Jouer !</li>
            <li>Les scores</li>
            <li>Battre des records</li>
            <li>Nous contacter</li>
        </ul>
    </section>
    <div class="copyright">
        <p>Copyright © 2024 Tous droit réservés</p>
    </div>
</footer>

</body>
<script>
    function setTheme(themeName) {
        localStorage.setItem('theme', themeName);
        document.documentElement.className = themeName;
    }
    // function to toggle between light and dark theme
    function ToggleTheme(checkBox) {
        if (!checkBox.checked){
            setTheme('dark_theme');
        } else {
            setTheme('white_theme');
        }
    }
    // Immediately invoked function to set the theme on initial load
    (function () {
        if (localStorage.getItem('theme') === 'dark_theme') {
            setTheme('dark_theme');
        } else {
            setTheme('white_theme');
        }
    })();
</script>
</html>