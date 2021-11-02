<?php
session_start();

if (!isset($_SESSION['logrecruteur'])) 
   {
      header('Location:http://localhost/website/page_acceuil/Jobboard.php');
      exit;
   }

   $objectPdo = new PDO('mysql:host=localhost;dbname=Jobboard', 'root','');

   $pdoStat = $objectPdo->prepare('SELECT * FROM entreprises');

   $executeIsOk = $pdoStat->execute();

   $entreprise = $pdoStat->fetchAll();
   
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" media="screen" type="text/css" href="../css/index2.css"/>
    
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

   <div class="container bigbox">

      <?php foreach($entreprise as $entreprises): ?>
         <div class="box" >
            <h2>
               <?= $entreprises['Nom']?>
            </h2>
               <ul>
                  <li>
                     Domaine : <?= $entreprises['Domaine'] ?>
                  </li>
                  <li>
                     SIRET : <?= $entreprises['SIRET']?>
                  </li>
                  <li>
                     NAF : <?= $entreprises['NAF']?>
                  </li>
               </ul>    
      </div>      

   <?php endforeach; ?>          
<!-- FIN -->
</main>
<footer>
   <span class="foot1">
      &copy; Copyright 2021
   </span>
</footer>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>