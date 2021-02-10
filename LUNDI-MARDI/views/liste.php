
    <div class="text-center mt-1 mb-3">
            <h2 class="display-4"><strong>Liste des produits</strong></h2>  
        </div>

        <div class="mb-2 pr-3 text-right">
        <a href="<?php echo site_url('produits/ajouter'); ?>"><input type="button" value ="+ Ajouter un produit" class="btn btn-success"></a>
        </div>

        <div class="table-responsive col-12">
            <table class="table table-hover table-striped table-bordered">

                <thead class="thead-dark">
                    <tr>
                        <th>Photo</th>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Libellé</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Couleur</th>
                        <th>Ajout</th>
                        <th>Modif</th>
                        <th>Bloqué</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($liste_produits as $row): ?> 
                    
                         <tr>
                    
                        <!-- // Affichage des images
                    
                            /*
                            *   Pour l'affichage des images il faut associer par concaténation 
                            *   La valeur de pro_id (nom du fichier) et celle de pro_photo(extension du fichier)
                            */ -->
                             <div>
                    
                    
                                 <td class="table-warning">
                                <img src="<?php echo base_url("assets/img/".$row->pro_id.".".$row->pro_photo); ?>" 
                                class="img-fluid" 
                                alt ="'.$row->pro_libelle.'" 
                                title ="'.$row->pro_libelle.'"
                                width = "100px">
                                </td>
                    
                    
                            </div>
                    
                    
                        <!-- // Id produit -->
                             <div>
                                <td><?php echo $row->pro_id; ?></td>
                            </div>
                    
                    
                        <!-- // Référence produit -->
                             <div>
                                 <td><?php echo $row->pro_ref; ?></td>
                             </div>
                    
                    
                        <!-- // Libellé + lien vers détail.php -->
                             <div>
                                <td class="table-warning align-middle text-center">
                                <a class="link-danger" href="<?php echo site_url("produits/detail/".$row->pro_id);?>" 
                                title="Liens vers le détail du produit .<?php echo $row->pro_libelle; ?>"><?php echo $row->pro_libelle; ?></a></td>
                             </div>
                    
                    
                        <!-- // Le prix -->
                             <div>
                                <td><?php echo $row->pro_prix; ?></td>
                             </div>
                    
                    
                        <!-- // Le nombre de produits en stock -->
                             <div>
                                <td><?php echo $row->pro_stock; ?></td>
                             </div>
                    
                    
                        <!-- // La couleur -->
                             <div>
                                <td><?php echo $row->pro_couleur; ?></td>
                             </div>
                    
                    
                        <!-- // Date d'ajout
                             <div> -->
                                <td><?php echo $row->pro_d_ajout; ?></td>
                            </div>
                    
                    
                        
                             <div>
                                <td><?php echo $row->pro_d_modif; ?></td>
                             </div>
                    
                    
                        <!-- // Et pour finir produit bloqué -->
                             <div>
                                <td><?php echo $row->pro_bloque; ?></td>
                             </div>
                    
                    
                         </tr>
                        <?php endforeach;?>

</tbody>

</table>          
</div>
