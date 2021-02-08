<?php
session_start();

if (isset($_SESSION['prenom']) && $_SESSION["role"] != "admin") {
    header("Location: index.php");
    exit();
}

    require '01_inc/header.inc.php';

?>
<div class='row'>
    <div class='col-12'>

        <?php
        
        require 'connexion_bdd.php';
        $db = connexionBase();

        $request = "SELECT * FROM categories ORDER BY cat_id ASC";
        $request_pro = "SELECT pro_id FROM produits ORDER BY pro_id DESC";

        $result_cat = $db->query($request);
        $result_pro = $db->query($request_pro);

        $produit =$result_pro->fetch(PDO::FETCH_OBJ);

        if (isset($_GET['error'])) 
        {
            echo "<div class =\" alert alert-danger\" role=\"alert\">";
                echo "Vérifiez vos éléments saisis.";
            echo "</div>";
        }
        ?>
        
        <div class="text-center mt-1 mb-3">
            <h2 class="display-4"><strong>Ajout d'un produit</strong></h2>  
        </div>
        
        <form action="form_ajout_script.php" method="POST" enctype="multipart/form-data">
			<fieldset>

                <!-- 01: Photo -->
                <div class="form-group my-2">
                    <label for="formFile" class="form-label">Insérez la photo de votre choix (MAX : 1Mo)</label>
                    <input class="form-control" type="file" name= "image" id="formFile">
                    <!-- Pour fixer une taille limite dans le formulaire, il faut ajouter un champ caché avant le champ de type file: (ICI 1 Mo)  -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                </div>


                <!-- 
                    01 = ID 
                -->
                <div class="form-group ">
                    <label for="id">ID :</label>
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo ($produit->pro_id)+1;?>" >
                </div>
                
                <!-- 02 = Référence produit : -->
                <div class="form-group">
                    <label for="ref">Référence :</label>
                    <input type="text" class="form-control" name="ref" id="ref" required>
                </div>


                <!-- 03 = Nom de la catégorie: -->
                <div class="form-group">
                    <label for="categorie">Catégorie :</label>
                    <select id="categorie" class="form-control" name="cat" required>
                        <option selected disabled value="selection">Veuillez sélectionner une catégorie pour votre article</option>    
                        <?php 
                            while($cat = $result_cat->fetch(PDO::FETCH_OBJ))
                            {
                                echo '<option value="'.$cat->cat_id.'">'.$cat->cat_id.' - '.$cat->cat_nom.'</option>';
                            }
                        ?>
                    </select>
                </div>


                <!-- 04 = libellé :-->
                <div class="form-group">
                    <label for="libelle">Libellé :</label>
                    <input type="text" class="form-control" name="lib" id="libelle" required>
                </div>


                <!-- 05 = Description : -->
                <div class="form-group">
					<label for="description">Description :</label>
                    <textarea class="form-control" name="desc" id="description" required></textarea>
                </div>


                <!-- 06 = Prix: -->
                <div class="form-group">
                    <label for="prix">Prix :</label>
                    <input type="text" class="form-control" name="prix" id="prix" required>
                </div>


                <!-- 07 = Stock : -->
                <div class="form-group">
                    <label for="stock">Stock :</label>
                    <input type="text" class="form-control" name="stock" id="stock" required>
                </div>


                <!-- 08 = Couleur: -->
                <div class="form-group">
                    <label for="couleur">Couleur :</label>
                    <input type="text" class="form-control" name="color" id="couleur" required>
                </div>


                <!-- 09 = radio bloqué ? : -->
                <div class="form-group">
                    <p>Produit bloqué ? :</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bloque" id="bloque" value="1" required>
                        <label class="form-check-label" for="bloque">Oui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bloque" id="bloque" value="0" required>
                        <label class="form-check-label" for="bloque">Non</label>
                    </div>
                </div>


                <!-- 
                    10 = date d'ajout : 
                    (le label et l'input ne sont pas visibles)
                -->
                <div class="form-group">
                    <label for="date_add" hidden>Date d'ajout :</label>
                    <input type="text" class="form-control" name="date_add" id="date_add" disabled hidden>
                </div>
            </fieldset>


            <div class="form-group">
                <button type="submit" name="submit" id="ajout" class="btn btn-success">Ajouter</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
                <a href  = "list.php"><input type = "button" value = "Retour" class = "btn btn-dark"></a>
            </div>
	</form>
        
    </div>
</div>

<?php
require '01_inc/footer.inc.php';
?>