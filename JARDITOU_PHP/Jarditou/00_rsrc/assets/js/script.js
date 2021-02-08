// Ensemble des éléments présent dans le formulaire et affectés à une variable par le biais d'un id
/*   Message d'erreur == > 
Création d'un span avec id = "xxx_m" sur le document HTML en cas d'erreur ou de non remplissage, ce span nous sert à afficher un message en dessous ou à cotes de l'élément 
pour indiquer à l'utilisateur/trice son oubli ou son erreur.
*/

let nom = document.getElementById("nom");
let nom_m = document.getElementById("nom_manquant");

let prenom = document.getElementById("prenom");
let prenom_m = document.getElementById("prenom_manquant");

let date_de_naiss = document.getElementById("date_de_naissance");
let date_de_naiss_m = document.getElementById("date_de_naiss_manquant");

let sexe= document.getElementById("sexe");
let sexe_m = document.getElementById("sexe_manquant");

let cp = document.getElementById("code_postal");
let cp_m = document.getElementById("code_manquant");

let adresse = document.getElementById("adresse");
let adresse_m = document.getElementById("adresse_manquant");

let ville = document.getElementById("ville");
let ville_m = document.getElementById("ville_manquant");

let email = document.getElementById("email");
let email_m = document.getElementById("email_manquant");

let sujet = document.getElementById("sujet");
let sujet_m = document.getElementById("sujet_manquant");

let question = document.getElementById("question");
let question_m = document.getElementById("question_manquant");

let checkbx = document.getElementById("utilisateur_accepte_les_termes");
let checkbx_m = document.getElementById("utilisateur_accepte_les_termes_manquant");


// REGEX pour certaines variables


let nom_v =/^[a-zA-ZéèîïÉÈÎÏ][a-zA-ZéèîïÉÈÎÏ]+([-'][a-zA-ZéèîïÉÈÎÏ][a-zA-Zéèîïç]+)?$/; // Regex présent dans le cours 

let prenom_v =/^[a-zA-ZéèîïÉÈÎÏ][a-zA-ZéèîïÉÈÎÏ]+([-'][a-zA-ZéèîïÉÈÎÏ][a-zA-Zéèîïç]+)?$/; // Regex présent dans le cours 

let date_de_naiss_v = /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/; // Regex présent dans le cours mais modifié ajout d'une limitation, de plus de précision  et ajout \/ pour intégrer les /.

let cp_v = /^[0-9]{5}$/; //  code postal obligation d'entrer cinq chiffres

/*
    Cas particulier == >
    j'ai suivi le modèle HTML du formulaire. C'est-à-dire que la saisie de données sur les éléments Adresse et Ville sont faculatives pour la validation de l'envoi du formulaire au serveur.
    Par contre si l'utilisateur/trice souhaite remplir ses éléments, il/elle doit respecter la nomenclature afin de valider l'envoi du formulaire.
    Les deux lois se trouvent en dessous
*/

let adresse_v = /^[0-9]{1,4}[,]+[\D]+$/; // regex Numéro, nom de la rue

let ville_v = /^[\D]+([-\s][\D]+)?$/; // regex ville (ex: Paris ou Plachy-Buyon valide) 



let email_v =  /^[a-z0-9._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,4}/; // Regex présent dans le cours + ajout. Notamment "[.]{1}" sans ça la validation se fait avec dave.loper@afpa

let question_v =/^([\w.,><!?-€%^_`'"~+-/{}=() ]{6,500})$/; // Regex text-area limite à 500 caractères et minimum 6.

// FONCTION VERIFICATRICE

let formValid = document.getElementById("bouton_envoi"); //variable qui cible le bouton "submit" dans le document html 
formValid.addEventListener ("click", f_valid); // gestionnaire event type click avec á l'intérieur de notre fonction de validation

// Si il n'y a aucunes valeurs ou si les valeurs sont éronnés ou ne correspondent pas aux nomenclatures, un message apparaît sous l'élément et l'envoie du formulaire ne se fait pas (preventDefault())
// Chaque éléments présent dans le formulaire est repertoriés dans la fonction
// SI toutes les conditions sont vraies, le formulaire est envoyé au serveur.

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


        if(date_de_naiss.value === "")
        {
            e.preventDefault();
            date_de_naiss_m.textContent = "Veuillez saisir votre date de naissance";
            date_de_naiss_m.style.color = "red";
        }
        else if(date_de_naiss_v.test(date_de_naiss.value) == false)
        {
            e.preventDefault();
            date_de_naiss_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
            date_de_naiss_m.style.color = "orange";
        }
        else 
        {
            date_de_naiss_m.textContent = "Correct";
            date_de_naiss_m.style.color = "green";
        }


        if(sexe.validity.valueMissing)
        {
            e.preventDefault();
            sexe_m.textContent = "Veuillez choisir une option";
            sexe_m.style.color = "red";
        }
        else
        {
            sexe_m.textContent = "Correct";
            sexe_m.style.color = "green";
        }


        if (cp.value === "")
        {
            e.preventDefault();
            cp_m.textContent = "Veuillez indiquer votre code postal";
            cp_m.style.color = "red";
        }
        else if (cp_v.test(cp.value) == false)
        {
            e.preventDefault();
            cp_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
            cp_m.style.color = "orange";
        }
        else
        {
            cp_m.textContent = "Correct";
            cp_m.style.color = "green";
        }


        if (adresse.value === "")
        {
            adresse_m.textContent = "Facultatif*, mais si vous dérirez répondre, je vous prie de bien vouloir suivre la nomenclature (ex: N°, Rue)";
            adresse_m.style.color = "blue";
        }
        else if (adresse_v.test(adresse.value) == false)
        {
            e.preventDefault();
            adresse_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
            adresse_m.style.color = "orange";
        }
        else
        {
            adresse_m.textContent = "Correct";
            adresse_m.style.color = "green";
        }


        if (ville.value === "")
        {
            ville_m.textContent = "Facultatif*, mais si vous dérirez répondre, je vous prie de bien vouloir suivre la nomenclature (ex: Paris)";
            ville_m.style.color = "blue";
        }
        else if (ville_v.test(ville.value) == false)
        {
            e.preventDefault();
            ville_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
            ville_m.style.color = "orange";
        }
        else
        {
            ville_m.textContent = "Correct";
            ville_m.style.color = "green";
        }


        if (email.value === "")
        {
            e.preventDefault();
            email_m.textContent = "Veuillez indiquer votre adresse mail";
            email_m.style.color = "red";
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


        if(sujet.validity.valueMissing)
        {
            e.preventDefault();
            sujet_m.textContent = "Veuillez choisir une option";
            sujet_m.style.color = "red";
        }
        else
        {
            sujet_m.textContent = "Correct";
            sujet_m.style.color = "green";
        }


        if(question.value === "")
        {
            e.preventDefault();
            question_m.textContent = "Veuillez nous informer de votre/vos problème(s)";
            question_m.style.color = "red";
        }
        else if(question_v.test(question.value) == false)
        {
            e.preventDefault();
            question_m.textContent = "Votre saisie est incorrecte merci de vérifier les données saisies";
            question_m.style.color = "orange";
        }
        else
        {
            question_m.textContent = "Correct";
            question_m.style.color = "green";
        }


        if(checkbx.validity.valueMissing)
        {
            e.preventDefault();
            checkbx_m.textContent = "Veuillez confirmer pour valider le formulaire";
            checkbx_m.style.color = "red";
        }
        else
        {
            checkbx_m.textContent = "Correct";
            checkbx_m.style.color = "green";
        }
        
}
