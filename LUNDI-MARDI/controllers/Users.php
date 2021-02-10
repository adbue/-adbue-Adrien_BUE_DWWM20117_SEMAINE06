<?php
date_default_timezone_set("Europe/Paris");

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function inscription()
    {
        if($this->input->post())
        {
            $data = $this->input->post(); // Tableau de l'ensemble de nos données récoltés sur la page

            $this->form_validation->set_rules('Nom','nom', 'required|regex_match[]', array('required' => 'Veuillez compléter ce champ.', 'regex_match' => 'Votre saisie pour le champ %s est incorrecte.'));
            $this->form_validation->set_rules('Prenom','prénom', 'required|regex_match', array('required' => 'Veuillez compléter ce champ.', 'regex_match' => 'Votre saisie pour le champ %s est incorrecte.'));
            $this->form_validation->set_rules('Email','adresse mail', 'required|regex_match', array('required' => 'Veuillez compléter ce champ.', 'regex_match' => 'Votre saisie pour le champ %s est incorrecte.'));
            $this->form_validation->set_rules('Pass','mot de passe', 'required|regex_match', array('required' => 'Veuillez compléter ce champ.', 'regex_match' => 'Votre saisie pour le champ %s est incorrecte.'));
            $this->form_validation->set_rules('V_Pass','confirmation du mot de passe', 'required|regex_match', array('required' => 'Veuillez compléter ce champ.', 'regex_match' => 'Votre saisie pour le champ %s est incorrecte.'));

            if($this->form_validation->run() == TRUE)
            {
                $nom = $data["Nom"];
                $prenom = $data["Prenom"];
                $mail= $data["Email"];
                $pass = $data["Pass"];
                $pas_v = $data["V_Pass"];
                $date_d_ajout = date("Y-m-d H:i:s");

                $this->load->model("UsersModels");
            }
        }
        $this->load->view("header");
        $this->load->view("inscription");
        $this->load->view("footer");
    }

    public function connexion()
    {
        if ($this->input->post())
        { 
            $data = $this->input->post(); // Tableau de l'ensemble de nos données récoltés sur la page

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 

            $this->form_validation->set_rules('Login', 'Identifiant','required|valid_Email', array("required" => "Veuillez renseigner un %s.", "valid_Email" => "L' %s doit obligatoirement être une adresse mail."));
            $this->form_validation->set_rules('Pass', 'Password','required', array("required" => "Veuillez renseigner un mot de passe."));

            if($this->form_validation->run() == TRUE)
            {
                                /* 
                *   SI les valeurs contenues dans notre formulaire sont en adéquation avec 
                *   avec nos règles, on récup' les donnés dans deux variables et on les comparent 
                *   avec les valeurs présentent dans notre base de donnée.
                *   SI oui, $_SESSION. Autrement redirection login();
                 */

                $login = $data["Login"];
                $pass = $data["Pass"];

                $this->load->model("UsersModels");
                $user = $this->UsersModels->connectLogin($login);
                $passVerif = password_verify($pass, $user->us_pass);

                if($passVerif == 1)
                {
                    $_SESSION["prenom"] = $user->us_prenom;
                    $_SESSION["nom"] = $user->us_nom;

                    if($user->us_role == 1)
                    {
                        $_SESSION["role"] = "admin";
                    } 
                    else
                    {
                        $_SESSION["role"] = "client";
                    }

                    redirect("produits/accueil");
                }
            }
            else 
            {
                
            }

        }

        $this->load->view("header");
        
        $this->load->view("connexion");
        
        $this->load->view("footer");
    }

    public function validation()
    {
        if ($this->input->post()) 
        {
            $data = $this->input->post(); // Tableau de l'ensemble de nos données récoltés sur la page

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 

            $this->form_validation->set_rules('us_login', 'Login','required|valid_Email', array("required" => "Veuillez renseigner un %s.", "valid_Email" => "Le %s doit obligatoirement être une adresse mail."));
            $this->form_validation->set_rules('us_pass', 'Pass','required', array("required" => "Veuillez renseigner un mot de passe."));

            if($this->form_validation->run() == TRUE) 
            {
                /* 
                *   SI les valeurs contenues dans notre formulaire sont en adéquation avec 
                *   avec nos règles, on récup' les donnés dans deux variables et on les comparent 
                *   avec les valeurs présentent dans notre base de donnée.
                *   SI oui, $_SESSION. Autrement redirection login();
                 */

                $us_login = $data["Login"];
                $us_pass = $data["Pass"];

                $this->load->model("UsersModels");
                $user = $this->UsersModels->connectLogin($us_login);
                $passVerif = password_verify($us_pass, $User->us_pass);

                if($passVerif == 1)
                {
                    $_SESSION["prenom"] = $user->us_prenom;
                    $_SESSION["nom"] = $user->us_nom;

                    if($user->us_role == 1)
                    {
                        $_SESSION["role"] = "admin";
                    } else
                    {
                        $_SESSION["role"] = "client";
                    }

                    redirect("produits/index");
                } else 
                {
                    // Échec ! Envoi vers la page connexion.php
                    $this->connexion();
                }
        }else 
        {
            // Échec ! Envoi vers la page connexion.php
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
        }
        }

    }

    public function deconnexion()
    {
        unset($_SESSION["prenom"]);
        unset ($_SESSION["nom"]);
        unset ($_SESSION["role"]);

        if (ini_get("session.use_cookies")) 
        {
            setcookie(session_name(), '', time()-1, null, false, true);
        }

        session_destroy();

        redirect(produits/index);
    }
    
}