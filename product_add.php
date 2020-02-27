<?php 
 require "connexion_bdd.php"; // page de connexion
 
 $db = connexionBase(); // Appel de la fonction de connexion
 ?>

<?php include_once "topOfPage.php" ?>

<div class="container-fluid">
<form action="products_details" method="$_POST">

            <div class="form-group">
            <label for=""></label>
            <input type="text" name="" id="" value="" class="form-control">
            
            </div>
            <div class="form-group">
            <label for=""></label>
            <input type="text" name="" id="" value="" class="form-control">
            
            </div>
            <div class="form-group">
            <label for=""></label>
            <input type="text" name="" id="" value="" class="form-control">
            
            </div>
            <div class="form-group">
            <label for=""></label>
            <input type="text" name="" id="" value="" class="form-control">
            
            </div><div class="form-group">
            <label for=""></label>
            <input type="text" name="" id="" value="" class="form-control">
            
            </div>
<button class="btn btn-secondary"><a href="product_liste.php">Retour</a></button>
<button class="btn btn-secondary"><a href="product_modif.php">Modifier</a></button>
</form>
</div>
<?php include_once "endOfPage.php" ?>