<?php 
 require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
 
 $db = connexionBase(); // Appel de la fonction de connexion
if(!isset($_GET['pro_id'])){
    header('Location:liste_produit.php');
    exit();
}
$pro_id = $_GET['pro_id'];
 $sql = "SELECT `pro_id`, `pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque` FROM `produits` WHERE `pro_id`= :pro_id AND ISNULL(pro_bloque) ORDER BY 'pro_d_ajout' DESC";
$req = $db->prepare($sql);
$req->bindValue(":pro_id", $pro_id);
$req->execute();
$productDetails = $req->fetch(PDO::FETCH_ASSOC);
$libelleTable = ['ID', 'Référence', 'Catégorie', 'Libellé', 'Description', 'Prix', 'Stock', 'Couleur', 'Photo', 'Date d\'ajout', 'Date de modification', 'Bloqué'];
$table = (array_combine($libelleTable,$productDetails));

?>
<?php include_once "topOfPage.php" ?>
<form action="products_details">
    <?php
    foreach ($table as $key => $details)
    {
        $libelle = array_search($details, $table);
        ?>
    <div>
        <label for=""><?php echo $libelle?></label>
    </div>
    <div><input type="text" name="" id="" value=" <?php echo $details?>"></div>
    <?php
       if($libelle=='Date d\'ajout' || $libelle=='Date de modification')
       {
        ?>
        <input type="text">
        <?php
        }
       if($libelle=='Bloqué')
       { 
        ?>
         <input type="text">
         <?php
       }
    }
    ?>
 
    <button>Envoyer</button>

</form>

<?php include_once "endOfPage.php" ?>