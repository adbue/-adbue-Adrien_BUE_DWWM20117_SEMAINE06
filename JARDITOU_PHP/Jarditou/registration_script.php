<?php
// Set timezone
date_default_timezone_set("Europe/Paris");

// Fonction Sanitizing Input
    require ('01_inc/functions.inc.php');
// Sanitize input
    $nom = sanitizing($_POST["Nom"]);
    $prenom = sanitizing($_POST["Prenom"]);
    $mail = sanitizing($_POST["Email"]);
    $login = $mail;
    $pass = sanitizing($_POST["Pass"]);
    $valid_pass = $pass;

// REGEX
    $pattern_nom = "/^[a-zA-ZéèîïÉÈÎÏ][a-zA-ZéèîïÉÈÎÏ]+([-'][a-zA-ZéèîïÉÈÎÏ][a-zA-Zéèîïç]+)?$/";
    $pattern_prenom = "/^[a-zA-ZéèîïÉÈÎÏ][a-zA-ZéèîïÉÈÎÏ]+([-'][a-zA-ZéèîïÉÈÎÏ][a-zA-Zéèîïç]+)?$/";
    $pattern_email = "/^[a-z0-9._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,4}$/";
    $pattern_pass = "/^[a-zA-Z]\w{7,20}$/";

    


    if (!empty($_POST["Email"]) && preg_match($pattern_email,$_POST["Email"])
    &&  !empty($_POST["Pass"]) && preg_match($pattern_pass , $_POST["Pass"])
    && !empty($_POST["Nom"]) && preg_match($pattern_nom ,$_POST["Nom"])
    &&!empty($_POST["Prenom"]) && preg_match( $pattern_prenom ,$_POST["Prenom"])
    && $_POST["V_Pass"] == $_POST["Pass"])
    {
        // Crypto
        $passHashed = password_hash($pass, PASSWORD_DEFAULT);

        // Date d'inscription
        $d_regis = date('Y-m-d H:i:s');

        // Connexion à la BDD
        include('connexion_bdd.php');
        $db = connexionBase();

        // Requête Insertion
        try {
            $request = $db->prepare("INSERT INTO users (us_nom,us_prenom,us_mail,us_login,us_pass,us_d_regis) 
            VALUES (:us_nom,:us_prenom,:us_mail,:us_login,:us_pass,:us_d_regis)");

            $request->bindValue(":us_nom",$nom);
            $request->bindValue(":us_prenom",$prenom);
            $request->bindValue(":us_mail",$mail);
            $request->bindValue(":us_login",$mail);
            $request->bindValue(":us_pass",$passHashed);
            $request->bindValue(":us_d_regis",$d_regis);

            $request->execute();

            // Envoi l'utilisateur/trice vers la page de connexion
            header("Location: login.php?msg=Create");

        } catch (Exception $e) {
            echo "La connexion à la base de données a échoué ! <br>";
            echo "Merci de bien vérifier vos paramètres de connexion ...<br>";
            echo "Erreur : " . $e->getMessage() . "<br>";
            echo "N° : " . $e->getCode();
            die("Fin du script");
        }

        $request->closeCursor();

    } else 
    {
        // Au cas où JS est désactivé , ensemble de messages pour informer l'utilisateur de son erreur/ses erreurs globalement

        if (empty($_POST["Pass"])) {header("location: registration.php?error=empty"); exit();}
        if (empty($_POST["V_Pass"])) {header("location: registration.php?error=empty"); exit();}
        if (empty($_POST["Nom"])) {header("location: registration.php?error=empty"); exit();}
        if (empty($_POST["Prenom"])) {header("location: registration.php?error=empty"); exit();}
        if (empty($_POST["Email"])) {header("location: registration.php?error=empty"); exit();} 

        if (!preg_match($pattern_login, $_POST["Pass"])) {header("location: registration.php?error=invalid"); exit();}
        if ($_POST["V_Pass"] !== $_POST["Pass"]) {header("location: registration.php?error=invalid"); exit();}
        if (!preg_match($pattern_login, $_POST["Nom"])) {header("location: registration.php?error=invalid"); exit();}
        if (!preg_match($pattern_login, $_POST["Prenom"])) {header("location: registration.php?error=invalid"); exit();}
        if (!preg_match($pattern_login, $_POST["Email"])) {header("location: registration.php?error=invalid"); exit();}
        
    }


