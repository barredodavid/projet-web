<?php
session_start();
if (!isset($_SESSION['logrecruteur'])) 
   {
      header('Location:http://localhost/website/page_acceuil/Jobboard.php');
      exit;
   }
?>

<html>
    <head>
       <meta charset="utf-8">
       <link rel="stylesheet" href="../css/connexion.css" media="screen" type="text/css" />
       <title>Mon profil</title>
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            <h1>Mon profil</h1>
                
            <h2>Nom</h2>
            <p><?php echo $_SESSION['nom']; ?></p>
            <h2>Prénom</h2>
            <p><?php echo $_SESSION['prenom']; ?></p>
            <h2>Mail</h2>
            <p><?php echo $_SESSION['mail']; ?></p>
            <h2>Téléphone</h2>
            <p><?php echo $_SESSION['telephone']; ?></p>
            <a href="modifier.php">Modifier</a>
            <a href="site_recruteur.php">Accueil</a>
            
        </div>
    </body>
</html>