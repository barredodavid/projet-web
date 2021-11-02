<?php
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

  function AddProduct()
  {
    global $conn;
    $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
    $prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
    $mail = mysqli_real_escape_string($conn, $_POST["mail"]);
    $telephone = mysqli_real_escape_string($conn, $_POST["telephone"]);
    $mdp = mysqli_real_escape_string($conn, password_hash($_POST["mdp"], PASSWORD_DEFAULT));
    
    $select = mysqli_query($conn, "SELECT * FROM users WHERE mail = '".$_POST['mail']."'");
    if(mysqli_num_rows($select)) 
    {
      header('Location:http://localhost/website/inscription/candidat.php'); 
    }
    else if (is_numeric($telephone)) 
    {
      echo $query="INSERT INTO users(nom, prenom, mail, mdp, telephone) VALUES('".$nom."', '".$prenom."', '".$mail."', '".$mdp."', '".$telephone."')";
      if (mysqli_query($conn, $query)) 
      {
        $response=array('status' => 1,);
        session_start();   
        session_regenerate_id(true); 
        $_SESSION["loggedin"] = true;
        $login = "SELECT * FROM users WHERE mail = '".$mail."'";
        $exec_login = mysqli_query($conn,$login);
        $ligne = mysqli_fetch_assoc($exec_login);
        $_SESSION["nom"] = $ligne["nom"];
        $_SESSION["mail"] = $ligne["mail"];
        $_SESSION["telephone"] = $ligne["telephone"];
        $_SESSION["prenom"] = $ligne["prenom"];
        $_SESSION["id_utilisateur"] = $ligne["id_utilisateur"];
      }
      else 
      {
        $response=array('status' => 0,);
      }
      header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
    }
    else
    {
      header('Location:http://localhost/website/inscription/candidat.php');
    }
  }

  function AddProductentreprise()
  {
    global $conn;
    $nom_entreprise = $_POST["nom_entreprise"];
    $domaine = $_POST["domaine"];
    $siret= $_POST["siret"];
    $naf= $_POST["naf"];
    $pays= $_POST["pays"];
    $ville = $_POST["ville"];
    $adresse = $_POST["adresse"];

    if (is_numeric($siret))
    {
      echo $query="INSERT INTO entreprises(Nom, Domaine, SIRET, NAF, Pays, Ville, Adresse) VALUES('".$nom_entreprise."', '".$domaine."', '".$siret."', '".$naf."', '".$pays."', '".$ville."', '".$adresse."')";
      if (mysqli_query($conn, $query)) 
      {
        $response=array('status' => 1,);
      }
      else 
      {
        $response=array('status' => 0,);
        header('Location:http://localhost/website/inscription/inscription.php');
      }
    }
    else
    {
      header('Location:http://localhost/website/inscription/inscription.php');
    }
  }
?>