<?php
    require("01_inc/header.inc.php");
?>

<?php
if(isset($_POST["Nom"]) && isset($_POST["Prenom"]) && isset($_POST["Date_de_naissance"]) && isset($_POST["Sexe"]) && isset($_POST["Code_postal"]) && isset($_POST["Adresse"]) &&  isset($_POST["Ville"]) && isset($_POST["Email"]) &&  isset($_POST["Sujet"]) &&  isset($_POST["Question"]) && isset($_POST["accepte_les_termes"])){

    // Variables avec toutes les données :

    $nom = htmlspecialchars($_POST["Nom"]);
    $prenom = htmlspecialchars($_POST["Prenom"]);
    $ddn = htmlspecialchars($_POST["Date_de_naissance"]);
    $genre = htmlspecialchars($_POST["Sexe"]);
    $cp = htmlspecialchars($_POST["Code_postal"]);
    $adresse = htmlspecialchars($_POST["Adresse"]);
    $ville = htmlspecialchars($_POST["Ville"]);
    $email = htmlspecialchars($_POST["Email"]);
    $sujet = htmlspecialchars($_POST["Sujet"]);
    $question = htmlspecialchars($_POST["Question"]);
    $terms = htmlspecialchars($_POST["accepte_les_termes"]);

    // Affichage des valeurs récupérés dans le formulaire dans un tableau :
            echo"<div class='row' >";
                echo"<div class=\"col-12 mt-3 mb-3\">";
                    echo"<table class=\"table\">";
                        echo"<thead class=\"thead-dark\">";
                        echo"<tr>";
                            echo"<th>Récapitulatif de vos données saisies dans le formulaire</th>";

                        echo"</tr>";
                        echo"</thead>";
                        echo"<tbody>";
                            echo"<tr>";
                            echo"<td scope=\"row\">";
                                echo"<b>Nom :</b> $nom<br>";
                                echo"<b>Prénom :</b> $prenom <br>";
                                echo"<b>Date de naissance :</b> $ddn <br>";
                                echo"<b>Genre :</b> $genre<br>";
                                echo"<b>Code postal :</b> $cp<br>";
                                echo"<b>Adresse :</b> $adresse <br>";
                                echo"<b>Ville :</b> $ville<br>";
                                echo"<b>Email :</b> $email<br>";
                                echo"<b>Sujet :</b> $sujet<br>";
                                echo"<b>Votre Question :</b> $question<br>";

                                if ($genre === "Femme") {
                                    echo"<b>L'utilisatrice accepte les termes d'envoi :</b> $terms<br>";
                                } else {
                                    echo"<b>L'utilisateur accepte les termes d'envoi :</b> $terms<br>";
                                }
                                
                            echo"</td>";

                        echo"</tbody>";
                    echo"</table>";

                echo"</div>";

            echo"</div>";
            
            echo"<div>";
            echo"<button class=\"btn btn-primary\" type=\"button\"value =\"retour\" onclick=\"window.location.href='contact.php'\" >Revenir sur la page Contact</button>";
            echo"</div>";
}
?>
<?php
    require("01_inc/footer.inc.php");
?>