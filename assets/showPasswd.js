console.log("start showPasswd.js");
showPasswd = true;
function changer() {
    if (showPasswd) {
        document.getElementById('password').setAttribute('type', 'text');
        document.getElementById('eye').src = "assets/green_eye.png";
        showPasswd = false;
    }
    else {
        document.getElementById('password').setAttribute('type', 'password');
        document.getElementById('eye').src = "assets/red_eye.png";
        showPasswd = true;
    }
}

console.log("end showPasswd.js");