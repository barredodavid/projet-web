<?php

    if (!isset($_SESSION['loguser'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   
    //Déconnexion de la base
    $db = null;
?>