<?php
    session_start();
    if (!isset($_SESSION['logadmin'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   

    if($_POST){
        if(isset($_POST['poste']) && !empty($_POST['poste'])
        && isset($_POST['ville']) && !empty($_POST['ville'])
        && isset($_POST['contrat']) && !empty($_POST['contrat'])
        && isset($_POST['salaire']) && !empty($_POST['salaire'])
        && isset($_POST['descriptionAnn']) && !empty($_POST['descriptionAnn'])){
            
            require_once('connect.php');
        
            $poste = strip_tags($_POST['poste']);
            $ville = strip_tags($_POST['ville']);
            $contrat = strip_tags($_POST['contrat']);
            $salaire = strip_tags($_POST['salaire']);
            $description = strip_tags($_POST['descriptionAnn']);

            $sql = "INSERT INTO annonce(poste, descriptionAnn, salaire, contrat, ville) VALUES('".$poste."', '".$description."', '".$salaire."', '".$contrat."', '".$ville."')";
    
            $query = $db->prepare($sql);

            $query->execute();

            $_SESSION['message'] = "Annnonce ajoutée";
            require_once('close.php');

            header('Location: ../apiAd/adminAd.php');

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
                <h1>Ajouter une annonce</h1>
                     <form action="" method="post">
                        <div class="form-group">
                           <label for="inputPoste">Nom du poste</label>
                           <input type="text" class="form-control" id="inputPoste" name="poste" required>
                        </div>
                        <div class="form-group">
                           <label for="inputVille">Ville</label>
                           <input type="text" class="form-control" id="inputVille" name="ville" required>
                        </div>
                        <div class="form-group">
                           <label for="formSelect1">Type de contrat</label>
                           <select class="form-control" id="formSelect1" name="contrat"required>
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
                          <input class="form-control" id="textarea1" rows="10" name="descriptionAnn">
                        </div>
                        <div class="form-group">
                           <label for="Salaire">Salaire</label>
                           <input type="number" class="form-control" id="Salaire" placeholder="2000-2500" name="salaire" required>
                        </div>
                        <div class="form-group oui">
                        <input type="submit" class="btn btn-primary" value="Créer"/>
                        </div>

                     </form>
            </section>
        </div>
    </main>
    
</body>
</html>