<?php
  session_start();
  // Se connecter à la base de données
  include("db_connect.php");
  $request_method = $_SERVER["REQUEST_METHOD"];

  switch($request_method)
  {
    default:
      // Requête invalide
      header("HTTP/1.0 405 Method Not Allowed");
      break;
      
    case 'POST':
        // Ajouter un produit
        AddProduct();
        break;
    
   }

  /*function AddProduct()
  {
    global $conn;
    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $mail = $_SESSION["mail"];
    $telephone = $_SESSION["telephone"];
    $mdp = $_SESSION["mdp"];
      echo $query="INSERT INTO users(nom, prenom, mail, mdp, telephone) VALUES('".$nom."', '".$prenom."', '".$mail."', '".$mdp."', '".$telephone."')";
    if (mysqli_query($conn, $query)) 
    {
      $response=array('status' => 1,);
      header('Location:http://localhost/website/page_acceuil/site_utilisateur.php');
    }
    else 
    {
      $response=array('status' => 0,);
      header('Location:http://localhost/website/inscription/inscription.php');

    }
  }*/

  function AddProduct()
  {
    echo $_SESSION["id_utilisateur"];
    echo $_SESSION["nom"];
  }

?>