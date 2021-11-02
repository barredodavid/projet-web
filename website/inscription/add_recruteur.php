<?php
// Se connecter à la base de données
include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method)
{    
  case 'POST':
    // Ajouter un produit
    Addentreprise();
    Adduser();
    //Adduser();
    break;
 }

 
function Adduser()
{
  global $conn;
  $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
  $prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
  $mail = mysqli_real_escape_string($conn, $_POST["mail"]);
  $telephone = mysqli_real_escape_string($conn, $_POST["telephone"]);
  $mdp = mysqli_real_escape_string($conn, password_hash($_POST["mdp"], PASSWORD_DEFAULT));
  $classe = 2;
  
  $select = mysqli_query($conn, "SELECT * FROM users WHERE mail = '".$_POST['mail']."'");
  if(mysqli_num_rows($select)) 
  {
    header('Location: http://localhost/website/inscription/recruteur.php?reg_err=already'); 
  }
  else if(is_numeric($telephone) && strlen($telephone) == 10)
  {
    echo $query2="INSERT INTO users(nom, prenom, mail, mdp, telephone, classe) VALUES('".$nom."', '".$prenom."', '".$mail."', '".$mdp."', '".$telephone."', '".$classe."')";
    if (mysqli_query($conn, $query2)) 
    {
      $response=array('status' => 1,);
      session_start();   
      session_regenerate_id(true); 
      $_SESSION["logrecruteur"] = true;
      $login = "SELECT * FROM users WHERE mail = '".$mail."'";
      $exec_login = mysqli_query($conn,$login);
      $ligne = mysqli_fetch_assoc($exec_login);
      $_SESSION["nom"] = $ligne["nom"];
      $_SESSION["mail"] = $ligne["mail"];
      $_SESSION["telephone"] = $ligne["telephone"];
      $_SESSION["prenom"] = $ligne["prenom"];
      $_SESSION["id"] = $ligne["id"];    

      header('Location:http://localhost/website/site_recruteur/site_recruteur.php');
    }
  }
  else 
  {
    header('Location: http://localhost/website/inscription/recruteur.php?reg_err=tel'); 
  }

}

function Addentreprise()
  {
    global $conn;
    $nom_entreprise = mysqli_real_escape_string($conn,$_POST["nom_entreprise"]);
    $domaine = mysqli_real_escape_string($conn,$_POST["domaine"]) ;
    $siret= mysqli_real_escape_string($conn,$_POST["siret"]);
    $naf= mysqli_real_escape_string($conn,$_POST["naf"]);
    $pays= mysqli_real_escape_string($conn,$_POST["pays"]);
    $ville = mysqli_real_escape_string($conn,$_POST["ville"]);
    $adresse = mysqli_real_escape_string($conn,$_POST["adresse"]);

    if (is_numeric($siret) && strlen($siret) == 14)
    {
      if (strlen($naf) == 5)
      {
      echo $query="INSERT INTO entreprises(Nom, Domaine, SIRET, NAF, Pays, Ville, Adresse) VALUES('".$nom_entreprise."', '".$domaine."', '".$siret."', '".$naf."', '".$pays."', '".$ville."', '".$adresse."')";
      mysqli_query($conn, $query);
      }
      else
      {
        header('Location:http://localhost/website/inscription/recruteur.php?reg_err=naf');
      } 
    }
    else
    {
      header('Location:http://localhost/website/inscription/recruteur.php?reg_err=siret');
    }
  }

