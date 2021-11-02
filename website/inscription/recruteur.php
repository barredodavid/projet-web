<?php

include("db_connect.php"); // Fichier PHP contenant la connexion à votre BDD
$request_method = $_SERVER["REQUEST_METHOD"];

?> 


<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="author" content="NoS1gnal"/>

            <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="../css/formulaire.css" media="screen" type="text/css" />

            <title>Inscription</title>
        </head>
        <body>
        <div class="login-form">
        <div class="login-form">
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'siret':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> SIRET incorrect
                            </div>
                        <?php 
                        break;

                        case 'naf':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> NAF incorrect
                                </div>
                            <?php 
                            break;
                    }
                }
                ?>
            
            <form action="add_recruteur.php" method="post">
                <h2 class="text-center">Inscription</h2>  
                <h3>Données personnelles</h3>  
                <div class="form-group">
                    <input type="email" name="mail" class="form-control" placeholder="Email" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="nom" class="form-control" placeholder="Nom" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="tel" name="telephone" class="form-control" placeholder="Téléphone" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required="required" autocomplete="off">
                </div>
 
                <h3>Données entreprise</h3>  
                <div class="form-group">
                    <input type="text" name="nom_entreprise" class="form-control" placeholder="Nom entreprise" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="domaine" class="form-control" placeholder="Domaine" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="siret" class="form-control" placeholder="SIRET" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="naf" class="form-control" placeholder="NAF" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="pays" class="form-control" placeholder="Pays" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="ville" class="form-control" placeholder="Ville" required="required" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="text" name="adresse" class="form-control" placeholder="Adresse" required="required" autocomplete="off">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Inscription</button>
                </div>   
            </form>
        </div>
    </body>

</html>