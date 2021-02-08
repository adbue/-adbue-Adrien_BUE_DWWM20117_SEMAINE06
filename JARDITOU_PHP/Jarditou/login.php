<?php 
session_start();
    if (isset($_SESSION['prenom'])) {
        header("Location: index.php");
        exit();
    }
?>
<?php
require '01_inc/header.inc.php';
?>

<div class="row justify-content-center">
    <div  class="col-8">
    <div class="card">

        <div class="card-body ">
        <h3 class= card-title> Connexion</h3>

        <?php
        if (isset($_GET["error"])) 
        {
            echo "<div class =\" alert alert-danger\" role=\"alert\">";
            if ($_GET["error"] == "emptyInput") { echo "Veuillez saisir votre identifiant et votre mot de passe";}
            if ($_GET["error"] == "invalidInputs") { echo "Les informations saisies sont érronés.";}
            echo "</div>";
        } else if (isset($_GET["msg"])) 
        {
            echo "<div class =\" alert alert-success\" role=\"alert\">";
                echo "Votre inscription est validée. Connectez-vous.";
            echo "</div>";
        }
        ?>

            <form action="login_script.php" method ="POST">

                <div class="Form-group mb-3 px-3">
                    <label for="nom">Identifiant*</label>
                    <input class="form-control" type="text" name="Login" id="login" placeholder="Veuillez saisir votre identifiant " required>
                </div>

                <div class="Form-group mb-3 px-3">
                    <label for="nom">Mot de passe*</label>
                    <input class="form-control" type="password" name="Pass" id="pass" placeholder="Veuillez saisir votre mot de passe"  required>
                </div>

                <div class="my-4">
                    <button type="submit" class="btn btn-success" id="bouton_envoi" name="submit">Envoyer</button>
                    <button type="reset" class="btn btn-secondary">Annuler</button>
                </div>

            </form>

        </div>
            </div>
        </div>
    </div>

<?php
require '01_inc/footer.inc.php';
?>