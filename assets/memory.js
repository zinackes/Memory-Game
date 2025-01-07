let revealedCardCount = 0;
let reveadledCardImgIndex = [];
let reveadledCardIndex = [];
let nbOfCard = 0;
let canPlayTurn = true;
let totalcardrevealed = 0;
let restartGameBool= false;
let revealedcard = document.querySelectorAll("td");


if(restartGameBool === true){
    startGame();
}


function ajaxPostScore(postData) {
    // Créer un objet XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Ouvrir une connexion POST vers une URL spécifique
    xhr.open("POST", `postScore.php`, true);

    // Définir le type de contenu envoyé
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    // Définir ce qui doit se passer lorsque la réponse est prête
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Traiter la réponse JSON
        }
    };

    // Envoyer la requête avec les données en JSON
    xhr.send(JSON.stringify(postData));
}

function startGame(theme){
    document.querySelector(".launchGame").style.display = "none";
    document.querySelector("table").classList.remove("displayNone");
    document.querySelector(".info").classList.remove("displayNone");
    document.querySelector("aside").classList.add("displayNone");
    generateGrid(theme);
    UpdateTimer();
    if(isPlaying){
        setInterval(UpdateTimer, 1000);
    }
}

const selectedTheme = localStorage.getItem("selectedTheme");
if(selectedTheme){
    document.querySelector("#themeSelect").value = selectedTheme;
}

function changeTheme(theme){
    localStorage.setItem("selectedTheme", theme);
    window.location.href = "../../memory.php";
}

function restartGame(){
    restartGameBool = true;
    location.reload();
}
function generateGrid(themeButton){
    let difficulty = document.querySelector("#difficultySelect").value;
    nbOfCard = difficulty * difficulty;
    let theme = document.querySelector("#themeSelect").value;
    let memoryGame = document.querySelector(".memoryGame");

    let card = `
    <tr>
    </tr>
`;

    let card_inner = `
        <td>
            <div class="card_inner">
                <div class="card_front"><span>?</span></div>
                <div class="card_back"><img src="" alt=""></div>
            </div>
        </td>`;

    for(let i = 0; i < difficulty; i++){
        let tr = document.createElement("tr");
        memoryGame.appendChild(tr);
        tr.innerHTML += card;
        for(let i = 0; i < difficulty; i++) {
            let td = document.createElement("td");
            tr.appendChild(td);
            td.innerHTML += card_inner;
        }
    }
    placeRandomImage(difficulty, theme);
    revealImage(difficulty, theme);
}
function placeRandomImage(difficulty, theme){
    let nbOfImages = nbOfCard/2;
    let images = document.querySelectorAll(".card_back img");
    let ImageIndex = [];
    for(let i = 0; i < nbOfImages; i++){
        ImageIndex.push(i);
        ImageIndex.push(i);
    }
    for(let i = 0; i < nbOfCard ; i++){
        let random = ImageIndex[Math.floor(Math.random() * ImageIndex.length)];
        let src = `assets/images/${theme}/${random}.jpg`;
        if(images[i].getAttribute('src') !== src){
            ImageIndex.splice(ImageIndex.indexOf(random), 1);
            images[i].src = src;
        }
    }
}

function revealImage(difficulty, theme){
    revealedcard = document.querySelectorAll("td");
        revealedcard.forEach(function(carte){
            carte.addEventListener("click", function(){
                if(revealedCardCount < 2 && carte !== reveadledCardIndex[0] || carte !== reveadledCardIndex[1]){

                    if(canPlayTurn && carte.classList.contains("revealed") === false){
                        carte.classList.toggle("revealed");
                        revealedCardCount++;
                        reveadledCardImgIndex.push(carte.querySelector("img")
                            .getAttribute('src'));
                        reveadledCardIndex.push(carte);
                        if(revealedCardCount === 2){
                            for(let i = 0; i < nbOfCard; i++){
                                if(revealedcard[i].classList.contains("revealed") === true){
                                    totalcardrevealed++;
                                }
                            }
                            if(totalcardrevealed === nbOfCard){
                                showPopUp(difficulty);
                                ajaxPostScore({
                                    difficulty: difficulty,
                                    theme: theme,
                                    score: (timeTimer*boost)})
                            }
                            else{
                                totalcardrevealed = 0;
                            }
                            checkCard();
                        }
                    }
                }
            })
        })
}

function checkCard(){
        if(reveadledCardImgIndex[0] !== reveadledCardImgIndex[1]){
            canPlayTurn = false;
            for(let i = 0; i < reveadledCardIndex.length; i++){
                setTimeout(() => {
                    reveadledCardIndex[i].classList.remove("revealed");
                    revealedCardCount = 0;
                }, 800)
                setTimeout(() => {
                    reveadledCardImgIndex = [];
                    reveadledCardIndex = [];
                    canPlayTurn = true;
                }, 810);
            }
        }
        else{
            reveadledCardImgIndex = [];
            reveadledCardIndex = [];
            revealedCardCount = 0;
        }
}