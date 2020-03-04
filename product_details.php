<?php 
 //require "connexion_bdd.php"; // page de connexion
 
if(!isset($_GET['pro_id'])){
    header('Location:product_liste.php');
    exit();
}
require 'functions.php';
$photo= photo();
$pro_id = $_GET['pro_id'];

$productDetails = productdetails($pro_id);
$libelleTable = ['ID', 'Référence', 'Catégorie', 'Libellé', 'Description', 'Prix', 'Stock', 'Couleur', 'Photo', 'Bloqué', 'Date d\'ajout', 'Date de modification'];
$table = (array_combine($libelleTable,$productDetails));


if (isset($_GET['delete'])) {$delete = deleteProduct();};
$del = $_GET['delete'] ?? '';

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
<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#product_delete">Supprimer</button>
<div class="modal fade" id="product_delete" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modal_delete_product" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
        
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-group">
                    <label for="" class="col-form-label">Voulez-vous vraiment supprimer le produit <?=$pro_id?> ?</label>
                    </div>
                    <button type="button" name="delete" class="btn btn-secondary" role="button"><a href="product_details.php?pro_id=<?=$pro_id?>">Oui</a></button>
                    <button type="button" name="" class="btn btn-secondary" data-dismiss="modal">Non</button>
                
            </div>
        </div>
    </div>
</div>
</form>
</div>
<?php include_once "endOfPage.php" ?>