<?php 

require_once 'functions.php';

$categories = getCategories();

$pro_ref = $_POST['pro_ref'] ?? '';
$pro_cat_id = $_POST['pro_cat_id'] ?? '';
$pro_libelle = $_POST['pro_libelle'] ?? '';
$pro_description = $_POST['pro_description'] ?? '';
$pro_prix = $_POST['pro_prix'] ?? '';
$pro_stock = $_POST['pro_stock'] ?? '';
$pro_couleur = $_POST['pro_couleur'] ?? '';
$pro_photo = $_POST['pro_photo'] ?? '';
$pro_bloque = $_POST['pro_bloque'] ?? '';
$pro_d_ajout = $_POST['pro_d_ajout'] ?? '';


//regex

$pro_ref_control = '/^\w{1,10}$/';//regex au moins un caractère au plus 10 caracrtères attachés
$pro_libelle_control = '/^\w{1,200}$/'; // regex jusqu'à 200 caractères
$pro_description_control = '/^\w{0,1000}$/'; 
$pro_prix_control = '/^\d{1,6}([.|,](\d{1,2}))?$/'; //Regex prix de six chiffres avant la virgule et deux chiffres après
$pro_stock_control = '/^\d{0,11}$/'; // regex 1 ou 11 chiffres
$pro_couleur_control = '/^[a-zA-Z]{1,30}$/' ; //regex uniquement des lettres au moins une jusqu'a 30 caractères 
$pro_photo_control = '/^[a-zA-Z]{1,4}$/';

$errors=[]; //declaration d'un tableau

if(!preg_match($pro_ref_control, $pro_ref)) //condition si : regex est faux 
{
    $errors['pro_ref']='La référence saisie n\'est pas valide'; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if(!preg_match($pro_libelle_control, $pro_libelle)) //condition si : regex est faux 
{
    $errors['pro_libelle']='Le libellé saisie n\'est pas valide'; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if(!preg_match($pro_prix_control, $pro_prix)) //condition si : regex est faux 
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

if(addProduct($pro_cat_id, $pro_ref, $pro_libelle, $pro_description, $pro_prix, $pro_stock, $pro_couleur, $pro_photo))
{
    $success=true;
}
else
{
    echo 'le formulaire n\'est pas valide'; 
}; 

?>
<?php include_once "topOfPage.php" ?>
<?php
    if(isset($success)) 
    { 
    ?>
<p class="alert alert-success">Le produit a été ajouté!</p>
<?php 
    } 
    ?>

<div class="container-fluid">
    <form action="product_add" method="POST">
        <div class="form-group">
            <label for="pro_ref">Référence</label>
            <input type="text" name="pro_ref" id="pro_ref" value="<?=$pro_ref?>" size="1" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_cat_id">Catégorie</label>
            <select name="pro_cat_id" id="pro_cat_id" class="form-control">
                <option value="" selected>Choisir une catégorie</option>
                <?php foreach($categories as $category) { ?>
                    <option value="<?= $category->cat_id ?>" <?= ($pro_cat_id == $category->cat_id) ? 'selected' : '' ?>><?= $category->cat_nom ?></option>
                <?php } ?>              
            </select>
        </div>
        <div class="form-group">
            <label for="pro_libelle">Libellé</label>
            <input type="text" name="pro_libelle" id="pro_libelle" value="<?=$pro_libelle?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_description">Description</label>
            <input type="text" name="pro_description" id="pro_description" value="<?=$pro_description?>"
                class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_prix">Prix</label>
            <input type="text" name="pro_prix" id="pro_prix" value="<?=$pro_prix?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_stock">Stock</label>
            <input type="text" name="pro_stock" id="pro_stock" value="<?=$pro_stock?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_couleur">Couleur</label>
            <input type="text" name="pro_couleur" id="pro_couleur" value="<?=$pro_couleur?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="pro_photo">Photo</label>
            <input type="text" name="pro_photo" id="pro_photo" value="<?=$pro_photo?>" class="form-control">
        </div>
        <div class="form-check">
            <label for="pro_bloque" class="form-check-label">Produit bloqué : </label>
            <input type="checkbox" name="pro_bloque" class=" custom-control-input" id="pro_bloque"
                value="no" <?=($pro_bloque =='yes') ? 'selected' : '' ?> data-toggle="toggle" data-on="Oui" data-off="Non" data-onstyle="secondary"
                data-offstyle="default">
        </div>
        <div class="form-group">
            <input type="hidden" name="pro_d_ajout" id="pro_d_ajout" value="<?=date("Y-m-d")?>" class="form-control">
        </div>
        <button class="btn btn-secondary"><a href="product_liste.php">Retour</a></button>
        <button type="submit" name="submit" class="btn btn-secondary">Enregistrer</button>
    </form>
</div>
<?php include_once "endOfPage.php" ?>