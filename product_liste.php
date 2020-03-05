<?php 
// require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
 
// $db = connexionBase(); // Appel de la fonction de connexion
//  //Debut de la requete produit
// //  $requete = "SELECT * FROM produits WHERE pro_id";
// // $resultProduct = $db->query($requete);
// // $produit = $resultProduct->fetch(PDO::FETCH_OBJ); // Renvoi de l'enregistrement sous forme d'un objet
// // $tableau = [];
// // $produit = "SELECT produits "
// $sql = "SELECT `pro_id`, `pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque` FROM `produits`";
// $req = $db->query($sql);
// $products = $req->fetchAll(PDO::FETCH_OBJ);

include 'functions.php'; 
$products = products();
$pro_id = $_GET['pro_id']  ?? '';
$productDetails = productdetails($pro_id);
$for_modif = $_POST['for_modif']  ?? '';

?>

    <?php include_once "topOfPage.php" ?>
    <div class="container">   
        
        <div class="table-responsive mx-auto pt-5">
            <table class="table table-bordered table-striped table-hover border ">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Libellé</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Couleur</th>
                        <th>Ajout</th>
                        <th>Modif</th>
                        <th>Bloqué</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                foreach ($products as $product){
                $src = "asset/img/images/".$product->pro_id ;
                // var_dump($src);
                // var_dump($product->pro_id);
                ?>
                    <tr>
                        <td><img src="<?=$src?>" alt="photo" class="form-control w-25 h-auto"></img></td>
                        <td><?php echo $product->pro_id; ?></td>
                        <td><?php echo $product->pro_ref; ?></td>
                        <td><a href="product_details.php?pro_id=<?= $product->pro_id ?>"><?php echo  $product->pro_libelle; ?></a></td>
                        <td><?php echo $product->pro_prix; ?></td>
                        <td><?php echo $product->pro_stock; ?></td>
                        <td><?php echo $product->pro_couleur; ?></td>
                        <td><?php echo $product->pro_d_ajout; ?></td>
                        <td><?php echo $product->pro_d_modif; ?></td>
                        <td><?php echo $product->pro_bloque; ?></td>
                        <td><a href="product_details.php?pro_id=<?= $product->pro_id ?>"><i class="fas fa-info-circle fa-2x"></i></a></td>
                        <td><a href="product_modif.php?pro_id=<?= $product->pro_id ?>"><i class="fas fa-edit fa-2x"></i></a></td>

                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <form action="product_modif.php" method="POST">
                <button name="modif" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modif_modal">Modifier</button>
                <button class="btn btn-secondary"><a href="product_add.php">Ajouter</a></button>
            </form>
        </div>
    </div>
    <!-- FENETRE MODAL -->
    <div class="modal fade" id="modif_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modif_modal_liste" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
        
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <form action="product_liste.php" method="POST">
            <div class="form-group">
                <label for="for_modif" class="col-form-label">Quel produit voulez-vous modifier ? (indiquez l'ID) </label>
                <input name="for_modif" id="for_modif" type="text" class="form-control" value="">
                <button type="submit" name="submit" class="btn btn-secondary" role="button"><a href="product_modif.php?pro_id=<?=$_POST['for_modif']?>">Valider</a></button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
            </form>
            </div>
        </div>
        </div>
        </div>
    <?php include_once "endOfPage.php" ?>