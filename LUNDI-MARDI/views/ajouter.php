<div class='row'>
   <div class='col-12'>

      <div class="text-center mt-1 mb-3">
            <h2 class="display-4"><strong>Ajout d'un produit</strong></h2>  
      </div>

      <?php echo form_open_multipart(); ?>
			

               <!-- 01: Photo -->
               <div class="form-group my-2">
                  <label for="formFile" class="form-label">Insérez la photo de votre choix (MAX : 1Mo)</label>
                  <input class="form-control" type="file" id="formFile">


               </div>

               <!-- 
                  01 = ID : AUTO_INCREMENT s'affiche mais ne se modifie pas
                  L'input et le label sont caché pour le moment, à voir pour la correction 
               -->
               <div class="form-group ">
                  <label for="id" hidden>ID :</label>
                  <input type="text" class="form-control" id="id" name="pro_id" value="Ne remplissez pas cette ligne" disabled hidden>
               </div>

               <!-- 02 = Référence produit : -->
               <div class="form-group">
                  <label for="ref">Référence :</label>
                  <input type="text" class="form-control" name="pro_ref" id="ref" value="<?php echo set_value('pro_ref') ;?>" required>

                  <!-- Espace commentaire Erreur validation -->
		            <?php echo form_error('pro_ref'); ?>
               </div>


               <!-- 03 = Nom de la catégorie: -->
               <div class="form-group">
                  <label for="categorie">Catégorie :</label>
                  <select id="categorie" class="form-control" name="pro_cat_id"required>

                     <option selected disabled value="selection">Veuillez sélectionner une catégorie pour votre article</option> 

                     <!-- Boucle Foreach pour la selection de la catégorie  -->
                     <?php foreach ($categories as $row): ?> 
                        <option value="<?php echo $row->cat_id; ?>" <?php echo set_select("pro_cat_id", $row->cat_id); ?>><?php echo $row->cat_nom; ?></option>
                     <?php endforeach;?>

                  </select>

                  <!-- Espace commentaire Erreur validation -->
                  <?php echo form_error('pro_cat_id'); ?>
               </div>


               <!-- 04 = libellé :-->
               <div class="form-group">
                  <label for="libelle">Libellé :</label>
                  <input type="text" class="form-control" name="pro_libelle" id="libelle" value="<?php echo set_value('pro_libelle') ;?>" required>

                  <!-- Espace commentaire Erreur validation -->
                  <?php echo form_error('pro_libelle'); ?>

               </div>


               <!-- 05 = Description : -->
               <div class="form-group">
					   <label for="description">Description :</label>
                  <textarea class="form-control" name="pro_description" id="description" value="<?php echo set_value('pro_description') ;?>" required></textarea>

                  <!-- Espace commentaire Erreur validation -->
                  <?php echo form_error('pro_description'); ?>

               </div>


               <!-- 06 = Prix: -->
               <div class="form-group">
                  <label for="prix">Prix :</label>
                  <input type="text" class="form-control" name="pro_prix" id="prix" value="<?php echo set_value('pro_prix') ;?>" required>

                  <!-- Espace commentaire Erreur validation -->
                  <?php echo form_error('pro_prix'); ?>

               </div>


               <!-- 07 = Stock : -->
               <div class="form-group">
                  <label for="stock">Stock :</label>
                  <input type="text" class="form-control" name="pro_stock" id="stock"  value="<?php echo set_value('pro_stock') ;?>" required>

                  <!-- Espace commentaire Erreur validation -->
                  <?php echo form_error('pro_stock'); ?>

               </div>


               <!-- 08 = Couleur: -->
               <div class="form-group">
                  <label for="couleur">Couleur :</label>
                  <input type="text" class="form-control" name="pro_couleur" id="couleur" value="<?php echo set_value('pro_couleur') ;?>" required>

                  <!-- Espace commentaire Erreur validation -->
                  <?php echo form_error('pro_couleur'); ?>

               </div>


               <!-- 09 = L'article est-il bloqué ? : -->
               <div class="form-group">
                  <label>Produit bloqué ? :</label>
                  <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pro_bloque" id="bloque" value="1" required>
                        <label class="form-check-label" for="bloque">Oui</label>
                  </div>
                  <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pro_bloque" id="bloque" value="NULL" required>
                        <label class="form-check-label" for="bloque">Non</label>
                  </div>

                  <!-- Espace commentaire Erreur validation -->
                  <?php echo form_error('pro_bloque'); ?>

               </div>


               <!-- 
                  10 = date d'ajout : 
                  Là aussi le label et l'input ne sont pas visibles
               -->
               <div class="form-group">
                  <label for="date_add" hidden>Date d'ajout :</label>
                  <input type="text" class="form-control" name="pro_d_ajout" id="date_add" disabled hidden>
               </div>
            </fieldset>


            <div class="form-group">
               <button type="submit" name="ajout" id="ajout" class="btn btn-success">Ajouter</button>
               <button type="reset" class="btn btn-secondary">Annuler</button>
               <a href  = "<?php echo site_url('produits/liste'); ?>"><input type = "button" value = "Retour" class = "btn btn-dark"></a>
            </div>
      
      </form> 

   </div>
</div>