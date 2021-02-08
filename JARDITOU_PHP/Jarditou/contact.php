<?php
    require("01_inc/header.inc.php");
?>
<!-- 
    FORMULAIRE
-->

            <div class="row">

                <div class="col-12">

                    <p class="mt-4">*Ces zones sont obligatoires</p>

                    <form  action="02_script/script.php" method="POST">
                        <fieldset>
                            <legend class="h1">Vos Coordonnées</legend>
                            <div class="Form-group mb-3">
                                <label for="nom">Nom*</label>
                                <input class="form-control" type="text" name="Nom" id="nom" placeholder="Votre nom" required>
                                <span id="nom_manquant"></span>

                            </div>
                            <div class="Form-group mb-3">
                                <label for="prenom">Prénom*</label>
                                <input class="form-control" type="text" name="Prenom" id="prenom" placeholder="Votre prénom" required>
                                <span id="prenom_manquant"></span>

                            </div>
                            <div class="Form-group mb-3">
                                <label for="date_de_naissance">Date de naissance*</label>
                                <input class="form-control" type="text" name="Date_de_naissance" id="date_de_naissance" placeholder = "jj/mm/aaaa"required>
                                <span id="date_de_naiss_manquant"></span>
                            </div>
                            <div>
                                <p>Sexe*</p>
                                <div class="form-check form-check-inline mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="Sexe" id="sexe" value="Femme" required><label for="sexe" class="form-check-label">Féminin</label>
                                        <style type="text/css">
                                            label{margin: 0 10px 0 10px;}
                                        </style>
                                        <input class="form-check-input" type="radio" name="Sexe" id="sexe" value="Homme" required><label for="sexe" class="form-check-label">Masculin</label>
                                    </div>
                                    <span id="sexe_manquant"></span>
                                </div>
                            </div>
                            <div class="Form-group mb-3">
                                <label for="code_postal">Votre code postal*</label>
                                <input class="form-control" type="text" name="Code_postal" id="code_postal" placeholder="(ex: 75000)" required >
                                <span id="code_manquant"></span>
                            </div>
                            <div class="Form-group mb-3">
                                <label for="adresse">Adresse</label>
                                <input class="form-control" type="text" name="Adresse" id="adresse" placeholder="N°, Rue">
                                <span id="adresse_manquant"></span>
                            </div>
                            <div class="Form-group mb-3">
                                <label for="ville">Ville</label>
                                <input class="form-control" type="text" name="Ville" id="ville"  placeholder="(ex: Paris)">
                                <span id="ville_manquant"></span>
                            </div>
                            <div class="Form-group mb-3">
                                <label for="email">Votre email*</label>
                                <input class="form-control" type="email" name="Email" id="email" placeholder="dave.loper@afpa.fr" required>
                                <span id="email_manquant"></span>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="h1">Votre demande</legend>
                            <div class="form-group">
                                <label for="sujet">Sujet*</label>
                                <select class="form-control"name="Sujet" id="sujet" required>
                                    <option value="" selected disabled>Veuillez sélectionner un sujet</option>
                                    <option value="Mes_commandes">Mes commandes</option>
                                    <option value="Question_sur_un_produit">Question sur un produit</option>
                                    <option value="Reclamation">Réclamation</option>
                                    <option value="Autres">Autres</option>
                                </select>
                                <span id="sujet_manquant"></span>
                            </div>
                            <div class="form-group">
                                <label for="question">Votre question*</label>
                                <textarea class="form-control" name="Question"id="question" rows="3" placeholder ="min-6 / max-500 caractères"required></textarea>
                                <span id="question_manquant"></span>
                            </div>
                        </fieldset>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="accepte_les_termes" id="utilisateur_accepte_les_termes" value="oui" required>
                            <label class="form-check-label" for="accepte_les_termes"> J'accepte le traitement informatique de ce formulaire</label>
                            <span id="utilisateur_accepte_les_termes_manquant"></span>
                        </div>
                        
                        <button type="submit" class="btn btn-dark outline-primary" id="bouton_envoi">Envoyer</button>
                        <button type="reset" class="btn btn-dark outline-primary">Annuler</button>

                    </form>
                </div>

            </div>

        <script src="00_rsrc/assets/js/script.js"></script>

<?php
    require("01_inc/footer.inc.php");
?>