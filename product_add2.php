<?php 
$host="localhost"; 
$login= "root";  // loggin d'accès au serveur de BDD 
$password="";    // pour s'identifier auprès du serveur
$base = "jarditou";

try 
{
   $db= new PDO('mysql:host='.$host.':3308;charset=utf8;dbname='.$base, $login, $password);
   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} 
catch (PDOException $e) 
{
    echo 'Erreur : ' . $e->getMessage() . '<br>';
    echo 'N° : ' . $e->getCode() . '<br>';
    die('Connexion au serveur impossible.');
}   
$libelleTable = ['ID', 'Référence', 'Catégorie', 'Libellé', 'Description', 'Prix', 'Stock', 'Couleur', 'Photo', 'Bloqué', 'Date d\'ajout', 'Date de modification'];
$reqlect = ['pro_id', 'pro_ref', 'pro_cat_id', 'pro_libelle', 'pro_description', 'pro_prix', 'pro_stock', 'pro_couleur', 'pro_photo']; 
$requete = $db->prepare("INSERT INTO `produits` (`pro_id`, `pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque`) VALUES (51, 25, 'barb145', 'Aramis ', '', '110.00', 2, :test, '', '2020-04-18', NULL, NULL)");
$requete->bindValue(':test', $test);
$requete->execute(array(':pro_id' => 10));
$ici=$requete->fetchAll();
array(
    `pro_id` => $pro_id,
    `pro_cat_id`=> $pro_cat_id,
    `pro_ref` => $pro_ref,
    `pro_libelle` => $pro_libelle,
    `pro_description` => $pro_description,
    `pro_prix` => $pro_prix,
    `pro_stock` => $pro_stock,
    `pro_couleur` => $pro_couleur,
    `pro_photo` => $pro_photo,
    `pro_d_ajout` => $pro_d_ajout,
    `pro_d_modif` => $pro_d_modif,
    `pro_bloque` => $pro_bloque
)

?>
<?php include_once "topOfPage.php" ?>
<?php
if(isset($success)) { ?>
    <p class="alert alert-success">L'altitude a été ajoutée !</p>
    <?php } ?>


<div class="container-fluid">
    <form action="#" method="POST">
    <?php
    foreach ($libelleTable as $details)
    {
        $libelle = array_search($details, $libelleTable);
        ?>
    <div>
    <?php
        if ($details=='Bloqué'){
            ?><input type="text" name="a" id="" value="" class="form-control">
            <?php            
            }
        else if ($details=='Date de modification' || $details=='Date d\'ajout'){}
        else
            { 
            ?>
            <div class="form-group">
            <label for=""><?php echo $details?></label>
            <input type="text" name="<?=$details?>" id="" value="" class="form-control">
            
            </div>
            <?php
            $newProduct [] = $details ;
         
             }
            ?>
    </div>
    <?php
    }
    ?>
<button class="btn btn-secondary"><a href="product_liste.php">Retour</a></button>
<button type="submit" class="btn btn-secondary">Enregistrer</button>
</form>
</div>
<?php 
foreach ($newProduct as $values) //boucle pour recupérer les valeurs du formulaire
{
    $newProductValues[] = $_POST[$values]; //recupération des valeurs du formulaire dans un tableau
}

$table = (array_combine($reqlect,$newProductValues)); // Création d'un nouveau tableau combiné avec les nouvelles valeurs 
//var_dump($newProduct);
//var_dump($newProductValues);
//var_dump($reqlect);
//var_dump($table);

//Début de la requete
$test=5;
$requete = $db->prepare("INSERT INTO `produits` (`pro_ref`) VALUES (:test)");
$requete->bindValue(":test", $test);
if($requete->execute()){
    $success = true;
}



/*foreach ($table as $key => $info)
{
$requete = $db->prepare("INSERT INTO produits ($key) VALUES (:$info)");
$requete->bindValue(":$info", $info);
if($requete->execute()){
    $success = true;
}
}
*/
?>
<?php include_once "endOfPage.php" ?>