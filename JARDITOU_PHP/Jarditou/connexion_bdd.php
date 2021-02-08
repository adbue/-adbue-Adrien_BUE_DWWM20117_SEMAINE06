<?php

    function connexionBase()
    {
        // Constantes avec paramètres de connexion :
        
        $HOST = 'localhost:3308';
        $USER = 'root';
        $PASS = '';
        $DB = 'jarditou';
        
        try
        {
            $dsn ='mysql:host='.$HOST.';charset=utf8;dbname='.$DB;
            $acces = new PDO($dsn,$USER,$PASS);
            $acces->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $acces;

        } catch (Exception $e) 
        {
            echo 'Erreur : ' . $e->getMessage() . '<br>';
            echo 'N° : ' . $e->getCode() . '<br>';
            die('Connexion au serveur impossible.');
        }
        $acces->closeCursor();
    }

