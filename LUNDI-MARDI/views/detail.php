<div class="row">
    <div class="col-12">

        <div class="text-center mt-1 mb-3">
            <h2 class="display-4"><strong>Détail du produit</strong></h2>  
        </div>
        
                <?php echo form_open(); ?>
                <!-- Construction sur le modèle présent sur ncode: -->
                
                <!-- IMAGE -->
                <div class="text-center">


                    <img 
                    src="<?php echo base_url("assets/img/".$produit->pro_id.".".$produit->pro_photo); ?>" 
                    alt="<?php echo $produit->pro_libelle; ?>" 
                    title ="<?php echo $produit->pro_libelle; ?>" 
                    width="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo 'auto';}else{echo '300px';}?>"
                    height ="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo '300px';}else{echo 'auto';}?>"
                    >


                </div>


                <!-- 01 = ID : AUTO_INCREMENT s'affiche mais ne se modifie pas-->
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


                <!-- 08 = Couleur: -->
                <div class='form-group'>
                    <label>Couleur :</label>
                    <input type="text" class="form-control" id="couleur" value="<?php echo $produit->pro_couleur; ?>" disabled>
                </div> 


                <!-- 09 = L'article est-il bloqué ? : -->
                <div class="form-group">
                    <span>Produit bloqué ? :</span>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bloque" id="bloque" value="oui" <?php if(isset($produit->pro_bloque) != NULL || 0){echo "checked";} ?> disabled>
                        <label class="form-check-label" for="bloque">Oui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bloque" id="bloque" value="non" <?php if(isset($produit->pro_bloque) == NULL || 0){echo "checked";} ?> disabled>
                        <label class="form-check-label" for="bloque">Non</label>
                    </div>
                </div>


                <!-- 10 = date d'ajout : -->
                <div class = "form-group">
                <label for="date_add">Date d'ajout :</label>
                <input type = "text" class = "form-control" name = "pro_d_ajout" id = "date_add" value="<?php echo $produit->pro_d_ajout; ?>" disabled>
            </div>
            <?php
            if(isset($produit->pro_d_modif))
            {
            echo '<div class = "form-group">';
                echo '<label for="date_modif">Date de modification :</label>';
                echo '<input type = "text" class = "form-control" name = "pro_d_modif" id = "date_modif" value="'.$produit->pro_d_modif.'" disabled>';
            echo '</div>';
            }
            ?>



        </form>


        <!-- Liens vers les pages de Modification, Supression et Retour -->
        <div class='mb-3'>
            <a href='<?php echo site_url('produits/modifier/'.$produit->pro_id); ?>'><input type="button" class="btn btn-info" value="Modifier"</a>
            <a onClick="return confirm('Êtes-vous sûr(e) de vouloir supprimer cet article de la liste ?')" href='<?php echo site_url('produits/supprimer/'.$produit->pro_id); ?>'><input type="button" class="btn btn-danger" value="Supprimer"</a>      
            <a href="<?php echo site_url('produits/liste'); ?>"><input type="button" value="Retour" class="btn btn-dark"></a>
        </div>
