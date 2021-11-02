<?php
    session_start();

    if (!isset($_SESSION['logadmin'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   

    if($_POST){
        if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['nom']) && !empty($_POST['nom'])
        && isset($_POST['prenom']) && !empty($_POST['prenom'])
        && isset($_POST['mail']) && !empty($_POST['mail'])
        && isset($_POST['telephone']) && !empty($_POST['telephone'])){
            
            require_once('connect.php');
            
            $id = strip_tags($_POST['id']);
            $nom = strip_tags($_POST['nom']);
            $prenom = strip_tags($_POST['prenom']);
            $mail = strip_tags($_POST['mail']);
            $telephone = strip_tags($_POST['telephone']);

            $sql = "UPDATE users SET nom=:nom, prenom=:prenom, mail=:mail, telephone=:telephone WHERE id=:id;";
            
            $query = $db->prepare($sql);

            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':nom', $nom, PDO::PARAM_STR);
            $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $query->bindValue(':mail', $mail, PDO::PARAM_STR);
            $query->bindValue(':telephone', $telephone, PDO::PARAM_INT);

            $query->execute();
                
            $_SESSION['message'] = "Annnonce modifiée";
            require_once('../apiUser/close.php');

            header('Location: ../apiUser/adminUser.php');

        }else{
            $_SESSION['erreur'] = "Le formulaire est incomplet";
        }
    }

    if(isset($_GET['id']) && !empty($_GET['id'])){
        require_once('../apiUser/connect.php');

        // On nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        $sql = 'SELECT * FROM users WHERE id = :id;';
        
        //On prépare la requête
        $query = $db->prepare($sql);

        //On "accroche" les paramètres (id) 
        $query-> bindValue(':id', $id, PDO::PARAM_INT);

        //On exécute la requête
        $query->execute();

        //On récupère le produit
        $user = $query->fetch();

        //On vérifie si le produit existe
        if(!$user){
            $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ../apiUser/adminUser.php');
        } 
    }else{
        $_SESSION['erreur'] = 'URL invalide';
        header('Location: ../apiUser/adminUser.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un utilisateur</title>
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
                <h1>Modifier un utilisateur</h1>
                     <form method="post">
                        <div class="form-group">
                           <label for="inputNom">Nom</label>
                           <input type="text" class="form-control" id="inputNom" name="nom" value="<?=$user['nom']?>"required>
                        </div>
                        <div class="form-group">
                           <label for="inputPrenom">Prénom</label>
                           <input type="text" class="form-control" id="inputPrenom" name="prenom" value="<?=$user['prenom']?>"required>
                        </div>
                        <div class="form-group">
                           <label for="inputMail">Mail</label>
                           <input type="text" class="form-control" id="inputMail" name="mail" value="<?=$user['mail']?>"required>
                        </div>
                        <div class="form-group">
                           <label for="inputTel">Téléphone</label>
                           <input type="tel" class="form-control" id="inputTel" placeholder="0612354678" name="telephone" value="<?=$user['telephone']?>"required>
                        </div>
                        <div class="form-group oui">
                        <input type="hidden" value="<?=$user['id']?>" name="id">
                        <input type="submit" class="btn btn-primary" value="Modifier"/>
                        </div>
                     </form>
            </section>
        </div>
    </main>
    
</body>
</html>