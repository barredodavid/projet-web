<?php
session_start();

if (!isset($_SESSION['logrecruteur'])) 
   {
      header('Location:http://localhost/website/page_acceuil/Jobboard.php');
      exit;
   }

   $objectPdo = new PDO('mysql:host=localhost;dbname=Jobboard', 'root','');

   $pdoStat = $objectPdo->prepare('SELECT * FROM annonce');

   $executeIsOk = $pdoStat->execute();

   $annonces = $pdoStat->fetchAll();
   
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" media="screen" type="text/css" href="../css/index2.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    
    <title>Jobboard</title>
</head>
<body>
   <header class="container">
      <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light justify-content-center">
         <ul class="nav">
            <li class="nav-item">
               <a class="nav-link text-dark taille" href="site_recruteur.php">Annonces</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark taille" href="entreprise.php">Entreprises</a>
            </li>
            <li class="nav-item">
               <a class="nav-link text-dark taille" href="profil.php">Mon profil</a>
            </li>                    
            <li class="nav-item">
               <a class="nav-link text-dark  taille" href="deconnexion.php">Déconnexion</a>
            </li>              
         </ul>
      </nav>
   </header>

   <main>
   <!-- annonces de job--> 
   <div class="login-form">
             <?php 
                if(isset($_GET['add_success']))
                {
                    $err = htmlspecialchars($_GET['add_success']);

                    switch($err)
                    {
                        case 'add':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> annonce ajoutée
                            </div>
                        <?php
                        break;
                    }
                }
                ?> 
   </div>

   <div class="container bigbox2">
      <div class="box2">
         <a class="btn btn-primary" id="btn1" href="createAD.php" role="button">Créer une annonce</a>
      </div>
   </div>

   <div class="container bigbox">

      <?php foreach($annonces as $annonce): ?>
         <div class="box" >
            <h2>
               <?= $annonce['poste']?>
            </h2>
               <ul>
                  <li>
                     <?= $annonce['salaire'] . '€' ?>
                  </li>
                  <li>
                     <?= $annonce['contrat']?>
                  </li>
                  <li>
                     <?= $annonce['ville']?>
                  </li>
               </ul>
                  <span id="moreText">
                     <?= $annonce['descriptionAnn']?>
                  </span>
               
               <button class="btn btn-outline-primary read-more-btn">En savoir plus</button>  

               <a name="id_annonce" href="apply.php" value= "ss" >Apply</a>


      </div>      

   <?php endforeach; ?>          
<!-- FIN -->
</main>
<footer>
   <span class="foot1">
      &copy; Copyright 2021
   </span>
</footer>
   <script src="../js/index.js"></script>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>