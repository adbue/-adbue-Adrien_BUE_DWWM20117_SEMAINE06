<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class ProduitsModel extends CI_Model
{

    //  *** SANS ARGUMEMENT ***



    public function liste()
    {
        $request = $this->db->query("SELECT * FROM produits");
        $aProduits = $request->result();

        return $aProduits;
    }

    public function categorie()
    {
        $request = $this->db->query("SELECT * FROM categories ORDER BY cat_nom ASC");
        $aCategories = $request->result();

        return $aCategories;
    }



    // *** AVEC ARGUMENTS ***



    public function listeDetail($id)
    {
        $request = $this->db->query("SELECT * FROM produits INNER JOIN categories ON pro_cat_id = cat_id WHERE pro_id=?", $id);
        $aProduits = $request->row();

        return $aProduits;

    }

    public function listeProduits($id)
    {
        $request = $this->db->query("SELECT * FROM produits WHERE pro_id=?", $id);
        $aProduit = $request->row();

        return $aProduit;

    }



    // *** REQUETE CRUD ***



    // *** INSERT ***

    public function add($date)
    {
        return $this->db->insert('produits', $data);
    }

    // *** UPDATE ***

    public function update($data, $id)
    {
        //  Reprise du cours
            /* Utilisation de la méthode where() toujours
             * avant select(), insert() ou update()
             * dans cette configuration sur plusieurs lignes
             */

        $this->db->where('pro_id', $id);
        return $this->db->update('produits', $data);

    }

    // *** DELETE ***

    public function supprim($id)
    {
        $this->db->where('pro_id', $id);
        return $this->db->delete('produits');
    }
}