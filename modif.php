<?php 
 require "connexion_bdd.php"; // page de connexion
 
 $db = connexionBase(); // Appel de la fonction de connexion
 //récupération des données du formulaire si elles existent
/*pro_id = $_POST['pro_id'] ?? '';
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
$pro_d_modif = $_POST['pro_d_modif'] ?? '';
*/
//regex

$pro_id_control;
$pro_cat_id_control = '/^\d{2}$/';
$pro_ref_control ;
$pro_libelle_control ;
$pro_description_control = '/^\w+(([- ])(\w)*+([!.?,\(\)]*))*[?.!]?$/m';
$pro_prix_control = '/^\d{1,2}$/';
$pro_stock_control = '/^\d+$/';
$pro_couleur_control = '/^[a-z]{2,}((:?[- ][a-z]{2,})*)?$/' ;
$pro_photo_control =
$pro_d_ajout_control = '/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/';
$pro_d_modif_control = '/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/'; 
$pro_bloque_control ='/"Yes"|"No"/';

//requetes
$pro_ref = 'bar456';
$pro_cat_id = 13;
$pro_libelle = 'Zoom';
$pro_description = 'facilisis a';
$pro_prix = 49.80;
$pro_stock = 223;
$pro_couleur ='bleu';
$pro_photo = 'jpg' ;
$pro_d_ajout = '2018-08-13';
$pro_d_modif = NULL;
$pro_bloque = NULL;
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
    $success=true;
}
else
{
    echo 'le formulaire n\'est pas valide'; 
}; 
//(`pro_id`, `pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque`) VALUES (:pro_id, :pro_cat_id, :pro_ref, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_photo, :pro_d_ajout, :pro_d_modif, :pro_bloque)");
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
<form action="products_details" method="$_POST">
            <div class="form-group">
            <label for="pro_id">ID</label>
            <input type="text" name="pro_id" id="pro_id" value="" class="form-control" readonly>
            </div>
            <div class="form-group">
            <label for="pro_ref">Référence</label>
            <input type="text" name="pro_ref" id="pro_ref" value="" class="form-control">
            </div>
            <div class="form-group">
            <label for="pro_cat_id">Catégorie</label>
            <input type="text" name="pro_cat_id" id="pro_cat_id" value="" class="form-control">
            </div>
            <div class="form-group">
            <label for="pro_libelle">Libellé</label>
            <input type="text" name="pro_libelle" id="pro_libelle" value="" class="form-control">
            </div>
            <div class="form-group">
            <label for="pro_description">Description</label>
            <input type="text" name="pro_description" id="pro_description" value="" class="form-control">
            </div>
            <div class="form-group">
            <label for="pro_prix">Prix</label>
            <input type="text" name="pro_prix" id="pro_prix" value="" class="form-control">
            </div>
            <div class="form-group">
            <label for="pro_stock">Stock</label>
            <input type="text" name="pro_stock" id="pro_stock" value="" class="form-control">
            </div>
            <div class="form-group">
            <label for="pro_couleur">Couleur</label>
            <input type="text" name="pro_couleur" id="pro_couleur" value="" class="form-control">
            </div>
            <div class="form-group">
            <label for="pro_photo">Photo</label>
            <input type="text" name="pro_photo" id="pro_photo" value="" class="form-control">
            </div>
            <div class="form-check">
            <label for="pro_bloque" class="form-check-label">Produit bloqué : </label>
            <input type="checkbox" name="pro_bloque" class="custom-control-input" id="pro_bloque"
                            value="no" data-toggle="toggle" data-on="Oui" data-off="Non" data-onstyle="secondary" data-offstyle="default">
            </div>
            <div class="form-group">
            <input type="hidden" name="pro_d_ajout" id="pro_d_ajout" value="<?=date("Y-m-d")?>" class="form-control">
            </div>
            <div class="form-group">
            <input type="hidden" name="pro_d_modif" id="pro_d_modif" value="" class="form-control">
            </div>
<button class="btn btn-secondary"><a href="product_liste.php">Retour</a></button>
<button class="btn btn-secondary"><a href="product_modif.php">Enregistrer</a></button>
</form>
</div>
<?php include_once "endOfPage.php" ?>