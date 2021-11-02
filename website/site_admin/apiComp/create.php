<?php
    session_start();

    if (!isset($_SESSION['logadmin'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   

    if($_POST){
        if(isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['Nom']) && !empty($_POST['Nom'])
        && isset($_POST['Domaine']) && !empty($_POST['Domaine'])
        && isset($_POST['SIRET']) && !empty($_POST['SIRET'])
        && isset($_POST['NAF']) && !empty($_POST['NAF'])
        && isset($_POST['Pays']) && !empty($_POST['Pays'])
        && isset($_POST['Ville']) && !empty($_POST['Ville'])
        && isset($_POST['Adresse']) && !empty($_POST['Adresse'])){
            
            require_once('../apiComp/connect.php');
        
            $id = strip_tags($_POST['id']);
            $Nom = strip_tags($_POST['Nom']);
            $Domaine = strip_tags($_POST['Domaine']);
            $SIRET = strip_tags($_POST['SIRET']);
            $NAF = strip_tags($_POST['NAF']);
            $Pays = strip_tags($_POST['Pays']);
            $Ville = strip_tags($_POST['Ville']);
            $Adresse = strip_tags($_POST['Adresse']);

            $sql = "INSERT INTO entreprises(Nom, Domaine, SIRET, NAF, Pays, Ville, Adresse) VALUES('".$Nom."', '".$Domaine."', '".$SIRET."', '".$NAF."', '".$Pays."', '".$Ville."', '".$Adresse."')";
    
            $query = $db->prepare($sql);

            $query->execute();

            $_SESSION['message'] = "Utilisateur ajouté";
            require_once('../apiComp/close.php');

            header('Location: ../apiComp/adminComp.php');

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
                <h1>Créer une entreprise</h1>
                <form method="post">
                        <div class="form-group">
                           <label for="inputNom">Nom</label>
                           <input type="text" class="form-control" id="inputNom" name="Nom" required>
                        </div>
                        <div class="form-group">
                           <label for="inputDom">Domaine</label>
                           <input type="text" class="form-control" id="inputDom" name="Domaine" required>
                        </div>
                        <div class="form-group">
                           <label for="inputSir">SIRET</label>
                           <input type="number" class="form-control" id="inputSir" name="SIRET" required>
                        </div>
                        <div class="form-group">
                           <label for="inputNaf">NAF</label>
                           <input type="text" class="form-control" id="inputNaf" name="NAF" required>
                        </div>
                        <div class="form-group">
                           <label for="inputPays">Pays</label>
                           <input type="text" class="form-control" id="inputPays" name="Pays" required>
                        </div>
                        <div class="form-group">
                           <label for="inputVille">Ville</label>
                           <input type="text" class="form-control" id="inputVille" name="Ville" required>
                        </div>
                        <div class="form-group">
                           <label for="inputAdd">Adresse</label>
                           <input type="text" class="form-control" id="inputAdd" placeholder="7 rue de l'espoir" name="Adresse" required>
                        </div>
                        <div class="form-group oui">
                        <input type="hidden" value="<?=$comp['id']?>" name="id">
                        <input type="submit" class="btn btn-primary" value="Créer"/>
                        </div>

                     </form>
            </section>
        </div>
    </main>
    
</body>
</html>