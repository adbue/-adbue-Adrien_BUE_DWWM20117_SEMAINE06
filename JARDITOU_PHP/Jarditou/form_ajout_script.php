<?php
session_start();

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
    $date_d_ajout = date('Y-m-d');


    // REGEX

    $pattern_id    = "/^[\d]{1,6}$/";
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
            // On met les types autorisés dans un tableau (ici pour une image)
            $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

            // On ouvre l'extension FILE_INFO
            $finfo = finfo_open(FILEINFO_MIME_TYPE);

            // On extrait le type MIME du fichier via l'extension FILE_INFO 
            $mimetype = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);

            // On ferme l'utilisation de FILE_INFO 
            finfo_close($finfo);

            if (in_array($mimetype, $aMimeTypes))
            {
                $extension = substr(strrchr($_FILES["fichier"]["name"], "."), 1);
                $location = "00_rsrc/src/img/$id.$extension";
                move_uploaded_file($_FILES['photo']['tmp_name'], $location);
            } 
            else 
            {
               // Le type n'est pas autorisé, donc ERREUR
                echo "Type de fichier non autorisé";    
                exit;
            }    
            require("connexion_bdd.php");


            $db = ConnexionBase();

            $request = $db->prepare("INSERT INTO produits (pro_id,pro_cat_id,pro_ref,pro_libelle,pro_description,pro_prix,pro_stock,pro_couleur,pro_d_ajout,pro_bloque)
                                    VALUES (:pro_id,:pro_cat_id,:pro_ref,:pro_libelle,:pro_description,:pro_prix,:pro_stock,:pro_couleur,:pro_d_ajout,:pro_bloque)");

            $request->bindValue(":pro_id",$id);
            $request->bindValue(":pro_cat_id",$cat);
            $request->bindValue(":pro_ref",$ref);
            $request->bindValue(":pro_libelle",$lib);
            $request->bindValue(":pro_decription",$desc);
            $request->bindValue(":pro_prix",$prix);
            $request->bindValue(":pro_stock",$stock);
            $request->bindValue(":pro_couleur",$color);
            $request->bindValue(":pro_d_ajout",$date_d_ajout);
            $request->bindValue(":pro_bloque",$bloque);

            $request->execute();

            $request->closeCursor();

            header("Location: list.php/msg=add");
            exit();

        } catch (Exception $e) 
        {
            echo "La connexion à la base de données a échoué ! <br>";
            echo "Merci de bien vérifier vos paramètres de connexion ...<br>";
            echo "Erreur : " . $e->getMessage() . "<br>";
            echo "N° : " . $e->getCode();
            die("Fin du script");
        }
    } else {
        header("Location: form_ajout.php/error");
    }
}