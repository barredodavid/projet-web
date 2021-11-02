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

        $sql = 'SELECT * FROM annonce WHERE id = :id;';
        
        //On prépare la requête
        $query = $db->prepare($sql);

        //On "accroche" les paramètres (id) 
        $query-> bindValue(':id', $id, PDO::PARAM_INT);

        //On exécute la requête
        $query->execute();

        //On récupère le produit
        $annonce = $query->fetch();

        //On vérifie si le produit existe
        if(!$annonce){
            $_SESSION['erreur'] = "Cet id n'existe pas";
            header('Location: adminAd.php');
        } 

         $sql = 'DELETE FROM annonce WHERE id = :id;';
         
         //On prépare la requête
         $query = $db->prepare($sql);
 
         //On "accroche" les paramètres (id) 
         $query-> bindValue(':id', $id, PDO::PARAM_INT);
 
         //On exécute la requête
         $query->execute();
         $_SESSION['message'] = "Annonce supprimée";
            header('Location: adminAd.php');
 
    }else{
        $_SESSION['erreur'] = 'URL invalide';
        header('Location: adminAd.php');
    }
?>