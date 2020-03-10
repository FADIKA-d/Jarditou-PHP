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
$libelleTable = ['ID', 'Référence', 'Catégorie', 'Libellé', 'Description', 'Prix', 'Stock', 'Couleur', 'Photo', 'Bloqué', 'Date d\'ajout', 'Date de modification']; // tableau reprenant les intitulés des colonnes de la base de données

include 'functions.php'; // appel de la page de fonctions

$products = products(); //fonction products

$pro_id = $_GET['pro_id']  ?? ''; // récupération de la valeur pro_id des elements de la colonne libellé

// $for_modif = $_POST['for_modif']  ?? ''; // récupération de la valeur for_modif du boutton modifier

// $productsID = array_column($products, 'pro_id');
// // var_dump($productsID);
// // $current= current($productsID);
// // var_dump($current);
// // var_dump(next($productsID));

$card_id = $_GET['card_id'] ?? ''; // récupération de la valeur card_id pour l'affichage de la carte
// var_dump($card_id);

$ids = $_GET['productsToDelete'] ?? ''; // récupération des valeurs pour la suppression des ids sélectionnés
if(isset($_GET['deleteAsk'])) // Si la valeur validé (du bouton validé de la fenetre modale) existe 
{
        if(diversDeleteProducts($ids)) // appel de la fonction diversDeleteProducts qui a pour argument les valeurs sélectionnées ($ids)
        {
            redirection(); // Si la fonction diversDeleteProducts a été executé la fonction redirection s'éxecute aussi
        } ; 
}

?>

    <?php include_once "topOfPage.php" ?> 
    <div class="container">   
    <div class="row justify-content-center">
          <div class="table mx-auto pt-5">
            <table class="table table-bordered table-hover border ">
            <form method="POST" action="product_liste.php" id="formD" class="col-12 col-lg-7" >
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
                        <th><i class="fas fa-trash-alt"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                foreach ($products as $product)
                {
                // $src = "asset/img/images/".$product->pro_id . '.' . $product->pro_photo;
                $src = "asset/img/images/".$product->pro_id;
                // var_dump($src);
                //  var_dump($products);
                // $current= current($products);
                // $productsDelete = $_GET['pro_id'] ?? '';
               
               
      if (isset($_POST['count_product_delete']))
      {
            if (isset($_POST['delete']))
                {
                    $productsToDelete= $_POST["delete"]; 
                   
                    $ids = implode( ' , ', $productsToDelete);
                } 
        } 
                
            
                               
                ?>
                    <tr> 
                        <td><a href="product_liste.php?card_id=<?=$product->pro_id?>" data-toggle="collapse" aria-expanded="false" aria-controls="product_card"></a>
                        <button class="btn btn-outline-secondary" type="button" data-toggle="collapse" data-target="#product_card" aria-expanded="false" aria-controls="product_card">
                            <img src="<?= $src ?>" alt="photo" class="dropright w-25 h-auto" ></img>
                        </button>
                        </td>
                        <!-- <td><a href="#product_card" data-toggle="dropright" aria-expanded="false" aria-controls="product_card" class="form-control" ><img src="<?= $src ?>" alt="photo" class="dropright w-25 h-auto" ></img></a></td> -->
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
                        <td><input type="checkbox" name="delete[<?=$product->pro_id?>]" value="<?=$product->pro_id?>"></td>
                     </tr>
                    <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                <td colspan="12"></td>
                <td><button class="btn btn-secondary" type="submit" name="count_product_delete" id="delete" value="valider">Valider </button> </td>
                <!-- <td><button type="button" form="formD" name="count_product_delete" value="Submit" class="btn btn-secondary" data-toggle="modal" data-target="#delete_modal">Valider</button></td> -->
            </tr>
                </tfoot>
                </form>
            </table>
            
            <form action="product_modif.php" method="POST" >
                <button name="modif" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modif_modal">Modifier</button>
                <button class="btn btn-secondary"><a href="product_add.php">Ajouter</a></button>
                <button type="button" role="button" class="btn btn-secondary" data-toggle="modal" data-target="#delete_modal">Supprimer</button>
            </form>
        </div>
    </div>



    <!-- DEBUT FENETRE MODAL MODIF -->
    <div class="modal fade" id="modif_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modif_liste_modal" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
        
            <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <form action="product_modif.php" method="POST">
            <div class="form-group">
                <label for="pro_id" class="col-form-label">Quel produit voulez-vous modifier ? (indiquez l'ID) </label>
                <input name="pro_id" id="pro_id" type="text" class="form-control" value="">
                <button type="submit" name="submit" class="btn btn-secondary" role="button">Valider</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
            </form>
            </div> 
        </div>
        </div>
        </div>
    <!-- FIN FENETRE MODAL MODIF -->

    <!-- FENETRE MODAL DELETE -->
    <div class="modal fade" id="delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="delete_products_modal" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" >
        
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-group">
                    <label for="productsToDelete" class="col-form-label">Voulez-vous vraiment supprimer : <?php foreach($productsToDelete as $value) { echo ' le produit '. $value. '; <br> '; } ?> </label>
                   
                    <!-- <label for="" class="col-form-label">Voulez-vous vraiment supprimer : 
                        <?php  
                            if (isset($_POST["delete"]))
                            {
                                foreach($_POST["delete"] as $value)
                                {
                                    echo $value;
                                }
                            }   
                                
                                ?> </label> -->
                </div>
                <button type="button" name="deleteAsk" class="btn btn-secondary" role="button"><a href="product_liste.php?productsToDelete=<?=$ids?>&amp;deleteAsk=true">Oui</a></button>
                <button type="button" name="" class="btn btn-secondary" data-dismiss="modal">Non</button>
                
            </div>
        </div>
    </div>
    </div>
    <!-- FIN FENETRE MODAL DELETE -->


    <!-- DEBUT CARD -->
        <div class="collapse fixed-top bg-secondary justify-content-center d-bloc w-50" id="product_card" >
            <div class="card w-50" >
                <?php
                 
                 $card_id=$_GET['card_id'] ?? '';
                 var_dump($card_id);
                 foreach ($products as $product)
                 {
                $src = "asset/img/images/".$card_id. '.' . $product->pro_photo;
                 if ($product->pro_id==$card_id) 
                 {
                 ?>
            <div class="row no-gutters ">
                <div class="col-md-4">
                    <img src="<?= $src ?>" alt="Photo" class="card-img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> <?php echo $libelleTable[0].' : '.$product->pro_id; ?> </li>
                        <li class="list-group-item"> <?php echo $libelleTable[1].' : '.$product->pro_ref; ?> </li>
                        <li class="list-group-item"> <?php echo $libelleTable[2].' : '.$product->pro_libelle; ?> </li>
                        <li class="list-group-item"> <?php echo $libelleTable[3].' : '.$product->pro_prix; ?> </li>
                        <li class="list-group-item"> <?php echo $libelleTable[4].' : '.$product->pro_stock; ?> </li>
                        <li class="list-group-item"> <?php echo $libelleTable[5].' : '.$product->pro_couleur; ?> </li>
                        <li class="list-group-item"> <?php echo $libelleTable[6].' : '.$product->pro_d_ajout; ?> </li>
                        <li class="list-group-item"> <?php echo $libelleTable[7].' : '.$product->pro_d_modif; ?> </li>
                        <li class="list-group-item"> <?php echo $libelleTable[8].' : '.$product->pro_bloque; ?> </li>
                    <?php
                    }
                    }
                    ?>
                    </ul>
                    </div>
                </div>
            </div>
            </div>
        <!-- FIN CARD -->
    </div>
    </div>
    <?php include_once "endOfPage.php" ?>