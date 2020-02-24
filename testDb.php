<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>testDb.php</title>
        
<?php 
  try 
  {        
      $db = new PDO('mysql:host=localhost:3308;charset=utf8;dbname=jarditou', 'root', '');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch (Exception $e) {
     echo "Erreur : " . $e->getMessage() . "<br>";
     echo "N° : " . $e->getCode();
     die("Fin du script");
}  
$requete = "SELECT * FROM produits ";
$result = $db->query($requete);
$produit = $result->fetch(PDO::FETCH_OBJ);

$result->closeCursor(); 
	

?>
</head>
<body>
<?php echo $produit->pro_id; ?>
 <br>
 <?php echo $produit->pro_cat_id; ?>
 <br>
 <?php echo $produit->pro_ref; ?>
 <br>
 <?php echo $produit->pro_libelle; ?>
 <br>
 <?php echo $produit->pro_description; ?>
 <br>
 <?php echo $produit->pro_prix; ?>
 <br> 
 <?php echo $produit->pro_stock; ?>
 <br>
 <?php echo $produit->pro_couleur; ?>
 <br>
 <?php echo $produit->pro_photo; ?>
 <br> 
 <?php echo $produit->pro_d_ajout; ?>
 <br> 
 <?php echo $produit->pro_d_modif; ?>
 <br> 
 <?php echo $produit->pro_bloque; ?>

</body>
</html>