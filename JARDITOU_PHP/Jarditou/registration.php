<?php
session_start();
// Pas besoin
if (isset($_SESSION['prenom'])) {
    header("Location: index.php");
    exit();
}
$page= "registration"; 
require '01_inc/header.inc.php';
?>
<div class="row">

    <div class="col-12">
    <?php
        if (isset($_GET['error'])) 
        {
            echo "<div class =\" alert alert-danger\" role=\"alert\">";
                if($_GET['error'] == "empty"){echo "Un ou plusieurs champ(s) est/sont vide(s).";};
                if($_GET['error'] == "invalid"){echo "Un ou plusieurs champ(s) n'est ou ne sont pas rempli(s) correctement.";};
            echo "</div>";
        }
    ?>
    <h1 class="mt-2">Inscription</h1>
    <p class="mt-4">*Ces zones sont obligatoires</p><br>

    <form  action="registration_script.php" method="POST">
        <fieldset>
            <legend class="h3">Identification</legend>

            <div class=" row px-3 my-3">
                <div class="col-6">
                    <div class="Form-group">
                        <label for="nom">Nom*</label>
                        <input class="form-control" type="text" name="Nom" id="nom" placeholder="Votre nom" required>

                    </div>
                </div>

                <div class="col-6">
                    <div class="Form-group">
                        <label for="prenom">Prénom*</label>
                        <input class="form-control" type="text" name="Prenom" id="prenom" placeholder="Votre prénom" required>
                    </div>
                </div>
            </div>

            <div class="Form-group mb-3 px-3">
                <label for="nom">Adresse Email*</label>
                <input class="form-control" type="text" name="Email" id="email" placeholder="Veuillez saisir votre adresse Email" required>
            </div>

            <div class="Form-group mb-3 px-3">
                <label for="nom">Mot de passe*</label>
                <input class="form-control" type="password" name="Pass" id="pass" placeholder="Veuillez saisir un mot de passe (8 à 20 caractères)"  required>
            </div>

            <div class="Form-group mb-3 px-3">
                <label for="nom">Corfirmation de votre mot de passe*</label>
                <input class="form-control" type="password" name="V_Pass" id="v_pass" placeholder="Veuillez confirmer votre mot de passe"  required>
            </div>
            <div class="my-3 px-3">
                <button type="submit" class="btn btn-success" id="bouton_envoi">Envoyer</button>
                <button type="reset" class="btn btn-secondary">Annuler</button>
            </div>
        </fieldset>
    </form><br>


</div>
</div>
<?php
require '01_inc/footer.inc.php';
?>
