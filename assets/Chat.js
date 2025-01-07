
ajaxGetMessages();
document.querySelector('#form1').addEventListener('submit', function (event) {
    event.preventDefault();

    let messages = document.querySelector('#messages');
    let messageText = messages.value;

    // Vérifier si le message n'est pas vide
    if (messageText.length < 3) {
        alert("Le message doit contenir au moins 3 caractères");
    }
    else{
        var postData = {
            id_jeu: 1,
            message: messageText,
        };

        ajaxPost(postData); // Envoi des données au serveur
        messages.value = ''; // Vider le champ de saisie après envoi
    }
});

function ajaxPost(data) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "assets/post.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response); // Afficher les données de la réponse
            ajaxGetMessages();
        }
    };
    xhr.send(JSON.stringify(data));
}

function getHowMuchTimeItWasSend(temp){
    const targetDate = new Date(temp);
    const currentDate = new Date();

    const diffInMs = Math.abs(currentDate - targetDate); // Prendre la valeur absolue pour éviter les négatifs

    const diffInMinutes = Math.floor(diffInMs / (1000 * 60));
    const hours = Math.floor(diffInMinutes / 60);
    const minutes = diffInMinutes % 60;
    if(hours === 0){
        return minutes + "min";
    }
    else{
        return hours + "h " + minutes + "min";
    }
}

function appendNewChild(data) {
    for(data_component in data.message){
        let box = document.querySelector('.textzone');

        // Créer un nouvel élément pour le message
        let messageBox = document.createElement("div");
        messageBox.classList.add("messagebox");

        if(data.session === data.message[data_component].id_exp){
            messageBox.classList.add("moi");
        }
        // Contenu HTML du nouveau message
        messageBox.innerHTML = `
        <div>
            <p class="author">${data.message[data_component].pseudo}</p>
            <p class="text">${data.message[data_component].message}</p>
            <p class="date">Il y a ${getHowMuchTimeItWasSend(data.message[data_component].date_temps_mess)}</p>
        </div>
    `;
        // Ajouter le nouveau message à la zone de chat
        box.appendChild(messageBox);
    }
}


function ajaxGetMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "assets/get.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let data = JSON.parse(xhr.responseText);
            console.log(data);
            clearMessages();
            appendNewChild(data);
        }
    };
    xhr.send();
}

function clearMessages(){
    let box = document.querySelector('.textzone');
    box.innerHTML = "";
}