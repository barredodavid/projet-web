<?php
    session_start();

    if (!isset($_SESSION['logadmin'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   

    if($_POST){
        if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['poste']) && !empty($_POST['poste'])
        && isset($_POST['ville']) && !empty($_POST['ville'])
        && isset($_POST['contrat']) && !empty($_POST['contrat'])
        && isset($_POST['salaire']) && !empty($_POST['salaire'])
        && isset($_POST['descriptionAnn']) && !empty($_POST['descriptionAnn'])){
            
            require_once('connect.php');
            
            $id = strip_tags($_POST['id']);
            $poste = strip_tags($_POST['poste']);
            $ville = strip_tags($_POST['ville']);
            $contrat = strip_tags($_POST['contrat']);
            $salaire = strip_tags($_POST['salaire']);
            $descriptionAnn = strip_tags($_POST['descriptionAnn']);

            $sql = "UPDATE annonce SET poste=:poste, ville=:ville, contrat=:contrat, salaire=:salaire, descriptionAnn=:descriptionAnn WHERE id=:id;";
            
            $query = $db->prepare($sql);

            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->bindValue(':poste', $poste, PDO::PARAM_STR);
            $query->bindValue(':contrat', $contrat, PDO::PARAM_STR);
            $query->bindValue(':ville', $ville, PDO::PARAM_STR);
            $query->bindValue(':salaire', $salaire, PDO::PARAM_INT);
            $query->bindValue(':descriptionAnn', $descriptionAnn, PDO::PARAM_STR);

            $query->execute();
                
            $_SESSION['message'] = "Annnonce modifiée";
            require_once('../apiAd/close.php');

            header('Location: ../apiAd/adminAd.php');

        }else{
            $_SESSION['erreur'] = "Le formulaire est incomplet";
        }
    }

    if(isset($_GET['id']) && !empty($_GET['id'])){
        require_once('../apiAd/connect.php');

        // On nettoie l'id envoyé
        $id = strip_tags($_GET['id']);

        $sql = 'SELECT * FROM annonce WHERE id = :id;';
        
        //On prépare la requête
        $query = $db->prepare($sql);

        //On "accroche" les paramètres (id) 
        $query-> bindValue(':id', $id, PDO::PARAM_INT);

        //On exécute la requête
        $query->execute();

        //On récupère le produit
        $annonce = $query->fetch();

        //On vérifie si le produit existe
        if(!$annonce){
            $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: ../apiAd/adminAd.php');
        } 
    }else{
        $_SESSION['erreur'] = 'URL invalide';
        header('Location: ../apiAd/adminAd.php');
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une annonce</title>
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
                <h1>Modifier une annonce</h1>
                     <form action="" method="post">
                        <div class="form-group">
                           <label for="inputPoste">Nom du poste</label>
                           <input type="text" class="form-control" id="inputPoste" name="poste" value="<?=$annonce['poste']?>"required>
                        </div>
                        <div class="form-group">
                           <label for="inputVille">Ville</label>
                           <input type="text" class="form-control" id="inputVille" name="ville" value="<?=$annonce['ville']?>"required>
                        </div>
                        <div class="form-group">
                           <label for="formSelect1">Type de contrat</label>
                           <select class="form-control" id="formSelect1" name="contrat" value="<?=$annonce['contrat']?>"required>
                             <option>CDI</option>
                             <option>CDD</option>
                             <option>CTT</option>
                             <option>Contrat de professionallisation (alternance)</option>
                             <option>Contrat d'apprentissage (alternance)</option>
                             <option>Stage</option>
                           </select>
                        </div>
                        <div class="form-group">
                          <label for="textarea1">Description du poste</label>
                          <input class="form-control" id="textarea1" rows="10" name="descriptionAnn" required value="<?=$annonce['descriptionAnn']?>">
                        </div>
                        <div class="form-group">
                           <label for="Salaire">Salaire</label>
                           <input type="number" class="form-control" id="Salaire" placeholder="2000-2500" name="salaire" value="<?=$annonce['salaire']?>"required>
                        </div>
                        <div class="form-group oui">
                        <input type="hidden" value="<?=$annonce['id']?>" name="id">
                        <input type="submit" class="btn btn-primary" value="Modifier"/>
                        </div>

                     </form>
            </section>
        </div>
    </main>
    
</body>
</html>