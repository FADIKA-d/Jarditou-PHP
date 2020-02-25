<?php 
 require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
 
 $db = connexionBase(); // Appel de la fonction de connexion
if(!isset($_GET['pro_id'])){
    header('Location:liste_produit.php');
    exit();
}
$pro_id = $_GET['pro_id'];
 $sql = "SELECT `pro_id`, `pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque` FROM `produits` WHERE `pro_id`= :pro_id";
$req = $db->prepare($sql);
$req->bindValue(":pro_id", $pro_id);
$req->execute();
$productDetails = $req->fetch(PDO::FETCH_OBJ);
var_dump($productDetails);
?>
<?php include_once "topOfPage.php" ?>
<form action="products_details">
<label for=""></label>

              

</form>