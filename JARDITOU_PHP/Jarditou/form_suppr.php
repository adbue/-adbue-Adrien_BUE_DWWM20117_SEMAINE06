<?php
session_start();
    require '01_inc/header.inc.php';

    if (isset($_SESSION['prenom']) && $_SESSION["role"] != "admin") {
        header("Location: index.php");
        exit();
    }
?>
<!-- Connexion à la base de donnée -->
<?php

    require 'connexion_bdd.php';
    $db = connexionBase();

    $pro_id = filter_input(INPUT_GET,'pro_id', FILTER_SANITIZE_URL);

    $request = "SELECT * FROM produits WHERE pro_id=".$pro_id;
    $result = $db->query($request);

    $produit = $result->fetch(PDO::FETCH_OBJ);

    $result->closeCursor();

?>

<div class="row">
    <div class="col-12">

        <div class="text-center mt-2 mb-0 pb-2 bg-dark ">
            <h2 class="display-4 text-light"><strong>Suppression du produit <?php echo "$produit->pro_libelle"; ?></strong></h2>  
        </div>

        <div class="shadow text-center my-2 ">
            <form action="02_script/delete_scipt.php">
            <img class="py-2"
                src="00_rsrc/src/img/<?php echo $produit->pro_id.'.'.$produit->pro_photo; ?>" 
                alt="<?php echo $produit->pro_libelle; ?>" 
                title ="<?php echo $produit->pro_libelle; ?>" 
                width="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo 'auto';}else{echo '300px';}?>"
                height ="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo '300px';}else{echo 'auto';}?>"
            ><br><br>
       
            <div class="text-center mt-1 mb-3 py-2">
                <h4 class="display-5"><strong>Voulez-vous supprimer définitivement ce produit de la liste?</strong></h4>  
            </div>


            
            <div class ="text-center form-group pb-3">
                <a onClick="return confirm('Êtes-vous sûr(e) de vouloir supprimer cet article de la liste ?')" href="delete_script.php?pro_id=<?php echo $produit->pro_id;?>"><input type="button" value="Supprimer" class="btn btn-danger"></a>
                <a href="list.php"><input type="button" value="Annuler" class="btn btn-secondary"></a>
            </div>
            </form>
        </div>
        



        </form>

    </div>
</div>
<?php
    require '01_inc/footer.inc.php';
?>