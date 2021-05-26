function changeModal() {
    if (modal_Login.style.display === "none" || modal_Login.getAttribute("style") == null) {
        modal_Login.style.display = "block"
    } else {
        modal_Login.style.display = "none"
    }
    if (modal_register.style.display === "none" || modal_register.getAttribute("style") == null) {
        modal_register.style.display = "block"
    } else {
        modal_register.style.display = "none"
    }
}

function validacionEmail(email) {
    const patron = /\S+@\S+\.\S+/;
    if (!patron.test(email.value)) //Regular expressions to validate email
    {
        email.classList.add("borderRed");
    } else {
        email.classList.remove("borderRed");
        email.classList.add("borderGreen");
    }


}

function validacionUsername(username) {
    const patron = /^[a-zA-Z]*$/g;
    if (!patron.test(username.value)) {
        username.style.borderColor = 'red';
    } else {
        username.style.borderColor = 'green'
    }
}

function validacionPasswd(password) {

    if (password.value.length < 4) {
        password.classList.add("borderRed");
    } else if (password.value.search(/[a-z]/) < 0) {
        password.classList.add("borderRed");
    } else if (password.value.search(/[A-Z]/) < 0) {
        password.classList.add("borderRed");
    } else if (password.value.search(/[0-9]/) < 0) {
        password.classList.add("borderRed");
    } else {
        password.classList.remove("borderRed");
        password.classList.add("borderGreen");
    }
}

function validacionPasswd2() {
    let password2 = document.getElementById("password2")
    let password = document.getElementById("reg_password")
    if (password2.value.length==0 || password2.value != password2.value) {
        if(password2.classList.contains("borderGreen"))
            password2.classList.remove("borderGreen")
        password2.classList.add("borderRed");
    } else {
        if(password2.classList.contains("borderRed"))
            password2.classList.remove("borderRed")
        password2.classList.add("borderGreen");
    }
}


function submitClick(e) {

    if (formValidation()) {
        alert("Registro con éxito");
        return true;
    } else {
        e.preventDefault();
        return false;
    }
}

function formValidation() {
    let email = document.getElementById('email')
    let username = document.getElementById("username")
    let password = document.getElementById("password")
    let password2 = document.getElementById("password2")
    const patronEm = /\S+@\S+\.\S+/;
    let flag = true;


    // Validar solo letras en el nombre
    if (!/^[a-zA-Z]*$/g.test(username.value)) {
        alert("Introduce un usuario válido");
        flag = false;
    }

    // Validar un email correcto
    if (!patronEm.test(email.value)) //Regular expressions to validate email
    {
        alert("Introduce un email válido");
        flag = false;
    }

    // Comprobando que la contraseña sea correcta
    if (password.value.length < 4) {
        alert("Introduce una contraseña de 4 carácteres o más")
        flag = false;
    } else if (password.value.search(/[a-z]/) < 0) {
        alert("La contraseña necesita al menos una minúscula")
        flag = false;
    } else if (password.value.search(/[A-Z]/) < 0) {
        alert("La contraseña necesita al menos una mayúscula")
        flag = false;
    } else if (password.value.search(/[0-9]/) < 0) {
        alert("La contraseña necesita al menos un número")
        flag = false;
    }

    if (password2 !== password) {
        alert("Las contraseñas no coinciden")
        flag = false;
    }

    return flag;

}