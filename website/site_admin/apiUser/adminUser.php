<?php
    session_start();

    if (!isset($_SESSION['logadmin'])) 
    {
        header('Location:http://localhost/website/site_utilisateur/site_utilisateur.php');
        exit;
    }   

    require_once('connect.php');

    $sql = 'SELECT * FROM users';

    $query = $db->prepare($sql);

    $query->execute();

    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    require_once('close.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin - Users</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>    
<header>
    <nav class="navbar navbar-expand-lg justify-content-center navbar-light" style="background-color: #e3f2fd; ">
                <ul class="nav">
                   <li class="nav-item">
                      <a class="nav-link text-dark  taille" href="../apiAd/adminAd.php"><h3>Annonces</h3></a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link text-dark taille" href="../apiUser/adminUser.php"><h3>Utilisateurs</h3></a>
                   </li>
                   <li class="nav-item">
                      <a class="nav-link text-dark taille" href="../apiComp/adminComp.php"><h3>Entreprises</h3><a>
                   </li> 
                   <li class="nav-item">
                        <a class="nav-link text-dark  taille" href="../../site_utilisateur/deconnexion.php"><h3>Déconnexion</h3></a>
                    </li>           
                </ul>
             </nav>
    </header>
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
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                        '. $_SESSION['message'].'
                            </div>';
                      $_SESSION['message'] = ""; 
                    }
                ?>
                <h1>Liste des utilisateurs</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($result as $user){
                        ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['nom'] ?></td>
                                <td><?= $user['prenom'] ?></td>
                                <td><?= $user['mail'] ?></td>
                                <td>0<?= $user['telephone'] ?></td>
                                <td><a class="btn btn-success" href="details.php?id=<?= $user['id']?>">Voir</a> <a class="btn btn-primary" href="update.php?id=<?= $user['id']?>">Modifier</a> 
                                <a class="btn btn-danger" href="delete.php?id=<?= $user['id']?>">Supprimer</a></td>
                            </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <a href="create.php" class="btn btn-primary">Ajouter un utilisateur</a>

            </section>

           
        </div>
    </main>
    
</body>
</html>