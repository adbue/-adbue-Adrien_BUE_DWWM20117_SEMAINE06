<?php
session_start();
$webPage = 2;
require '01_inc/header.inc.php';
?>
<div class="row">
    
    <div class="col-12">
        
        <?php 

        require 'connexion_bdd.php';
        $db = connexionBase();
        $request = "SELECT * FROM produits ORDER BY pro_id";
        $result = $db->query($request);

        ?>
    
        <!-- Titre + tableau responsive+ En-tête tableau -->
    
        <div class="text-center mt-1 mb-3">
            <h2 class="display-4"><strong>Liste des produits</strong></h2>  
        </div>

        <?php
        if (isset($_SESSION['prenom']) && $_SESSION["role"] == "admin") 
        {
            echo '<div class="mb-2 pr-3 text-right">';
            echo '<a href="form_ajout.php"><input type="button" value ="+ Ajouter un produit" class="btn btn-success"></a>';
            echo '</div>';
        }

        if (isset($_GET["msg"])) 
        {
            echo "<div class =\" alert alert-success\" role=\"alert\">";
                if($_GET["msg"] == "update"){echo "La modification du produit a bien été effectuée.";}
                if($_GET["msg"] == "add"){echo "L'ajout du produit a bien été effectué.";}
                if($_GET["msg"] == "delete"){echo "La suppresion du produit a bien été effectuée.";}
            echo "</div>";
        }
        ?>


        <div class="table-responsive col-12">
            <table class="table table-hover table-striped table-bordered">

                <thead class="thead-dark">
                    <tr>
                        <th>Photos</th>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Libellé</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Couleur</th>
                        <th>Ajout</th>
                        <th>Modification</th>
                        <th>Bloqué</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                        while ($row = $result->fetch(PDO::FETCH_OBJ)) 
                        {
                            echo '<tr>';

                            // Affichage des images

                                /*
                                *   Pour l'affichage des images il faut associer par concaténation 
                                *   La valeur de pro_id (nom du fichier) et celle de pro_photo(extension du fichier)
                                */

                                echo '<div>';


                                    echo '<td 
                                    class="table-warning "><img src="00_rsrc/src/img/'.$row->pro_id.'.'.$row->pro_photo.'" 
                                    class="img-fluid" 
                                    alt ="'.$row->pro_libelle.'" 
                                    title ="'.$row->pro_libelle.'"
                                    width = "120px"
                                    </td>';


                                echo '</div>';


                            // Id produit
                                echo '<div>';
                                    echo '<td>'.$row->pro_id.'</td>';
                                echo '</div>';


                            // Référence produit
                                echo '<div>';
                                    echo '<td>'.$row->pro_ref.'</td>';
                                echo '</div>';


                            // Libellé + lien vers détail.php
                                echo '<div>';
                                    echo '<td class="table-warning align-middle text-center"><a class="link-danger" href="detail.php?pro_id='.$row->pro_id.'" 
                                           title="Liens vers le détail du produit '.$row->pro_libelle.'">'.$row->pro_libelle.'</a></td>';
                                echo '</div>';


                            // Le prix
                                echo '<div>';
                                echo"<td>".$row->pro_prix."</td>";
                                echo '</div>';


                            // Le nombre de produits en stock
                                echo '<div>';
                                echo"<td>".$row->pro_stock."</td>";
                                echo '</div>';


                            // La couleur
                                echo '<div>';
                                echo"<td>".$row->pro_couleur."</td>";
                                echo '</div>';


                            // Date d'ajout
                                echo '<div>';
                                echo"<td>".$row->pro_d_ajout."</td>";
                                echo '</div>';


                            // Date de modification
                                echo '<div>';
                                echo"<td>".$row->pro_d_modif."</td>";
                                echo '</div>';


                            // Et pour finir produit bloqué
                                echo '<div>';
                                echo"<td>".$row->pro_bloque."</td>";
                                echo '</div>';


                            echo '</tr>';
                        }


                        $result->closeCursor();
                    ?>


                </tbody>


            </table>          
        </div>
<?php
require '01_inc/footer.inc.php';
?>