let nom = document.getElementById("nom");
let nom_m = document.getElementById("nom_m");

let prenom = document.getElementById("prenom");
let prenom_m = document.getElementById("prenom_m");

let email = document.getElementById("email");
let email_m = document.getElementById("email_m");

let pass = document.getElementById("pass");
let pass_m = document.getElementById("pass_m");

let v_pass = document.getElementById("v_pass");
let v_pass_m = document.getElementById("v_pass_m");


let nom_v = /^[a-zA-ZéèîïÉÈÎÏ][a-zA-ZéèîïÉÈÎÏ]+([-'][a-zA-ZéèîïÉÈÎÏ][a-zA-Zéèîïç]+)?$/;
let prenom_v= /^[a-zA-ZéèîïÉÈÎÏ][a-zA-ZéèîïÉÈÎÏ]+([-'][a-zA-ZéèîïÉÈÎÏ][a-zA-Zéèîïç]+)?$/;
let email_v = /^[a-z0-9._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,4}/;
let pass_v = /^[a-zA-Z]\w{7,20}$/;


let formValid = document.getElementById("bouton_envoi"); 
formValid.addEventListener ("click", f_valid);

function f_valid(e) 
{

    if(nom.value === "")
    {
        e.preventDefault();
        nom_m.textContent = "Veuillez saisir votre nom";
        nom_m.style.color = "red";
    }
    else if(nom_v.test(nom.value) == false)
    {
        e.preventDefault();
        nom_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
        nom_m.style.color = "orange";
    }
    else 
    {
        nom_m.textContent = "Correct";
        nom_m.style.color = "green";
    }

    if(prenom.value === "")
    {
        e.preventDefault();
        prenom_m.textContent = "Veuillez saisir votre prénom";
        prenom_m.style.color = "red";
    }
    else if (prenom_v.test(prenom.value) == false)
    {
        e.preventDefault();
        prenom_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
        prenom_m.style.color = "orange";
    }
    else
    {
        prenom_m.textContent = "Correct";
        prenom_m.style.color = "green";
    }

    if (email.value === "")
    {
        e.preventDefault();
        login_m.textContent = "Veuillez indiquer votre adresse mail";
        login_m.style.color = "red";
    }
    else if (email_v.test(email.value) == false)
    {
        e.preventDefault();
        email_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
        email_m.style.color = "orange";
    }
    else
    {
        email_m.textContent = "Correct";
        email_m.style.color = "green";
    }

    if (pass.value === "")
    {
        e.preventDefault();
        pass_m.textContent = "Veuillez saisir un mot de passe";
        pass_m.style.color = "red";
    }
    else if (pass_v.test(pass.value) == false)
    {
        e.preventDefault();
        pass_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
        pass_m.style.color = "orange";
    }
    else
    {
        pass_m.textContent = "Correct";
        pass_m.style.color = "green";
    }

    if ( pass.value != v_pass.value) {
        e.preventDefault();
        v_pass_m.textContent = "Ce mot de passe n'est pas identique au premier.";
        v_pass_m.style.color = "red";
    } else {
        v_pass_m.textContent = "Correct";
        v_pass_m.style.color = "green";
    }

}


