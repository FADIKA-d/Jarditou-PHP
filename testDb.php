<?php 
  try 
  {        
      $db = new PDO('mysql:host=localhost:3308;charset=utf8;dbname=hotel', 'root', '');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch (PDOException $e) {
     echo "Erreur : " . $e->getMessage() . "<br>";
     echo "N° : " . $e->getCode();
     die("Fin du script");
}  
//$requete = "SELECT * FROM produits WHERE pro_id->:7"; // Toutes les colonnes de la table
//$result = $db->query($requete);
//$produit = $result->fetch(PDO::FETCH_OBJ); // Pour chaque ligne
/*while ($produit = $result->fetch(PDO::FETCH_OBJ)) // Pour toute la colonne
{
   echo $produit->pro_id." – ".$produit->pro_libelle. "<br>";
}*/
/*$requete->bindValue(":7",$sept);
$requete->execute();
$tableau = $requete->fetchAll();

$altitude = 50;
$requete=$db->prepare("INSERT INTO `station` (`sta_altitude`) VALUES (:altitude)");
$requete->bindValue(":altitude",$altitude);
if($requete->execute()){
    $success = true;
}
*/
INSERT INTO `station` (`sta_altitude`) VALUES (12);
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testDb.php</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.13.0/css/mdb.min.css" rel="stylesheet">
</head>

<body>
    <?php
if(isset($success)) { ?>
    <p class="alert alert-success">L'altitude a été ajoutée !</p>
    <?php } ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <!-- Card -->
                <div class="card">

                    <!-- Card body -->
                    <div class="card-body">

                        <!-- Material form register -->
                        <form>
                            <p class="h4 text-center py-4">Sign up</p>

                            <!-- Material input text -->
                            <div class="md-form">
                                <i class="fa fa-user prefix grey-text"></i>
                                <input type="text" id="materialFormCardNameEx" class="form-control">
                                <label for="materialFormCardNameEx" class="font-weight-light">Your name</label>
                            </div>

                            <!-- Material input email -->
                            <div class="md-form">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <input type="email" id="materialFormCardEmailEx" class="form-control">
                                <label for="materialFormCardEmailEx" class="font-weight-light">Your email</label>
                            </div>

                            <!-- Material input email -->
                            <div class="md-form">
                                <i class="fa fa-exclamation-triangle prefix grey-text"></i>
                                <input type="email" id="materialFormCardConfirmEx" class="form-control">
                                <label for="materialFormCardConfirmEx" class="font-weight-light">Confirm your
                                    email</label>
                            </div>

                            <!-- Material input password -->
                            <div class="md-form">
                                <i class="fa fa-lock prefix grey-text"></i>
                                <input type="password" id="materialFormCardPasswordEx" class="form-control">
                                <label for="materialFormCardPasswordEx" class="font-weight-light">Your password</label>
                            </div>

                            <div class="text-center py-4 mt-3">
                                <button class="btn btn-cyan" type="submit">Register</button>
                            </div>
                        </form>
                        <!-- Material form register -->

                    </div>
                    <!-- Card body -->

                </div>
                <!-- Card -->

            </div>
        </div>
    </div>
    
</body>

</html>