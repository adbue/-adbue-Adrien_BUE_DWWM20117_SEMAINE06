<?php
session_start();

date_default_timezone_set("Europe/Paris");

if(isset($_POST["submit"]))
{
    require ('01_inc/functions.inc.php');


    // Sanitize input

    $id    = sanitizing($_POST["id"]);
    $ref   = sanitizing($_POST["ref"]);
    $cat   = sanitizing($_POST["cat"]);
    $lib   = sanitizing($_POST["lib"]);
    $desc  = sanitizing($_POST["desc"]);
    $prix  = sanitizing($_POST["prix"]);
    $stock = sanitizing($_POST["stock"]);
    $color = sanitizing($_POST["color"]);
    if($_POST['bloque'] == "0") {
        $bloque = NULL;
    }else{
        $bloque = 1;
    }
    
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
            require("connexion_bdd.php");


            $db = ConnexionBase();

            if($_FILES['image']['size'] <= 1000000)
            {
                $infoImage = pathinfo($_FILES["image"]["name"]);
                $name = $id;
                $extensionImage = substr(strrchr($_FILES["image"]["name"], "."), 1);;
    
                $tabExtensionValid = array ("jpg", "png", "jpeg", "gif");
    
                if (in_array($extensionImage, $tabExtensionValid)) 
                {
                    $location =$_SERVER["DOCUMENT_ROOT"]."/PROJET/Jarditou/00_rsrc/src/img/".$name.".".$extensionImage;
                    move_uploaded_file($_FILES["image"]["tmp_name"],$location);
                }
            }

            $request = $db->prepare("INSERT INTO produits (pro_id,pro_cat_id,pro_ref,pro_libelle,pro_description,pro_prix,pro_stock,pro_couleur,pro_d_ajout,pro_bloque,pro_photo)
                                    VALUES ('$id','$cat','$ref','$lib','$desc','$prix','$stock','$color','$date_d_ajout','$bloque','$extensionImage')");


            $request->execute();

            $request->closeCursor();

            header("Location: list.php?msg=add");
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
        header("Location: form_ajout.php?error");
    }
}