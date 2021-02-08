<?php
session_start();


if(isset($_POST["submit"]))
{
    require_once("01_inc/functions.inc.php");

    // Sanitize input
        $login = sanitizing($_POST["Login"]);
        $pass = sanitizing($_POST["Pass"]);


    if (isset($_POST["Login"]) && !empty($_POST["Login"])
        && isset($_POST["Pass"]) && !empty($_POST["Pass"])) 
    {
        //  Connexion à la base de donnée
        require_once("connexion_bdd.php");
        $db = connexionBase();

        if (loginValid($db, $login, $pass) == true) 
        {
            $request = $db->prepare("SELECT * FROM users WHERE us_login=?");
            $request->execute(array($login));
            $row = $request->fetch(PDO::FETCH_ASSOC);

            $_SESSION["nom"] = $row["us_nom"];
            $_SESSION["prenom"] = $row["us_prenom"];
            if ($row["us_role"] == 1 ) {
                $_SESSION["role"] = "admin";
            } else {
                $_SESSION["role"] = "client";
            }
            header("Location: index.php");
            exit();

        } else 
        {
            header("Location: login.php?error=invalidInputs");
            exit();
        }


        } else {
            // Par précaution
            header("Location: login.php?error=emptyInput");
            exit();
        }
}