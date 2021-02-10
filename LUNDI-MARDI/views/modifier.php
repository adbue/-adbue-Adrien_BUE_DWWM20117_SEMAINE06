
<div class = 'row'>
<div class = 'col-12'>


    <div class = "text-center mt-1 mb-3">
        <h2 class="display-4"><strong>Modifier un produit</strong></h2>
    </div>

    <?php echo form_open(); ?>


            <!-- 01: Photo -->


            <div class="text-center">

            <img 
                src="<?php echo base_url("assets/img/".$produit->pro_id.".".$produit->pro_photo); ?>" 
                alt="<?php echo $produit->pro_libelle; ?>" 
                title ="<?php echo $produit->pro_libelle; ?>" 
                width="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo 'auto';}else{echo '300px';}?>"
                height ="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo '300px';}else{echo 'auto';}?>"
            >

            </div>
            <!--
                01 = ID : AUTO_INCREMENT s'affiche mais ne se modifie pas
                L'input et le label sont caché pour le moment, à voir pour la correction
            -->

            <div class = "form-group ">
                <label for = "id" >ID :</label>
                <input type = "text" class = "form-control" id = "id" name = "pro_id" value="<?php echo $produit->pro_id; ?>" disabled>
            </div>


            <!-- 02 = Référence produit : -->
            <div class = "form-group">
                <label for = "ref">Référence :</label>
                <input type = "text" class = "form-control" name = "pro_ref" id = "ref" value="<?php echo set_value('pro_ref', $produit->pro_ref); ?>" required>

                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('pro_ref'); ?>
            </div>


            <!-- 03 = Nom de la catégorie: -->
            <div class = "form-group">
                <label for = "categorie">Catégorie :</label>
                <select id = "categorie" class = "form-control" name = "pro_cat_id"required>
                    <option selected disabled  value="Sélectionner une catégorie"><?php echo $produit->cat_nom; ?></option>

                    <!-- Boucle Foreach pour la selection de la catégorie  -->
                    <?php foreach ($categorie as $row): ?>
                    <option><?php echo set_value('cat_nom', $row->cat_nom); ?></option>
                    <?php endforeach;?>

                </select>

                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('pro_cat_id'); ?>
            </div>


            <!-- 04 = libellé :-->
            <div class = "form-group">
                <label for = "libelle">Libellé :</label>
                <input type = "text" class = "form-control" name = "pro_libelle" id = "libelle" value="<?php echo set_value('pro_libelle', $produit->pro_libelle); ?>" required>

                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('pro_libelle'); ?>

            </div>

            <!-- 05 = Description : -->
            <div class = "form-group">
                <label for = "description">Description :</label>
                <textarea class ="form-control" name ="pro_description" id ="description" required><?php echo set_value('pro_description', $produit->pro_description); ?></textarea>

                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('pro_description'); ?>

            </div>


            <!-- 06 = Prix: -->
            <div class = "form-group">
                <label for = "prix">Prix :</label>
                <input type = "text" class = "form-control" name = "pro_prix" id = "prix" value="<?php echo set_value('pro_prix', $produit->pro_prix); ?>" required>

                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('pro_prix'); ?>

            </div>


            <!-- 07 = Stock : -->
            <div class = "form-group">
                <label for = "stock">Stock :</label>
                <input type = "text" class = "form-control" name = "pro_stock" id = "stock"  value="<?php echo set_value('pro_stock', $produit->pro_stock); ?>" required>

                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('pro_stock'); ?>


            </div>


            <!-- 08 = Couleur: -->
            <div class = "form-group">
                <label for = "couleur">Couleur :</label>
                <input type = "text" class = "form-control" name = "pro_couleur" id = "couleur" value="<?php echo set_value('pro_couleur', $produit->pro_couleur); ?>" required>

                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('pro_couleur'); ?>

            </div>


            <!-- 09 = L'article est-il bloqué ? : -->
            <?php
                if ($produit->pro_bloque == NULL) 
                {
                    echo '<div class = "form-group">';
                    echo '<label>Produit bloqué ?: </label>';
                    echo '<div class = "form-check form-check-inline">';
                        echo '<input class = "form-check-input" type = "radio" name = "pro_bloque" id ="bloque"  value= "1"required>';
                        echo '<label class = "form-check-label" for = "bloque">Oui</label>';
                    echo '</div>';
                    echo '<div class = "form-check form-check-inline">';
                        echo '<input class = "form-check-input" type = "radio" name = "pro_bloque" id ="bloque" value ="NULL" required checked >';
                        echo '<label class = "form-check-label" for = "bloque">Non</label>';
                    echo '</div>';
                } else 
                {
                    echo '<div class = "form-group">';
                    echo '<label>Produit bloqué ?: </label>';
                    echo '<div class = "form-check form-check-inline">';
                        echo '<input class = "form-check-input" type = "radio" name = "pro_bloque" id ="bloque"  value= "1"required checked>';
                        echo '<label class = "form-check-label" for = "bloque">Oui</label>';
                    echo '</div>';
                    echo '<div class = "form-check form-check-inline">';
                        echo '<input class = "form-check-input" type = "radio" name = "pro_bloque" id ="bloque" value ="NULL" required>';
                    echo '<label class = "form-check-label" for = "bloque">Non</label>';
                    echo '</div>';
                }
            ?>

            <!--
                10 = date d'ajout :
                Là aussi le label et l'input ne sont pas visibles
            -->

            <div class = "form-group">
                <label for="date_add">Date d'ajout :</label>
                <input type = "text" class = "form-control" name = "pro_d_ajout" id = "date_add" value="<?php echo $produit->pro_d_ajout; ?>" disabled>
            </div>

        </fieldset>


        <div class = "form-group">
            <button type = "submit" name = "ajout" id = "ajout" class = "btn btn-success">Modifier</button>
            <button type = "reset" class = "btn btn-secondary">Annuler</button>
            <a href = "<?php echo site_url('produits/liste'); ?>"><input type = "button" value = "Retour" class = "btn btn-dark"></a>
        </div>


    </form>


</div>
