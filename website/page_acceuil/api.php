<?php
  // Se connecter à la base de données
  include("db_connect.php");
  $request_method = $_SERVER["REQUEST_METHOD"];

  switch($request_method)
  {
    case 'GET':
      if(!empty($_GET["id"]))
      {
        // Récupérer un seul produit
        $id = intval($_GET["id"]);
        getProducts($id);
      }
      else
      {
        // Récupérer tous les produits
        getProducts();
      }
      break;
    default:
      // Requête invalide
      header("HTTP/1.0 405 Method Not Allowed");
      break;
      
    case 'POST':
        // Ajouter un produit
        AddProduct();
        break;

    case 'PUT':
        // Modifier un produit
        $id = intval($_GET["id"]);
        updateProduct($id);
        break;

    case 'DELETE':
        // Supprimer un produit
        $id = intval($_GET["id"]);
        deleteProduct($id);
        break;    
    
   }


  function getProducts()
  {
    global $conn;
    $query = "SELECT * FROM add_";
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result))
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }


  function getProduct($id=0)
  {
    global $conn;
    $query = "SELECT * FROM add_";
    if($id != 0)
    {
      $query .= " WHERE id=".$id." LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($result));
    {
      $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response, JSON_PRETTY_PRINT);
  }  


  function AddProduct()
  {
    global $conn;
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $mail = $_POST["mail"];
    $telephone = $_POST["telephone"];
    $mdp = $_POST["mdp"];
    if (is_numeric($telephone))
    {
      echo $query="INSERT INTO users(nom, prenom, mail, mdp, telephone) VALUES('".$nom."', '".$prenom."', '".$mail."', '".$mdp."', '".$telephone."')";
    if (mysqli_query($conn, $query)) 
    {
      $response=array('status' => 1,);
    }
    else 
    {
      $response=array('status' => 0,);
    }
      header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
    }
    else
    {
      header('Location:http://localhost/website/inscription/inscription.php');
    }
  }


  function updateProduct($id)
  {
    global $conn;
    $_PUT = array(); //tableau qui va contenir les données reçues
    parse_str(file_get_contents('php://input'), $_PUT);
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $sexe = $_POST["sexe"];
    $email = $_POST["email"];
    //construire la requête SQL
    $query="UPDATE users SET nom='".$nom."', prenom='".$prenom."', age='".$age."', sexe='".$sexe."', email='".$email."' WHERE id=".$id;
    
    if(mysqli_query($conn, $query))
    {
      $response=array('status' => 1,);
    }
    else
    {
      $response=array('status' => 0,);
      
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }


  function deleteProduct($id)
  {
    global $conn;
    $query = "DELETE FROM users WHERE id=".$id;
    if(mysqli_query($conn, $query))
    {
      $response=array('status' => 1,);
    }
    else
    {
      $response=array('status' => 0,);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
  }

?>