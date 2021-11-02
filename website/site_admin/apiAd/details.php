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
    }else{
        $_SESSION['erreur'] = 'URL invalide';
        header('Location: adminAd.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Détails de l'annonce</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails de l'annonce : <?= $annonce['poste'] ?></h1>
                <p>ID : <?= $annonce['id']?></p>
                <p>Poste : <?= $annonce['poste']?></p>
                <p>Contrat : <?= $annonce['contrat']?></p>
                <p>Ville : <?= $annonce['ville']?></p>
                <p>Salaire : <?= $annonce['salaire']?></p>
                <p>Description : <?= $annonce['descriptionAnn']?></p>
                <p><a href="../apiAd/adminAd.php">Retour</a> <a href="update.php?id=<?=$annonce['id']?>">Modifier l'annonce</a></p>
            </section>

        </div>
    </main>
    
</body>
</html>