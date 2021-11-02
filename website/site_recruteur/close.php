<?php

    if (!isset($_SESSION['logrecruteur'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   
    //Déconnexion de la base
    $db = null;
?>