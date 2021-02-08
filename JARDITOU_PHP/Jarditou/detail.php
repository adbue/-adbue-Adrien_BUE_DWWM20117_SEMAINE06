<?php
session_start();
require '01_inc/header.inc.php';
?>

<div class="row">
    <div class="col-12">
        <?php

            require 'connexion_bdd.php';
            $db = connexionBase();
            // Ajout des deux tables présente dans notre base jarditou:
            $pro_id = filter_input(INPUT_GET, 'pro_id', FILTER_SANITIZE_URL); // filter proposé par netbeans
            
            $request = "SELECT * FROM produits 
                        INNER JOIN categories 
                        ON    cat_id = pro_cat_id
                        WHERE pro_id = ".$pro_id;
            
            $result = $db->query($request);
            
            // Renvoi de l'enregistrement sous forme d'un objet
            $produit = $result->fetch(PDO::FETCH_OBJ);

        ?>
        
        <div class="text-center mt-1 mb-3">
            <h2 class="display-4"><strong>Détail du produit</strong></h2>  
        </div>
        
        <form action="detail.php" method="POST">
            <fieldset>
                
                <!-- Construction sur le modèle présent sur ncode: -->
                
                <!-- IMAGE -->
                <div class="text-center">


                    <img 
                    src="00_rsrc/src/img/<?php echo $produit->pro_id.'.'.$produit->pro_photo; ?>" 
                    alt="<?php echo $produit->pro_libelle; ?>" 
                    title ="<?php echo $produit->pro_libelle; ?>" 
                    width="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo 'auto';}else{echo '300px';}?>"
                    height ="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo '300px';}else{echo 'auto';}?>"
                    >


                </div>


                <!-- 01 = ID : -->
                <div class='form-group'>
                    <label>ID :</label>
                    <input type="text" class="form-control" id="id" value="<?php echo $produit->pro_id; ?>" disabled>
                </div>


                <!-- 02 = Référence produit : -->
                <div class='form-group'>
                    <label>Référence :</label>
                    <input type="text" class="form-control" id="ref" value="<?php echo $produit->pro_ref; ?>" disabled>
                </div>


                <!-- 03 = Nom de la catégorie: -->
                <div class='form-group'>
                    <label>Catégorie :</label>
                    <input type="text" class="form-control" id="categorie" value="<?php echo $produit->cat_nom; ?>" disabled>
                </div> 


                <!-- 04 = libellé :-->
                <div class='form-group'>
                    <label>Libellé :</label>
                    <input type="text" class="form-control" id="libelle" value="<?php echo $produit->pro_libelle; ?>" disabled>
                </div>


                <!-- 05 = Description : -->
                <div class='form-group'>
                    <label>Description :</label>
                    <textarea class="form-control" name="description" id="description" disabled><?php echo $produit->pro_description; ?></textarea>
                </div>                     


                <!-- 06 = Prix: -->
                <div class='form-group'>
                    <label>Prix :</label>
                    <input type="text" class="form-control" id="prix" value="<?php echo $produit->pro_prix; ?>" disabled>
                </div>       


                <!-- 07 = Stock : -->
                <div class='form-group'>
                    <label>Stock :</label>
                    <input type="text" class="form-control" id="stock" value="<?php echo $produit->pro_stock; ?>" disabled>
                </div>  


                <!-- 08 = Couleur : -->
                <div class='form-group'>
                    <label>Couleur :</label>
                    <input type="text" class="form-control" id="couleur" value="<?php echo $produit->pro_couleur; ?>" disabled>
                </div> 

                <!-- 09 = Radio bloqué : -->
                <div class="form-group">
                    <p>Produit bloqué ? :</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bloque" id="bloque" value="oui" <?php if(isset($produit->pro_bloque) != NULL || 0) {echo "checked";} ?> disabled>
                        <label class="form-check-label" for="bloque">Oui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bloque" id="bloque" value="non" <?php if(isset($produit->pro_bloque) == NULL || 0) {echo "checked";} ?> disabled>
                        <label class="form-check-label" for="bloque">Non</label>
                    </div>
                </div>
                
                <!-- 10 = Date d'ajout : -->
                <div class="form-group">
                    <label for="date_ajout">Date d'ajout :</label>
                    <input type="text" class="form-control" id="date_ajout" value="<?php echo $produit->pro_d_ajout; ?>" disabled>
                </div>
                
                <!-- 11 =  Date modification : -->
                <div class="form-group">
                    <label for="date_modif">Date de modification :</label>
                    <input type="text" class="form-control" id="date_modif" value="<?php echo $produit->pro_d_modif; ?>" disabled>
                </div>

            </fieldset>      
        </form>

            <?php
            if (isset($_SESSION["prenom"]) && $_SESSION["role"] == "admin") 
            {
                echo '<div class="my-3">';
                    echo '<a href="form_modifs.php?pro_id='.$pro_id.'"><input type="button" class="btn btn-info" value="Modifier"></a> ';
                    echo '<a href="form_suppr.php?pro_id='.$pro_id.'"><input type="button" class="btn btn-danger" value="Supprimer"></a>';
                    echo '<a href="list.php" class="m-1"><input type="button" value="Retour" class="btn btn-dark"></a>';
                echo '</div>';
            } else 
            {
                echo '<div class="mb-3">';
                    echo '<a href="list.php"><input type="button" value="Retour" class="btn btn-dark"></a>';
                echo '</div>';
            }
            ?>
                
        

    
<?php
    require '01_inc/footer.inc.php';
