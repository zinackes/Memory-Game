function updatePasswordStrength(){
    let textField = document.querySelector('#password');
    let progress = document.querySelector('.passwordChecker_inner');
    if(textField.value.length === 0){
        progress.classList.remove('medium_password');
        progress.classList.remove('weak_password');
        progress.classList.remove('strong_password');
    }
    if(textField.value.length > 0){
        progress.classList.add('weak_password');
        if((/[A-Z]/.test(textField.value) && /[0-9]/.test(textField.value)) && textField.value.length > 7){
            progress.classList.remove('weak_password');
            progress.classList.add('medium_password');
            if(/[^A-Za-z0-9]/.test(textField.value)){
                progress.classList.remove('medium_password');
                progress.classList.add('strong_password');
            }else{
                progress.classList.remove('strong_password');
                progress.classList.add('medium_password');
            }
        }else{
            progress.classList.remove('strong_password')
            progress.classList.remove('medium_password');
            progress.classList.add('weak_password');
        }
    }else{
        progress.classList.remove('weak_password');
    }
}
