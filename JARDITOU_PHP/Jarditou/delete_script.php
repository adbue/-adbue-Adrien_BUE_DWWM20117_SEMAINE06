<?php
require 'connexion_bdd.php';

$db = connexionBase();

$pro_id = filter_input(INPUT_GET, 'pro_id', FILTER_SANITIZE_URL);


$request = $db->prepare("DELETE FROM produits WHERE pro_id=:id");

$request->bindValue(":id", $pro_id, PDO::PARAM_INT);

$request->execute();

$request->closeCursor();

// Envoi l'utilisateur/trice vers la page liste
header("Location: list.php?msg=delete");
exit();
?>