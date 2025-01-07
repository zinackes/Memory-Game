var path = window.location.pathname.split("/").pop();
let url = "";
if(path === "index.php" || path === "scores.php"){
    url = "../../";
}
if(path === "myAccount.php"){
    document.querySelector('.progressbar').remove();
}


let lvl_text = document.getElementById("level");
let nextLvl_text = document.getElementById("next_level");
let xp_text = document.getElementById("xp");
let goalXp_text = document.getElementById("goal_xp");
let xpBar = document.querySelector(".progressbar_inner");
let currentBoost_text = document.getElementById("currentBoost");
let progressbar_info = document.querySelector(".progressbar_info");
let level;
let nextLevel;
let xp;
let goal_xp;
let xpGainedMemory;
let boost;

ajaxGet();


if(path === "myAccount.php"){
    progressbar_info.addEventListener("click", function(){
        document.querySelector(".level_list").classList.toggle("opacityShow");
    })

    document.querySelector("#close_level_list").addEventListener("click", function(){
        document.querySelector(".level_list").classList.remove("opacityShow");
    })
}


function ajaxGet() {
    // Créer un objet XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Ouvrir une connexion GET vers une URL spécifique
    xhr.open("GET", `${url}getLevel.php`, true);

    // Définir ce qui doit se passer lorsque la réponse est prête
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Traiter la réponse JSON
            var data = JSON.parse(xhr.responseText);
            level = data.level;
            nextLevel = level + 1;
            xp = data.xp;
            goal_xp = data.goal_xp;
            UpdateLvl();
            if(path === "myAccount.php"){
                checkAvatarBorder();
            }
        }
    };

    // Envoyer la requête
    xhr.send();
}


function ajaxPostLevel(postData) {
    // Créer un objet XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Ouvrir une connexion POST vers une URL spécifique
    xhr.open("POST", `${url}postLevel.php`, true);

    // Définir le type de contenu envoyé
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    // Définir ce qui doit se passer lorsque la réponse est prête
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Traiter la réponse JSON
            var data = JSON.parse(xhr.responseText);
            console.log(data); // Afficher les données de la réponse
        }
    };

    // Envoyer la requête avec les données en JSON
    xhr.send(JSON.stringify(postData));
}

function addXp(xpToAdd){
    xp += Number(xpToAdd);
    UpdateLvl();
}

function UpdateLvl(){
    let width = ((xp/goal_xp)*100);
    correctTextInBar(width, xpBar);
    lvl_text.textContent = level;
    nextLvl_text.textContent = nextLevel;
    xp_text.textContent = xp;
    goalXp_text.textContent = goal_xp.toFixed(0);
    xpBar.style.width = width + "%";
    boost = 1-(level/100);
    if(path === "myAccount.php"){
        currentBoost_text.textContent = "Boost actuel : x" + boost.toFixed(2);
    }
    canNextLevel();
    ajaxPostLevel({ level: level, xp: xp, goal_xp: goal_xp });
}



function plannedXpAdded(temp_xp){
    let xpGained_text = document.querySelector("#xpGained");
    let xpAddedBar_text = document.querySelector("#xpAddedBar");
    let _lvl_text = document.querySelector(".popup #level");
    let _nextLvl_text = document.querySelector(".popup #next_level");
    let _xp_text = document.querySelector(".popup #xp");
    let _goalXp_text = document.querySelector(".popup #goal_xp");
    let _xpBar = document.querySelector(".popup .progressbar_inner");
    let second_bar = document.querySelector(".progressbar_inner_second");


    let width = ((xp/goal_xp)*100);
    correctTextInBar(width, _xpBar);
    xpGained_text.textContent = temp_xp + " xp";
    xpAddedBar_text.textContent = "(+" + temp_xp + ")";
    _lvl_text.textContent = level;
    _nextLvl_text.textContent = nextLevel;
    _xp_text.textContent = xp;
    _goalXp_text.textContent = goal_xp.toFixed(0);
    _xpBar.style.width = width + "%";
    if((((xp+temp_xp)/goal_xp)*100) <= goal_xp){
        second_bar.style.width = (((xp+temp_xp)/goal_xp)*100) + "%";
    }
    else{
        second_bar.style.width = 97 + "%";
    }
    addXp(Number(temp_xp));
}

function correctTextInBar(width, selectedXpBar){
    if(width < 60 && url !== "myAccount.php"){
        addBarClass(selectedXpBar);
    }
    else if(width > 85){
        addBarClass(selectedXpBar);
    }
    else if(width < 30 && url === "myAccount.php"){
        addBarClass(selectedXpBar);
    }
    else{
        removeBarClass(selectedXpBar);
    }
}

function canNextLevel(){
    while(xp >= goal_xp){
        level++;
        nextLevel++;
        xp -= goal_xp;
        goal_xp *= 1.05;
        UpdateLvl();
        if(path === "profile.php" || path === "myAccount.php"){
            checkAvatarBorder();
        }
    }
}


function addBarClass(selectedXpBar){
    selectedXpBar.classList.remove('progressbar_inner_small');
    selectedXpBar.classList.add('progressbar_inner_small');
}

function removeBarClass(selectedXpBar){
    selectedXpBar.classList.add('progressbar_inner_small');
    selectedXpBar.classList.remove('progressbar_inner_small');
}


function checkAvatarBorder(){
    let avatarBorder = document.querySelector("#avatarBorder");
    let imgIndex = 0;
    if (level >= 0 && level < 5) {
        imgIndex = 1;
    } else if (level >= 5 && level < 10) {
        imgIndex = 2;
    } else if (level >= 10 && level < 15) {
        imgIndex = 3;
    } else if (level >= 15 && level < 20) {
        imgIndex = 4;
    } else if (level >= 20 && level < 21) {
        imgIndex = 5;
    } else if (level >= 25 && level < 30) {
        imgIndex = 6;
    } else if (level >= 30 && level < 35) {
        imgIndex = 7;
    } else if (level >= 35 && level < 40) {
        imgIndex = 8;
    } else if (level >= 40) {
        imgIndex = 9;
    }
    avatarBorder.src = `assets/images/avatarBorder/Level${imgIndex}.png`;
}