<?php
session_start();

$_SESSION["nom"] = "";
$_SESSION["prenom"] = "";
$_SESSION["role"] = "";

unset($_SESSION["nom"]);
unset($_SESSION["prenom"]);
unset($_SESSION["role"]);

if (ini_get("session.use_cookies")) 
{
    setcookie(session_name(), '', time()-1, null, false, true);
}

session_destroy();

header("Location: index.php?disco");
exit();
