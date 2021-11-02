<?php
//on démarre une session
session_start();

    if (!isset($_SESSION['logadmin'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   

    if(isset($_GET['id']) && !empty($_GET['id'])){
        require_once('connect.php');

        // On nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        $sql = 'SELECT * FROM users WHERE id = :id;';
        
        //On prépare la requête
        $query = $db->prepare($sql);

        //On "accroche" les paramètres (id) 
        $query-> bindValue(':id', $id, PDO::PARAM_INT);

        //On exécute la requête
        $query->execute();

        //On récupère le produit
        $user = $query->fetch();

        //On vérifie si le produit existe
        if(!$user){
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('Location: ../apiUser/adminUser.php');
        } 

         $sql = 'DELETE FROM users WHERE id = :id;';
         
         //On prépare la requête
         $query = $db->prepare($sql);
 
         //On "accroche" les paramètres (id) 
         $query-> bindValue(':id', $id, PDO::PARAM_INT);
 
         //On exécute la requête
         $query->execute();
         $_SESSION['message'] = "Utilisateur supprimée";
            header('Location: ../apiUser/adminUser.php');
 
    }else{
        $_SESSION['erreur'] = 'URL invalide';
        header('Location: ../apiUser/adminUser.php');
    }
?>