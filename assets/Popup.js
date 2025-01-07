function showPopUp(difficulty){
    isPlaying = false;
    xpGainedMemory = Number(difficulty) + (100 * boost.toFixed(2) / Math.sqrt(Number(timeTimer) + 1));
    plannedXpAdded(Math.round(Number(xpGainedMemory)));
    timeText = document.getElementById("showTime");
    popup = document.querySelector(".popup");
    timeText.textContent = getTimeInHoursMinutes(timeTimer);
    popup.classList.toggle("hide");
}