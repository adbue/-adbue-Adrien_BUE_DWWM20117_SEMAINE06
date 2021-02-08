<?php 

    // ENSEMBLE DE FONCTIONS POUR LE PROJET JARDITOU

    // Protection Input (Don't trust user):
        # trim() — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne 
        # stripslashes() — Supprime les antislashs d'une chaîne
        # strip_tags() —  Supprime les balises HTML et PHP d'une chaîne
        # htmlspecialchars() — Convertit les caractères spéciaux en entités HTML
        
    function sanitizing($var) 
    {
        $var = trim($var, " \n\r\t\v\0");
        $var = stripslashes($var);   
        $var = strip_tags($var);
        $var = htmlspecialchars($var);

        return $var;
    }

    // CONNEXION 
        # 1) LoginValid() = boolean -> Est ce que le login et le mot de passe saisi sont présent dans ma base de donnée?

        function loginValid($db, $login, $pass)
        {
            $request = $db->prepare("SELECT * FROM users WHERE us_login=?");
            $request->execute(array($login));
            $row = $request->fetch(PDO::FETCH_ASSOC);

            $passHashed = $row['us_pass'];
    
            if ($request->rowCount() > 0 && password_verify($pass, $passHashed) == 1) 
            {
                return true;
            } else
            {
                return false;
            }
            $request->closeCursor();
        }


