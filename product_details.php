<?php 
 require "connexion_bdd.php"; // page de connexion
 
 $db = connexionBase(); // Appel de la fonction de connexion
if(!isset($_GET['pro_id'])){
    header('Location:product_liste.php');
    exit();
}
$pro_id = $_GET['pro_id'];
 $sql = "SELECT `pro_id`, `pro_ref`, `pro_cat_id`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_bloque`, `pro_d_ajout`, `pro_d_modif` FROM `produits` WHERE `pro_id`= :pro_id";
$req = $db->prepare($sql);
$req->bindValue(":pro_id", $pro_id);
$req->execute();
$productDetails = $req->fetch(PDO::FETCH_ASSOC);

$libelleTable = ['ID', 'Référence', 'Catégorie', 'Libellé', 'Description', 'Prix', 'Stock', 'Couleur', 'Photo', 'Bloqué', 'Date d\'ajout', 'Date de modification'];
$table = (array_combine($libelleTable,$productDetails));


?>
<?php include_once "topOfPage.php" ?>
<div class="container-fluid">
<form action="product_details.php" method="POST">
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
            <input type="text" name="<?php $key?>" id="<?php $key?>" value=" <?php echo $details?>" class="form-control" readonly></div>
            <?php
             }
    ?>
    </div>
    <?php
    }
    ?>
<button class="btn btn-secondary"><a href="product_liste.php">Retour</a></button>
<button class="btn btn-secondary"><a href="product_modif.php?pro_id=<?= $table['ID']?>">Modifier</a></button>
<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#product_delete"><a href="product_modif.php?pro_id=<?= $table['ID']?>">Supprimer</a></button>
<div class="modal fade" id="product_delete" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_delete_product" aria-hidden="true" >
<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
        
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <div class="form-group">
                <label for="" class="col-form-label">Voulez-vous vraiment supprimer le produit ?</label>
                <input name="" id="" type="text" class="form-control" value="">
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" name="" class="btn btn-secondary" role="button"><a href="product_details.php?del_pro=<?=?>">Oui</a></button>
            <button type="button" name="" class="btn btn-secondary" data-dismiss="modal">Non</button>
            </div>
        </div>
</div>
</div>
</form>
</div>
<?php include_once "endOfPage.php" ?>