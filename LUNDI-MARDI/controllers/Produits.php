<?php

// application/controllers/Produits.php
date_default_timezone_set("Europe/Paris");

defined('BASEPATH') or exit('No direct script access allowed');

class Produits extends CI_Controller
{



    public function accueil()
    {
        $this->load->view('header');
        $this->load->view('accueil');
        $this->load->view('footer');
    }


/*!
* /author
*/

    public function liste()
    {
        /*
        // Déclaration du tableau associatif à tranmettre à la vue
        $aView = array();
        $aProduits = ["Aramis", "Athos", "Clatronic", "Camping", "Green"]
        // Dans le tableau, on créé une donnée 'prénom' qui a pour valeur 'Dave'
        $aView["prenom"] = "Dave";
        // Exercice 1  =  Ajout du nom de famille
        $aView["nom"] = "Loper";
        // Exercice 2 = Liste de produits, tableau associatif $key = brands(marques) et $value= les valeurs incluses dans le tableau
        $aView["listes_produits"] = $aProduits;
         */

        /* ANCIEN CODE
        // 04. Bases de donnée

        // 01 - Charger la librairie Databse :
        $this->load->database();

        // 02 - Éxécute la requête :
        $results = $this->db->query("SELECT * FROM produits");

        // 03 Récupération des résultats
        $aListe = $results->result();
         */

        // NOUVEAU CODE

        // 01 - Chargement du modèle 'ProduitsModels'
        $this->load->model('ProduitsModel');

        /*02 - On appelle la méthode liste() du modèle
         * Qui retourne le résultat dans ce tableau = $aListe
         */

        $aListe = $this->ProduitsModel->liste();

        $aViewProduits["liste_produits"] = $aListe;

        $this->load->view('header');
        $this->load->view('liste', $aViewProduits);
        $this->load->view('footer');

    }




    public function ajouter()
    {
        // 01 - Chargement du modèle 'ProduitsModels'

        $this->load->model('ProduitsModel');

        $aCategories = $this->ProduitsModel->categorie();

        $aView["categories"] = $aCategories;

        // 2 ème appel de la page : traitement du formulaire
        if ($this->input->post()) {
            $data = $this->input->post();
            // permet de récupérer en une seule fois toutes les données envoyées par le formulaire. Equivaut au tableau $_POST en PHP natif.

            // Ajout d'éléments non présent dans le formulaire

            $data["pro_d_ajout"] = date("Y-m-d");

            // Transformation d'une information venant du formalaire
            // par exemple forcer la référence d'un produit en majuscules

            $pro_ref = $this->input->post("pro_ref");
            $data["pro_ref"] = strtoupper($pro_ref);

            /* *** VALIDATION FORMULAIRE AJOUT *** */

            $this->form_validation->set_rules("pro_ref", "Référence", "required|min_length[5]", array("required" => "Veuillez renseigner une %s.", "min_length[5]" => "Le %s doit avoir longueur minimum de 5 caractères."));
            $this->form_validation->set_rules("pro_libelle", "Libellé", "required|alpha_numeric", array("required" => "Veuillez renseigner une %s.", "alpha_numeric" => "Le champ %s n'accepte pas de chiffres."));
            $this->form_validation->set_rules("pro_cat_id", "Catégorie", "required", array("required" => "Veuillez sélectionner une %s."));
            $this->form_validation->set_rules("pro_description", "Description", "required", array("required" => "Veuillez renseigner une %s."));
            $this->form_validation->set_rules("pro_prix", "Prix", "required|decimal", array("required" => "Veuillez renseigner une %s.", "decimal" => "Le champ %s doit être complété avec un chiffre décimal."));
            $this->form_validation->set_rules("pro_stock", "Stock", "required|integer", array("required" => "Veuillez renseigner une %s.", "integer" => "Le champ %s doit être complété avec un chiffre entier."));
            $this->form_validation->set_rules("pro_couleur", "Couleur", "required|alpha", array("required" => "Veuillez renseigner une %s.", "alpha" => "Le champ %s ne doit comporter que des lettres."));
            $this->form_validation->set_rules("pro_bloque", "Référence", "required", array("required" => "Veuillez cocher une case."));

            if ($this->form_validation->run() == false) { // Echec de la validation, on réaffiche la vue formulaire
                $this->load->view('header');
                $this->load->view('ajouter', $aView);
                $this->load->view('footer');
            } else { // La validation a réussi, nos valeurs sont bonnes, on peut insérer en base
                
                return $this->db->insert('produits', $data);

                // *** INSERT IMAGE ***
                if ($_FILES) {

                    // On extrait l'extension du nom du fichier
                    // Dans $_FILES["pro_photo"], pro_photo est la valeur donnée à l'attribut name du champ de type 'file'
                    $extension = substr(strrchr($_FILES["pro_photo"]["name"], "."), 1);
                }

                /*
                 * On a l'extension du fichier donc on peut enregistrer
                 * en base de données
                 */

                /*
                 * Pour créer le nom du fichier : il faut récupérer la clé primaire (pro_id) :
                 * - dans le cas du formulaire d'ajout : il faut récupérer avec la méthode $this-db->InsertId();
                 * - dans le cas du formulaire de modification : on récupère le pro_id passé dans un champ de type hidden
                 */

                // On créé un tableau de configuration pour l'upload
                $config['upload_path'] = './assets/photos/'; // chemin où sera stocké le fichier

                // nom du fichier final
                $config['file_name'] = $id . '.' . $extension;

                // On indique les types autorisés (ici pour des images)
                $config['allowed_types'] = 'gif|jpg|jpeg|png';

                // On charge la librairie 'upload'
                $this->load->library('upload');

                // On initialise la config
                $this->upload->initialize($config);

                // La méthode do_upload() effectue les validations sur l'attribut HTML 'name' ('fichier' dans notre formulaire)
                // et si OK renomme et déplace le fichier tel que configuré
                if (!$this->upload->do_upload('fichier')) {
                    // Echec,  on réaffiche le formulaire
                    $this->load->view('header');
                    $this->load->view('ajouter', $aView);
                    $this->load->view('footer');
                } else { // Succès, on redirige sur la liste
                    redirect('produits/liste');
                }
            }
        } else { // Le formulaire n'est pas posté on retourne sur la page ajouter
            $this->load->view('header');
            $this->load->view('ajouter',$aView);
            $this->load->view('footer');
        }
    }




    public function detail($id)
    {
        $this->load->model('ProduitsModel');
        $aListe = $this->ProduitsModel->listeDetail($id);
        $aView["produit"] = $aListe;

        $this->load->view('header');
        $this->load->view('detail', $aView);
        $this->load->view('footer');
    }



    public function modifier($id)
    {
        $this->load->model('ProduitsModel');

        $aListe = $this->ProduitsModel->listeDetail($id);
        $aCategorie = $this->ProduitsModel->categorie();

        $aView["produit"] = $aListe;
        $aView["categorie"] = $aCategorie;

        if ($this->input->post()) 
        {// 2ème appel de la page: traitement du formulaire

            $data = $this->input->post();
            

            // Définition des filtres
            $this->form_validation->set_rules("pro_ref", "Référence", "required|min_length[5]", array("required" => "Veuillez renseigner une %s.", "min_length[5]" => "Le %s doit avoir longueur minimum de 5 caractères."));
            $this->form_validation->set_rules("pro_libelle", "Libellé", "required|alpha_numeric", array("required" => "Veuillez renseigner une %s.", "alpha_numeric" => "Le champ %s n'accepte pas de chiffres."));
            $this->form_validation->set_rules("pro_cat_id", "Catégorie", "required", array("required" => "Veuillez sélectionner une %s."));
            $this->form_validation->set_rules("pro_description", "Description", "required", array("required" => "Veuillez renseigner une %s."));
            $this->form_validation->set_rules("pro_prix", "Prix", "required|decimal", array("required" => "Veuillez renseigner une %s.", "decimal" => "Le champ %s doit être complété avec un chiffre décimal."));
            $this->form_validation->set_rules("pro_stock", "Stock", "required|integer", array("required" => "Veuillez renseigner une %s.", "integer" => "Le champ %s doit être complété avec un chiffre entier."));
            $this->form_validation->set_rules("pro_couleur", "Couleur", "required|alpha", array("required" => "Veuillez renseigner une %s.", "alpha" => "Le champ %s ne doit comporter que des lettres."));
            $this->form_validation->set_rules("pro_bloque", "bloque", "required", array("required" => "Veuillez cocher une case."));

            if ($this->form_validation->run() == false) 
            { // Echec de la validation, on réaffiche la vue formulaire

                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');  

                $this->load->view('header');
                $this->load->view('modifier',$aView);
                $this->load->view('footer');

            } else 
            { // La validation a réussi, nos valeurs sont bonnes, on peut modifier en base

                redirect("produits/liste");

            }
            
        } else 
        { // 1er appel de la page: affichage du formulaire
            $this->load->view('header');
            $this->load->view('modifier', $aView);
            $this->load->view('footer');
        }
    }


    // *** SUPRESSION ***


    public function supprimer($id)
    {
        $this->load->model('ProduitsModel');
        $this->ProduitsModel-> supprim($id);

        redirect("produits/liste");
    }
}
