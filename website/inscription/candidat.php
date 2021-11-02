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
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> ce compte existe déjà
                            </div>
                        <?php 
                        break;

                        case 'tel':
                        ?>
                        <div class="alert alert-danger">
                            <strong>Erreur</strong> téléphone incorrect
                        </div>
                        <?php 
                        break;
                    }
                }
                ?>
            
            <form action="add_candidat.php" method="post">
                <h2 class="text-center">Inscription</h2>       
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
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Inscription</button>
                </div>   
            </form>
        </div>
    </body>

</html>