<?php 
 require "connexion_bdd.php"; // page de connexion
 
 $db = connexionBase(); // Appel de la fonction de connexion
if(!isset($_GET['pro_id'])){
    header('Location:product_liste.php');
    exit();
}
$pro_id = $_GET['pro_id'];
$sql = "SELECT `pro_id`, `pro_ref`, `pro_cat_id`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_bloque`, `pro_d_ajout`, `pro_d_modif` FROM `produits` WHERE `pro_id`= :pro_id AND ISNULL(pro_bloque)";
$req = $db->prepare($sql);
$req->bindValue(":pro_id", $pro_id);
$req->execute();
$productDetails = $req->fetch(PDO::FETCH_ASSOC);
$libelleTable = ['ID', 'Référence', 'Catégorie', 'Libellé', 'Description', 'Prix', 'Stock', 'Couleur', 'Photo', 'Bloqué', 'Date d\'ajout', 'Date de modification'];
$table = (array_combine($libelleTable,$productDetails));


$requete = $db->prepare("INSERT INTO `produits` (`pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque`) VALUES
(:pro_cat_id, :pro_ref, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_photo, NOW(), :pro_d_modif, :pro_bloque)");
// $requete->bindValue(':pro_id', $pro_id);
// $requete->bindValue(':pro_cat_id', $pro_cat_id) ;
// $requete->bindValue(':pro_ref', $pro_ref);
// $requete->bindValue(':pro_libelle', $pro_libelle);
// $requete->bindValue(':pro_description', $pro_description);
// $requete->bindValue(':pro_prix', $pro_prix);
// $requete->bindValue(':pro_stock', $pro_stock);
// $requete->bindValue(':pro_couleur', $pro_couleur);
// $requete->bindValue(':pro_photo', $pro_photo);
// $requete->bindValue(':pro_d_ajout', $pro_d_ajout) ;
// $requete->bindValue(':pro_d_modif', $pro_d_modif) ;
// $requete->bindValue(':pro_bloque', $pro_bloque);
if($requete->execute(array(
    ':pro_cat_id'=> $pro_cat_id,
    ':pro_ref' => $pro_ref,
    ':pro_libelle' => $pro_libelle,
    ':pro_description' => $pro_description,
    ':pro_prix' => $pro_prix, 
    ':pro_stock' => $pro_stock,
    ':pro_couleur' => $pro_couleur,
    ':pro_photo' => $pro_photo,
    ':pro_d_modif' => $pro_d_modif,
    ':pro_bloque' => $pro_bloque
))) 
{
    $succes=true;
}
else
{
    echo 'le formulaire n\'est pas valide'; 
}; 


?>
<?php include_once "topOfPage.php" ?>
<div class="container-fluid">
<form action="products_details" method="$_POST">
    <?php

    foreach ($table as $key => $details)
    {
        $libelle = array_search($details, $table);
        ?>
    <div>
    <?php
        if ($key=='Bloqué')
        { 
        ?>
        <label for="<?php $key?>">Produit bloqué : </label>
        <input type="radio" name="bloque" value="Yes">
        <label for="<?php $key?>">Oui</label>
        <input type="radio" name="bloque" value="No" checked>
        <label for="<?php $key?>">Non</label>
        <?php
        }
        else if ($key=='Date d\'ajout')
            {
            ?>
            <label for="<?php $key?>"><?php echo $libelle?> : </label>
            <?php
            echo $details;
            }
        else if ($key=='Date de modification')
            {
                if(empty($details)){$key = next($table);}
                else {
            ?>
            <label for="<?php $key?>"><?php echo $libelle?> :</label>
            <?php
            echo $details;
            }}
        else
            {
              
            ?>
            <div class="form-group"><label for="<?php $key?>"><?php echo $libelle?></label>
            <input type="text" name="<?php $key?>" id="<?php $key?>" value=" <?php echo $details?>" class="form-control"></div>
            <?php
             }
    ?>
    </div>
    <?php
    }
    ?>
<button class="btn btn-secondary"><a href="product_liste.php">Retour</a></button>
<button class="btn btn-secondary"><a href="product_add.php">Modifier</a></button>
</form>
</div>
<?php include_once "endOfPage.php" ?>