<?php
    session_start();

    if (!isset($_SESSION['logadmin'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   

    if($_POST){
        if(isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['prenom']) && !empty($_POST['prenom'])
        && isset($_POST['mail']) && !empty($_POST['mail'])
        && isset($_POST['telephone']) && !empty($_POST['telephone'])){
            
            require_once('../apiUser/connect.php');
        
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $mail = strip_tags($_POST['mail']);
            $telephone = strip_tags($_POST['telephone']);
            $mdp = strip_tags($_POST['mdp']);

            $sql = "INSERT INTO users(nom, prenom, mail, telephone, mdp) VALUES('".$nom."', '".$prenom."', '".$mail."', '".$telephone."','".$mdp."')";
    
            $query = $db->prepare($sql);

            $query->execute();

            $_SESSION['message'] = "Utilisateur ajouté";
            require_once('../apiUser/close.php');

            header('Location: ../apiUser/adminUser.php');

        }else{
            $_SESSION['erreur'] = "Le formulaire est incomplet";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une annonce</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                        '. $_SESSION['erreur'].'
                            </div>';
                      $_SESSION['erreur'] = ""; 
                    }
                ?>
                <h1>Créer un utilisateur</h1>
                     <form method="post">
                        <div class="form-group">
                           <label for="inputNom">Nom</label>
                           <input type="text" class="form-control" id="inputNom" name="nom" required>
                        </div>
                        <div class="form-group">
                           <label for="inputPrenom">Prénom</label>
                           <input type="text" class="form-control" id="inputPrenom" name="prenom" required>
                        </div>
                        <div class="form-group">
                           <label for="inputMail">Mail</label>
                           <input type="text" class="form-control" id="inputMail" name="mail" required>
                        </div>
                        <div class="form-group">
                           <label for="inputTel">Téléphone</label>
                           <input type="number" class="form-control" id="inputTel" placeholder="0612354678" name="telephone" required>
                        </div>
                        <div class="form-group">
                           <label for="inputTel">Mot de passe</label>
                           <input type="text" class="form-control" id="inputMdp" name="mdp" required>
                        </div>
                        <div class="form-group oui">
                        <input type="hidden" value="<?=$user['id']?>" name="id">
                        <input type="submit" class="btn btn-primary" value="Créer"/>
                        </div>

                     </form>
            </section>
        </div>
    </main>
    
</body>
</html>