<?php 

require_once 'functions.php'; // Appel de la pages des fonctions

$categories = getCategories(); // Appel de la fonction getCategories dans une variable


// recupération des catégories pour alimenter les options de mon select
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
$pro_photo = $_FILES['pro_photo'] ?? '';
$isSubmit = isset($_POST['submit']) ? true : false;

//regex
$pro_ref_control = '/^\w{1,10}$/';//regex au moins un caractère au plus 10 caracrtères attachés
$pro_libelle_control = '/\w{1,200}/'; // regex jusqu'à 200 caractères
$pro_description_control = '/\w{0,1000}/'; 
$pro_prix_control = '/^\d{1,6}([.|,](\d{1,2}))?$/'; //Regex prix de six chiffres avant la virgule et deux chiffres après
$pro_stock_control = '/^\d{0,11}$/'; // regex 0 ou 11 chiffres
$pro_couleur_control = '/^[a-zA-Z]{0,30}$/' ; //regex uniquement des lettres au moins une jusqu'a 30 caractères 
// $pro_photo_control = '/^[a-zA-Z]{1,4}$/';

//declaration et initialisation du tableau d'erreurs
$errors=[]; 

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

if((isset($_FILES['pro_photo'])) && (($_FILES['pro_photo']['error'])>0))
{
   
    switch($_FILES['pro_photo']['error'])
    {
        case 1: $errors['pro_photo']= 'Aucun fichier téléchargé : La taille du fichier téléchargé excède la valeur maximale configurée dans php.ini'; break;
        case 2: $errors['pro_photo']= 'Aucun fichier téléchargé : Le fichier n\'a été que partiellement téléchargé.'; break;
        case 3: $errors['pro_photo']= 'Aucun fichier téléchargé : Aucun fichier n\'a été téléchargé.'; break;
        case 4: $errors['pro_photo']= 'Aucun fichier téléchargé : Un dossier temporaire est manquant.' ; break;
        case 5: $errors['pro_photo']= 'Aucun fichier téléchargé : Échec de l\'écriture du fichier sur le disque.'; break;
        case 6: $errors['pro_photo']= 'Aucun fichier téléchargé : Une extension PHP a arrêté l\'envoi de fichier.'; break;     
    }
}
// else { 'Aucune erreur, le téléchargement est correct.'} ;




//intégration du fichier image

// if (isset($_FILES['pro_photo'])) 
//             {
//                 // var_dump($_FILES['pro_photo']);
//                 $path_parts= pathinfo($_FILES['pro_photo']['name']);
//                 echo $path_parts['dirname'],"<br>";
//                 echo $path_parts['basename'], "<br>";
//                 echo $path_parts['extension'], "<br>";
//                 echo $path_parts['filename'], "<br>";

//                 $tmp = $_FILES['pro_photo']['tmp_name'];
//                 $photoName = $path_parts['filename'];
//                 $extension = $path_parts['extension'];
//                 $name = $_FILES['pro_photo']['name'];
//                 var_dump($name);
//                 $src = "asset/img/images/" ;
//                 $photoPath = $src.'name';
//                 var_dump($photoPath);
//                 move_uploaded_file($tmp, $photoPath);
//                 $allowedExtensions=['jpg', 'jpeg','png'];
//         //  if (in_array($extension, $allowedExtensions))
//         //         {
//         //         array_search($extension)

//             }

// Test soumission du formulaire et absence d'erreurs suite à la validation 

if($isSubmit && count($errors)==0) 
{
    $result = addProduct($pro_cat_id, $pro_ref, $pro_libelle, $pro_description, $pro_prix, $pro_stock, $pro_couleur, $pro_photo);
    if($result)
    {
        if (isset($_FILES['pro_photo'])) 
        {
            $path_parts= pathinfo($_FILES['pro_photo']['name']);
            $tmp = $_FILES['pro_photo']['tmp_name'];
            $extension = $path_parts['extension'];
            $name = $result .'.' . $extension;
            $src = "asset/img/images/" ;
            $photoPath = $src.$name ?? '';
            move_uploaded_file($tmp, $src.$name);
    
        // if (file_exists($photo)) {
        //     header('Content-Description: File Transfer');
        //     header('Content-Type: application/octet-stream');
        //     header('Content-Disposition: attachment; filename="'.basename($file).'"');
        //     header('Expires: 0');
        //     header('Cache-Control: must-revalidate');
        //     header('Pragma: public');
        //     header('Content-Length: '.filesize($photo));
        //     readfile($photo);
        //     exit;
        // }
    }
    // rename($photoPath, $src.$result. '.' . $extension);
    $success=true;
    $redirection = redirection();
    }
    $fail=true;
}



//debut du HTML
?>
<?php include_once "topOfPage.php"; // appel de la page topOfPage
if(isset($fail)) // condition si echec de l'enregistrement
{ 
    //ouverture d'une alerte d'information 
?>
<p class="alert alert-danger">Le produit n'a pas été modifié !</p> 
<?php 
    } 

     // début du formulaire
    ?>

<div class="container-fluid">
    <form action="product_add" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="pro_ref">Référence</label>
            <input type="text" name="pro_ref" id="pro_ref" value="<?=$pro_ref?>" 
            class="form-control  <?= ($isSubmit && isset($errors['pro_ref'])) ? 'is-invalid' : '';?> <?= ($isSubmit && (!isset($errors['pro_ref']))) ? 'is-valid' : '';?> ">
            <div class=" <?=(isset($errors['pro_ref'])) ? 'invalid-feedback' : ''?>"> <?=isset($errors['pro_ref']) ? $errors['pro_ref'] : '' ?></div>
        </div>
        <div class="form-group">
            <label for="pro_cat_id">Catégorie</label>
            <select name="pro_cat_id" id="pro_cat_id" class="form-control <?= ($isSubmit && isset($errors['pro_cat_id'])) ? 'is-invalid' : '';?> <?= ($isSubmit && (!isset($errors['pro_cat_id']))) ? 'is-valid' : '';?> ">
                <option value="" selected>Choisir une catégorie</option>
                <?php foreach($categories as $category) { ?>
                    <option value= "<?= $category->cat_id ?>" <?=($pro_cat_id == $category->cat_id) ? 'selected' : '' ?>> <?= $category->cat_nom ?>
                </option>
                <?php } ?>              
            </select>
            <div class=" <?=(isset($errors['pro_cat_id'])) ? 'invalid-feedback' : ''?>"> <?=(isset($errors['pro_cat_id'])) ? $errors['pro_cat_id'] : '' ?></div>
        </div>
        <div class="form-group">
            <label for="pro_libelle">Libellé</label>
            <input type="text" name="pro_libelle" id="pro_libelle" value="<?=$pro_libelle?>" class="form-control <?= ($isSubmit && isset($errors['pro_libelle'])) ? 'is-invalid' : '';?> <?= ($isSubmit && (!isset($errors['pro_libelle']))) ? 'is-valid' : '';?> ">
            <div class=" <?=(isset($errors['pro_libelle'])) ? 'invalid-feedback' : ''?>"> <?=(isset($errors['pro_libelle'])) ? $errors['pro_libelle'] : '' ?></div>
        </div>
        <div class="form-group">
            <label for="pro_description">Description</label>
            <input type="text" name="pro_description" id="pro_description" value="<?=$pro_description?>"
                class="form-control <?= ($isSubmit && isset($errors['pro_description'])) ? 'is-invalid' : '';?> ">
            <div class=" <?=(isset($errors['pro_description'])) ? 'invalid-feedback' : ''?>"> <?=(isset($errors['pro_description'])) ? $errors['pro_description'] : '' ?></div>
        </div>
        <div class="form-group">
            <label for="pro_prix">Prix</label>
            <input type="text" name="pro_prix" id="pro_prix" value="<?=$pro_prix?>" class="form-control <?= ($isSubmit && isset($errors['pro_prix'])) ? 'is-invalid' : '';?> <?= ($isSubmit && (!isset($errors['pro_prix']))) ? 'is-valid' : '';?> ">
            <div class=" <?=(isset($errors['pro_prix'])) ? 'invalid-feedback' : ''?>"> <?=(isset($errors['pro_prix'])) ? $errors['pro_prix'] : '' ?></div>
        </div>
        <div class="form-group">
            <label for="pro_stock">Stock</label>
            <input type="text" name="pro_stock" id="pro_stock" value="<?=$pro_stock?>" class="form-control <?= ($isSubmit && isset($errors['pro_stock'])) ? 'is-invalid' : '';?> <?= ($isSubmit && ($pro_stock!='0')) ? 'is-valid' : '';?> ">
            <div class=" <?=(isset($errors['pro_stock'])) ? 'invalid-feedback' : ''?>"> <?=(isset($errors['pro_stock'])) ? $errors['pro_stock'] : '' ?></div>
        </div>
        <div class="form-group">
            <label for="pro_couleur">Couleur</label>
            <input type="text" name="pro_couleur" id="pro_couleur" value="<?=$pro_couleur?>" class="form-control <?= ($isSubmit && isset($errors['pro_couleur'])) ? 'is-invalid' : '';?> ">
            <div class=" <?=(isset($errors['pro_couleur'])) ? 'invalid-feedback' : ''?>"> <?=(isset($errors['pro_couleur'])) ? $errors['pro_couleur'] : '' ?></div>
        </div>




        <div class="custom-file">
            <label for="pro_photo" class="custom-file-label">Photo</label>
            <input type="file" name="pro_photo" id="pro_photo" class="custom-file-input <?= ($isSubmit && isset($errors['pro_photo'])) ? 'is-invalid' : '';?> <?= ($isSubmit && (!isset($errors['pro_photo']))) ? 'is-valid' : '';?> " accept="image/png, image/jpeg">
            <div class="<?=($isSubmit && (!isset($extension))) ? 'invalid-feedback' : '' ?>"> <?=(isset($errors['pro_photo'])) ? $errors['pro_photo'] : '' ;?> </div>
        </div>
            <div class="<?= ($isSubmit && (isset($photoPath))) ? 'is-valid' : '';?>">    
            <img class="w-auto h-auto" src="<?= ($isSubmit && (isset($photoPath))) ? $photoPath : '' ?> " > </img>
            <span><?=($isSubmit && (isset($extension))) ? $extension : '' ?></span>
            </div> 



        <div class="form-check">
            <label for="pro_bloque" class="form-check-label">Produit bloqué : </label>
            <input type="checkbox" name="pro_bloque" class=" form-check-input" id="pro_bloque"
                value="1" <?=($pro_bloque ==1) ? 'checked': '' ?> data-toggle="toggle" data-on="Oui" data-off="Non" data-onstyle="secondary"
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