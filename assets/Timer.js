let timeTimer = 0;
let isPlaying = true;

function getTimeInHoursMinutes(seconds) {
    const t = Math.round(seconds);
    if (t <= 3600) {
        return `${String(Math.floor(t / 60) % 60).padStart(2, '0')}min ${String(t % 60).padStart(2, '0')}sec`;
    } else {
        return `${String(Math.floor(t / 3600)).padStart(2, '0')}h${String(Math.floor(t / 60) % 60).padStart(2, '0')}min${String(t % 60).padStart(2, '0')}sec`;
    }
}

// METTRE BORDURE SUR IMAGE + PETIT MEDAILLON QUI FAIS OFFICE DE MEDAILLE EN BAS A GAUCHE DE L'IMAGE OU QUELQUE PART AUTRE
// Pouvoir voir les profils des autres utilisateurs
function UpdateTimer(){
    if(isPlaying){
        timeTimer++;
        document.getElementById("time").textContent = getTimeInHoursMinutes(timeTimer);
    }
}