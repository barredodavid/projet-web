<?php
//on démarre une session
session_start();

    if (!isset($_SESSION['logadmin'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   

    if(isset($_GET['id']) && !empty($_GET['id'])){
        require_once('../apiComp/connect.php');

        // On nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        $sql = 'SELECT * FROM entreprises WHERE id = :id;';
        
        //On prépare la requête
        $query = $db->prepare($sql);

        //On "accroche" les paramètres (id) 
        $query-> bindValue(':id', $id, PDO::PARAM_INT);

        //On exécute la requête
        $query->execute();

        //On récupère le produit
        $comp = $query->fetch();

        //On vérifie si le produit existe
        if(!$comp){
            $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: adminComp.php');
        } 
    }else{
        $_SESSION['erreur'] = 'URL invalide';
        header('Location: adminComp.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Détails de l'entreprise</title>
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails de l'entreprise : <?= $comp['Nom'] ?></h1>
                <p>ID : <?= $comp['id']?></p>
                <p>Nom : <?= $comp['Nom']?></p>
                <p>Domaine : <?= $comp['Domaine']?></p>
                <p>SIRET : <?= $comp['SIRET']?></p>
                <p>NAF : <?= $comp['NAF']?></p>
                <p>Pays : <?= $comp['Pays']?></p>
                <p>Ville : <?= $comp['Ville']?></p>
                <p>Adresse : <?= $comp['Adresse']?></p>
                <p><a href="../apiComp/adminComp.php">Retour</a> <a href="../apiComp/update.php?id=<?=$comp['id']?>">Modifier l'entreprise</a></p>
            </section>

        </div>
    </main>
    
</body>
</html>