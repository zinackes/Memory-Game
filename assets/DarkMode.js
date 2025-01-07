var swiper = new Swiper(".PVZ", {
    effect: "cards",
    grabCursor: true,
    pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

document.documentElement.classList.add('dark_theme');

function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    document.documentElement.className = themeName;
    if (localStorage.getItem('theme') === 'white_theme') {
        document.getElementById('ToggleTheme').checked = true;
    }
}

// function to toggle between light and dark theme
function ToggleTheme(checkBox) {
    if (!checkBox.checked) {
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

EasterEggBtn = document.querySelector('.title button');

if(EasterEggBtn) {
    EasterEggBtn.addEventListener('click', () => {
        document.body.classList.toggle('rotate');
    })
}