<?php
session_start();
// Set timezone
date_default_timezone_set("Europe/Paris");

if(isset($_POST["submit"]))
{
    require ('01_inc/functions.inc.php');

    // Sanitize input

    $id           = sanitizing($_POST["id"]);
    $ref          = sanitizing($_POST["ref"]);
    $cat          = sanitizing($_POST["cat"]);
    $lib          = sanitizing($_POST["lib"]);
    $desc         = sanitizing($_POST["desc"]);
    $prix         = sanitizing($_POST["prix"]);
    $stock        = sanitizing($_POST["stock"]);
    $color        = sanitizing($_POST["color"]);
    $bloque       = sanitizing($_POST["bloque"]);
    $date_d_modif = date('Y-m-d H:i:s');


    // REGEX

    $pattern_id   = "/^[\d]{1,6}$/";
    $pattern_ref   = "/^[\w-]{1,10}$/";
    $pattern_lib   = "/^[\D\d]{1,200}$/";
    $pattern_desc  = "/^[\D\d]{1,1000}$/";
    $pattern_prix  = "/^([0-9]{1,6})(\.[0-9]{2})?$/";
    $pattern_stock = "/^[\d]{1,6}$/";
    $pattern_color = "/^[\D]{1,30}$/";


    if (!empty($_POST["id"]) && preg_match($pattern_id ,$id)
    &&  !empty($_POST["ref"]) && preg_match($pattern_ref ,$ref)
    &&  isset($_POST["cat"])  
    &&  !empty($_POST["lib"]) && preg_match($pattern_lib ,$lib)
    &&  !empty($_POST["desc"]) && preg_match($pattern_desc ,$desc)
    &&  !empty($_POST["prix"]) && preg_match($pattern_prix ,$prix)
    &&  !empty($_POST["stock"]) && preg_match($pattern_stock ,$stock)
    &&  !empty($_POST["color"]) && preg_match($pattern_color ,$color)
    &&  isset($_POST["bloque"]))
    {
        try
        {
            require("connexion_bdd.php");

            $db = ConnexionBase();
            

            $request = $db->prepare("UPDATE produits 
            SET pro_cat_id=:pro_cat_id,
                pro_ref=:pro_ref,
                pro_libelle=:pro_libelle,
                pro_description=:pro_decription,
                pro_prix=:pro_prix,
                pro_stock=:pro_stock,
                pro_couleur=:pro_couleur,
                pro_d_modif=:pro_d_modif,
                pro_bloque=:pro_bloque
            WHERE pro_id=:pro_id");

            $request->bindValue(":pro_id",$id);
            $request->bindValue(":pro_cat_id",$cat);
            $request->bindValue(":pro_ref",$ref);
            $request->bindValue(":pro_libelle",$lib);
            $request->bindValue(":pro_decription",$desc);
            $request->bindValue(":pro_prix",$prix);
            $request->bindValue(":pro_stock",$stock);
            $request->bindValue(":pro_couleur",$color);
            $request->bindValue(":pro_d_modif",$date_d_modif);
            $request->bindValue(":pro_bloque",$bloque);

            $request->execute();

            $request->closeCursor();

            // Envoi l'utilisateur/trice vers la page liste
            header("Location: list.php?msg=update");
            exit();


        } catch (Exception $e) {
            echo "La connexion à la base de données a échoué ! <br>";
            echo "Merci de bien vérifier vos paramètres de connexion ...<br>";
            echo "Erreur : " . $e->getMessage() . "<br>";
            echo "N° : " . $e->getCode();
            die("Fin du script");
        }
    } else{
        header("Location: form_modifs.php?error");
    }


}