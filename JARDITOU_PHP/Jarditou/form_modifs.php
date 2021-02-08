<?php 
session_start();
	require("01_inc/header.inc.php");

    if (isset($_SESSION['prenom']) && $_SESSION["role"] != "admin") {
        header("Location: index.php");
        exit();
    }
?>

<div class="row">
    <div class="col-12">

        <?php
            require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions

            $db = connexionBase(); // Appel de la fonction de connexion
            $pro_id = $_GET["pro_id"];

            // Cette requête ne concerne que le select
            $request_cat = "SELECT cat_nom, cat_id FROM categories ORDER BY cat_id ASC";  

            $request_pro= "SELECT *, cat_nom, cat_id FROM produits INNER JOIN categories ON cat_id = pro_cat_id WHERE pro_id=".$pro_id;

            $result_cat = $db->query($request_cat);    
            $result_pro = $db->query($request_pro);


            // $produit type Objet de $result_pro 
            $produit = $result_pro->fetch(PDO::FETCH_OBJ);

            if (isset($_GET['error'])) 
            {
                echo "<div class =\" alert alert-danger\" role=\"alert\">";
                    echo "Vérifiez vos éléments saisis.";
                echo "</div>";
            }
        ?>


        <div class="text-center mt-1 mb-3">
            <h2 class="display-4"><strong>Modifier un produit</strong></h2>  
        </div>
		<form action="form_modifs_script.php" method="POST">
			<fieldset>
                <!-- Image du produit -->
                <div class="text-center">


                    <img 
                    src="00_rsrc/src/img/<?php echo $produit->pro_id.'.'.$produit->pro_photo; ?>" 
                    alt="<?php echo $produit->pro_libelle; ?>" 
                    title ="<?php echo $produit->pro_libelle; ?>" 
                    width="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo 'auto';}else{echo '300px';}?>"
                    height ="<?php if($produit->pro_id == 16 || $produit->pro_id == 17 || $produit->pro_id == 20){echo '300px';}else{echo 'auto';}?>"
                    >


                </div>

                <!-- 01 = Champ ID : -->
                <div class="form-group">
                    <label for="id">ID :</label>
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $produit->pro_id; ?>">
                </div>

				<!-- 03 = Référence: -->
                <div class="form-group">
                    <label for="reference">Référence :</label>
                    <input type="text" class="form-control" id="reference"  name ="ref" value="<?php echo $produit->pro_ref; ?>">
                </div>
                
                <!-- 03 = Nom de la catégorie: -->
                <div class="form-group">
                    <label for="categorie">Catégorie :</label>
                    <select id="categorie" name="cat" class="form-control" >
                        <option value="<?php echo $produit->pro_cat_id; ?>"><?php echo $produit->pro_cat_id." - ".$produit->cat_nom; ?></option>
                        <?php 
                            while($cat = $result_cat->fetch(PDO::FETCH_OBJ))
                            {
                                echo '<option  value ="'.$cat->cat_id.'">'.$cat->cat_id.' - '.$cat->cat_nom.'</option>';
                            }
                        ?>
                    </select>
                </div>
                
                <!-- 04 = Libellé: -->
                <div class="form-group">
                    <label for="libelle">Libellé :</label>
                    <input type="text" class="form-control" name = "lib" id="libelle" value="<?php echo $produit->pro_libelle; ?>">
                </div>
                
                <!-- 05 = Description: -->
                <div class="form-group">
					<label for="description">Description :</label>
                    <textarea class="form-control" name="desc" id="description"><?php echo $produit->pro_description; ?></textarea>
                </div>
                
                <!-- 06 = Prix: -->
                <div class="form-group">
                    <label for="prix">Prix :</label>
                    <input type="text" class="form-control" name ="prix" id="prix" value="<?php echo $produit->pro_prix; ?>">
                </div>
                
                <!-- 07 = Stock: -->
                <div class="form-group">
                    <label for="stock">Stock :</label>
                    <input type="text" class="form-control" id="stock" name ="stock" value="<?php echo $produit->pro_stock; ?>">
                </div>
                
                <!-- 08 = Catégorie: -->
                <div class="form-group">
                    <label for="couleur">Couleur :</label>
                    <input type="text" class="form-control" name ="color" id="couleur" value="<?php echo $produit->pro_couleur; ?>">
                </div>
                
                <!-- 09 = radio bloqué ? : -->
                <div class="form-group">
                    <p>Produit bloqué ? :</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bloque" id="bloque" value="oui">
                        <label class="form-check-label" for="bloque">Oui</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bloque" id="bloque" value="non">
                        <label class="form-check-label" for="bloque">Non</label>
                    </div>
                </div>
                
                <!-- 10 = Date d'ajout : -->
                <div class="form-group">
                    <label for="date_ajout">Date d'ajout :</label>
                    <input type="text" class="form-control" id="date_ajout" value="<?php echo $produit->pro_d_ajout; ?>" disabled>
                </div>
                
                 <!-- 11 = Date de modif : -->
                <div class="form-group">
                    <label for="date_modif">Date de modification :</label>
                    <input type="text" class="form-control" name = "date_d_modif" id="date_modif" value="La date de modification est définie automatiquement à la date actuelle" disabled>
                </div>
			</fieldset>
            
            <div class="form-group my-2">
                <button type="submit" name="submit" id="modifier" class="btn btn-success">Modifier</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
                <a href="list.php" ><input type="button" value="Retour" class="btn btn-dark my-3"></a>
            </div>

		</form>

	</div>
</div>

<?php 
	require("01_inc/footer.inc.php");
?>