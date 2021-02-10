<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class UsersModels extends CI_Model
{
    // INSERTION DES DONNÉES
    public function Inscription()
    {
        $this->db->insert('users', $data);
    }

    // RÉCUPÉRATION DES DONNÉES CORRESPONDANT AU LOGIN DE L'UTILISATEUR
    function connectLogin($us_login)
    {
        $request = $this->db->query("SELECT * FROM users WHERE us_login=?", $us_login);

        $User = $request->row();

        return $User;
    }
}