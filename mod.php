<?php 
require 'functions.php';


 $db = connexionBase(); // Appel de la fonction de connexion
// if(!isset($_GET['pro_id'])){
//     header('Location:product_liste.php');
//     exit();
// }
$pro_id = $_GET['pro_id'];
$sql = "SELECT `pro_id`, `pro_ref`, `pro_cat_id`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_bloque`, `pro_d_ajout`, `pro_d_modif` FROM `produits` WHERE `pro_id`= :pro_id ";
$req = $db->prepare($sql);
$req->bindParam(':pro_id', $pro_id);
$req->execute();
$productDetails = $req->fetch(PDO::FETCH_ASSOC);
$libelleTable = ['ID', 'Référence', 'Catégorie', 'Libellé', 'Description', 'Prix', 'Stock', 'Couleur', 'Photo', 'Bloqué', 'Date d\'ajout', 'Date de modification'];
$table = (array_combine($libelleTable,$productDetails));
// var_dump($pro_id);
// var_dump($libelleTable);
//var_dump($productDetails);
// var_dump($table);



// $requete = $db->prepare("INSERT INTO `produits` (`pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque`) VALUES
// (:pro_cat_id, :pro_ref, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_photo, NOW(), :pro_d_modif, :pro_bloque)");
// // $requete->bindValue(':pro_id', $pro_id);
// // $requete->bindValue(':pro_cat_id', $pro_cat_id) ;
// // $requete->bindValue(':pro_ref', $pro_ref);
// // $requete->bindValue(':pro_libelle', $pro_libelle);
// // $requete->bindValue(':pro_description', $pro_description);
// // $requete->bindValue(':pro_prix', $pro_prix);
// // $requete->bindValue(':pro_stock', $pro_stock);
// // $requete->bindValue(':pro_couleur', $pro_couleur);
// // $requete->bindValue(':pro_photo', $pro_photo);
// // $requete->bindValue(':pro_d_ajout', $pro_d_ajout) ;
// // $requete->bindValue(':pro_d_modif', $pro_d_modif) ;
// // $requete->bindValue(':pro_bloque', $pro_bloque);
// if($requete->execute(array(
//     ':pro_cat_id'=> $pro_cat_id,
//     ':pro_ref' => $pro_ref,
//     ':pro_libelle' => $pro_libelle,
//     ':pro_description' => $pro_description,
//     ':pro_prix' => $pro_prix, 
//     ':pro_stock' => $pro_stock,
//     ':pro_couleur' => $pro_couleur,
//     ':pro_photo' => $pro_photo,
//     ':pro_d_modif' => $pro_d_modif,
//     ':pro_bloque' => $pro_bloque
// ))) 
// {
//     $succes=true;
// }
// else
// {
//     echo 'le formulaire n\'est pas valide'; 
// }; 


$categories = getCategories();//  require "connexion_bdd.php"; // page de connexion

$pro_ref = $_POST['pro_ref'] ?? '';
$pro_cat_id = $_POST['pro_cat_id'] ?? '';
$pro_libelle = $_POST['pro_libelle'] ?? '';
$pro_description = $_POST['pro_description'] ?? '';
$pro_prix = $_POST['pro_prix'] ?? '';
$pro_stock = $_POST['pro_stock'] ?? '0' ;
$pro_couleur = $_POST['pro_couleur'] ?? '';
$pro_photo = $_POST['pro_photo'] ?? '';
$pro_bloque = $_POST['pro_bloque'] ?? '';
$pro_d_ajout = $_POST['pro_d_ajout'] ?? '';
$isSubmit = isset($_POST['submit']) ? true : false;

//regex

$pro_ref_control = '/^\w{1,10}$/';//regex au moins un caractère au plus 10 caracrtères attachés
$pro_libelle_control = '/^\w{1,200}$/'; // regex jusqu'à 200 caractères
$pro_description_control = '/^\w{0,1000}$/'; 
$pro_prix_control = '/^\d{1,6}([.|,](\d{1,2}))?$/'; //Regex prix de six chiffres avant la virgule et deux chiffres après
$pro_stock_control = '/^\d{0,11}$/'; // regex 0 ou 11 chiffres
$pro_couleur_control = '/^[a-zA-Z]{0,30}$/' ; //regex uniquement des lettres au moins une jusqu'a 30 caractères 
$pro_photo_control = '/^[a-zA-Z]{1,4}$/';

$errors=[]; //declaration d'un tableau

if(!preg_match($pro_ref_control, $pro_ref)) //condition si : regex est faux 
{
    $errors['pro_ref']='La référence saisie n\'est pas valide'; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if($pro_cat_id==0)
{
    $errors['pro_cat_id'] = 'La catégorie n\'a pas été renseignée';
}
if(!preg_match($pro_libelle_control, $pro_libelle)) //condition si : regex est faux 
{
    $errors['pro_libelle']='Le libellé saisie n\'est pas valide'; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if((!preg_match($pro_prix_control, $pro_prix)) || $pro_prix == 0) //condition si : regex est faux 
{
    $errors['pro_prix'] = 'Le prix saisie n\'est pas valide' ; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if(!preg_match($pro_description_control, $pro_description)) //condition si : regex est faux 
{
    $errors['pro_description']='La description du produit est trop longue'; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if(!preg_match($pro_couleur_control, $pro_couleur)) //condition si : regex est faux 
{
    $errors['pro_couleur']='La couleur saisie n\'est pas valide'; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if(!preg_match($pro_stock_control, $pro_stock)) //condition si : regex est faux 
{
    $errors['pro_stock']='La valeur du stock doit être inférieur à 11 chiffres '; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if(addProduct($pro_cat_id, $pro_ref, $pro_libelle, $pro_description, $pro_prix, $pro_stock, $pro_couleur, $pro_photo))
{
    $success=true;
    $redirection = redirection();
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
        if ($key=='Date d\'ajout')
            {
            ?>
            <label for="<?php $key?>"><?php echo $libelle?> : </label>
            <?php
            echo $details;
            }
        if ($key=='Date de modification')
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
<button class="btn btn-secondary"><a href="product_add.php">Enregistrer</a></button>
</form>
</div>
<?php include_once "endOfPage.php" ?>