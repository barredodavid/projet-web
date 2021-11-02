<?php 
// connexion à la base de données
include("db_connect.php");
$request_method = $_SERVER["REQUEST_METHOD"];

   
    
if(isset($_POST['mail']) && isset($_POST['mdp']))
{
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $mdp = mysqli_real_escape_string($conn, $_POST['mdp']);
    global $conn;


    if($mail !== "" && $mdp !== "")
    {
        $requete = "SELECT * FROM users where mail = '".$mail."' ";
        $exec_requete = mysqli_query($conn,$requete);
        $num = mysqli_num_rows($exec_requete);

        if($num == 1)
            while($row = mysqli_fetch_array($exec_requete))
            {
                if (password_verify($mdp, $row['mdp']))
                {
                    session_start();   
                    session_regenerate_id(true); 
                    $_SESSION["loguser"] = true;
                    $login = "SELECT * FROM users WHERE mail = '".$mail."'";
                    $exec_login = mysqli_query($conn,$login);
                    $ligne = mysqli_fetch_assoc($exec_login);
                    $_SESSION["nom"] = $ligne["nom"];
                    $_SESSION["mail"] = $ligne["mail"];
                    $_SESSION["telephone"] = $ligne["telephone"];
                    $_SESSION["prenom"] = $ligne["prenom"];
                    $_SESSION["id"] = $ligne["id"];
                    $_SESSION["classe"] = $ligne["classe"];
                    if ($_SESSION["classe"] == "0")
                    {
                        $_SESSION["logadmin"] = true;
                        header('Location: http://localhost/website/site_admin/apiAd/adminAd.php');
                    }
                    else if($_SESSION["classe"] == "1")
                    {
                        $_SESSION["loguser"] = true;
                        header('Location: http://localhost/website/site_utilisateur/site_utilisateur.php');
                    }
                    else if($_SESSION["classe"] == "2")
                    {
                        $_SESSION["logrecruteur"] = true;
                        header('Location: http://localhost/website/site_recruteur/site_recruteur.php');
                    }
                } 
                else
                {
                   header('Location: http://localhost/website/connexion/connexion.php?login_err=password'); 
                }
            }
        else
        {
           header('Location: http://localhost/website/connexion/connexion.php?login_err=email'); 
        }
    }

}
?>

