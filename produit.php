<?php 
 require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
 
 $db = connexionBase(); // Appel de la fonction de connexion
 //Debut de la requete produit
//  $requete = "SELECT * FROM produits WHERE pro_id";
// $resultProduct = $db->query($requete);
// $produit = $resultProduct->fetch(PDO::FETCH_OBJ); // Renvoi de l'enregistrement sous forme d'un objet
// $tableau = [];
// $produit = "SELECT produits "
$sql = "SELECT `pro_id`, `pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque` FROM `produits`";
$req = $db->query($sql);
$products = $req->fetchAll(PDO::FETCH_OBJ);
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                foreach ($products as $product){
                ?>
                    <tr>
                        <td><?php echo $product->pro_photo; ?></td>
                        <td><?php echo $product->pro_id; ?></td>
                        <td><?php echo $product->pro_ref; ?></td>
                        <td><a href="products_details.php?pro_id=<?= $product->pro_id ?>"><?php echo  $product->pro_libelle; ?></a></td>
                        <td><?php echo $product->pro_prix; ?></td>
                        <td><?php echo $product->pro_stock; ?></td>
                        <td><?php echo $product->pro_couleur; ?></td>
                        <td><?php echo $product->pro_d_ajout; ?></td>
                        <td><?php echo $product->pro_d_modif; ?></td>
                        <td><?php echo $product->pro_bloque; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include_once "endOfPage.php" ?>