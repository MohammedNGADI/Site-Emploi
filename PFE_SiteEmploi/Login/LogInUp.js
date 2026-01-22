function moveLoginNoneleft() {

    const loginNoneDiv = document.querySelector('.login_none');
    loginNoneDiv.style.right = '50%'; 
    loginNoneDiv.style.transform = 'translateX(-50%)'; 
    loginNoneDiv.style.borderTopLeftRadius = '0px';
    loginNoneDiv.style.borderBottomLeftRadius = '0px';
    loginNoneDiv.style.borderBottomRightRadius = '7px';
    loginNoneDiv.style.borderTopRightRadius = '7px';
    console.log('gauche');

}

function moveLoginNoneRight () {
    const loginNoneDiv = document.querySelector('.login_none');
    loginNoneDiv.style.right = '-50%'; 
    loginNoneDiv.style.transform = 'translateX(-50%)'; 
    loginNoneDiv.style.borderTopLeftRadius = '7px';
    loginNoneDiv.style.borderBottomLeftRadius = '7px';
    loginNoneDiv.style.borderBottomRightRadius = '0px';
    loginNoneDiv.style.borderTopRightRadius = '0px';
    console.log('droit');

}




const showHiddenPass = (loginPass, loginEye) => {
const input = document.getElementById(loginPass);
const iconEye = document.getElementById(loginEye);

iconEye.addEventListener('click', () => {
    if (input.type === 'password') {
        input.type = 'text';

        iconEye.classList.add('ri-eye-line');
        iconEye.classList.remove('ri-eye-off-line');
    } else {
        input.type = 'password';

        iconEye.classList.remove('ri-eye-line');
        iconEye.classList.add('ri-eye-off-line');
    }
});
};
function validateForm() {
    var password = document.getElementById("register_pass").value;
    var email = document.getElementById("register_email").value;
    var confirmPassword = document.getElementById("Conf_register_pass").value;
    var incorrectVerification = document.getElementsByClassName("incorrectVerifivcation");
    var registerLabel = document.getElementsByClassName("register__label");
    var emailError = document.getElementById("emailError");
    var passwordError = document.getElementById("passwordError");
    var confirmPasswordError = document.getElementById("confirmPasswordError");
    
   
    
    if (email.trim() === "") {
        emailError.style.display = "block";
        return false;
    } else {
        emailError.style.display = "none";
    }

    if (password.trim() === "") {
        passwordError.style.display = "block";
        return false;
    } else {
        passwordError.style.display = "none";
    }

    if (confirmPassword.trim() === "") {
        confirmPasswordError.style.display = "block";
        return false;
    } else {
        confirmPasswordError.style.display = "none";
    }
    
    if (password.length < 8 && confirmPassword.length < 8) {
        emailError.innerHTML = "Le mot de passe doit contenir au moins 8 caractères." ;
        emailError.style.display = "block";
        emailError.style.top = "-35px";
        return false;
        }
        else {
            emailError.style.display = "none";
        }

    if (password !== confirmPassword) {
        for (var i = 0; i < registerLabel.length; i++) {
            registerLabel[i].classList.add('shake');
            setTimeout(function() {
                for (var j = 0; j < registerLabel.length; j++) {
                    registerLabel[j].classList.remove('shake');
                }
            }, 500);
        }
        for (var i = 0; i < incorrectVerification.length; i++) {
            incorrectVerification[i].style.display = "block";
        }
        return false;
    }

    return true;
}








