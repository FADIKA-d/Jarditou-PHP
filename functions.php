<?php
    require "connexion_bdd.php"; 
    // page de connexion
    function getCategories() 
    {
        // Appel de la fonction de connexion
        $db = connexionBase();
        $sql = "SELECT `cat_id`, `cat_nom` FROM `categories`";
        $req = $db->query($sql);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
    function productdetails($pro_id)
    {
    $db = connexionBase(); // Appel de la fonction de connexion
    $sql = "SELECT `pro_id`, `pro_ref`, `pro_cat_id`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_bloque`, `pro_d_ajout`, `pro_d_modif` FROM `produits` WHERE `pro_id`= :pro_id ";
    $req = $db->prepare($sql);
    $req->bindParam(':pro_id', $pro_id);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
    }
    // function productModif($pro_id, $pro_cat_id, $pro_ref, $pro_libelle, $pro_description, $pro_prix, $pro_stock, $pro_couleur, $pro_photo, $pro_bloque)
    // {
    //     $db = connexionBase(); // Appel de la fonction de connexion
    //     if (isset($_GET['pro_id'])) {$pro_id=$_GET['pro_id']; } else if (isset($_POST['for_modif'])) {$pro_id=$_POST['for_modif'];};
    //     $sql = "SELECT `pro_id`, `pro_ref`, `pro_cat_id`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_bloque`, `pro_d_ajout`, `pro_d_modif` FROM `produits` WHERE `pro_id`= :pro_id ";
    //     $req = $db->prepare($sql);
    //     $req->bindParam(':pro_id', $pro_id);
    //     $req->execute();
    //     return $req->fetch(PDO::FETCH_ASSOC);
    // }
    function products()
    {
        $db = connexionBase(); 
        $sql = "SELECT `pro_id`, `pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`, `pro_d_modif`, `pro_bloque` FROM `produits`";
        $req = $db->query($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_OBJ);
    }
    function addProduct($pro_cat_id, $pro_ref, $pro_libelle, $pro_description, $pro_prix, $pro_stock, $pro_couleur, $pro_photo)
    {
        $db = connexionBase();
        $sql = "INSERT INTO `produits` (`pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, 
        -- `pro_photo`, 
        `pro_d_ajout`) VALUES
        (:pro_cat_id, :pro_ref, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, 
        -- :pro_photo, 
        NOW())";
        $requete = $db->prepare($sql);
        $requete->bindValue(':pro_cat_id', $pro_cat_id) ;
        $requete->bindValue(':pro_ref', $pro_ref);
        $requete->bindValue(':pro_libelle', $pro_libelle);
        $requete->bindValue(':pro_description', $pro_description);
        $requete->bindValue(':pro_prix', $pro_prix);
        $requete->bindValue(':pro_stock', $pro_stock);
        $requete->bindValue(':pro_couleur', $pro_couleur);
        //$requete->bindValue(':pro_photo', $pro_photo);
        return $requete->execute();
    }
    function redirection() 
    {
        header("Location:product_liste.php");
        return;
    }

    function deleteProduct()
    {
        $db = connexionBase();
        $pro_id = $_GET['pro_id'] ?? '';
        $sqlDel = "DELETE FROM `produits` WHERE `pro_id`= :pro_id";
        $requete = $db->prepare($sqlDel);
        $requete->bindParam(':pro_id', $pro_id);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_OBJ);
    }

function uploads($photo, $name)
{
    $path_parts= pathinfo($photo['name']);
    $allowedExtensions=['jpg', 'jpeg','png'];
    $extension = $path_parts['extension'];
    $maxFileSize = 2;
    if (($photo['name']['size'] < $maxFileSize) && in_array($extension, $allowedExtensions))
    {
        // echo $path_parts['dirname'],"<br>";
        // echo $path_parts['basename'], "<br>";
        // echo $path_parts['extension'], "<br>";
        // echo $path_parts['filename'], "<br>";

        $tmp = $photo['tmp_name'];
        // $photoName = $path_parts['filename'];
        $src = 'asset/img/images/'. $name;
        if(move_uploaded_file($tmp, $src)){
            return $extension;
        }
        return false;
    }
}
  function updateProduct($pro_id, $pro_cat_id, $pro_ref, $pro_libelle, $pro_description, $pro_prix, $pro_stock, $pro_couleur, $pro_photo, $pro_bloque)
  {
    $db = connexionBase();
    $sql = ("UPDATE `produits` 
    SET `pro_cat_id`=:pro_cat_id,`pro_ref`=:pro_ref,`pro_libelle`=:pro_libelle,`pro_description`=:pro_description,`pro_prix`=:pro_prix,`pro_stock`=:pro_stock,`pro_couleur`=:pro_couleur,`pro_photo`=:pro_photo,`pro_bloque`=:pro_bloque 
    WHERE `pro_id`= :pro_id");
    $requete = $db->prepare($sql);
    $requete->bindParam(':pro_cat_id', $pro_cat_id);
    $requete->bindParam(':pro_ref', $pro_ref);
    $requete->bindParam(':pro_libelle', $pro_libelle);
    $requete->bindParam(':pro_description', $pro_description);
    $requete->bindParam(':pro_prix', $pro_prix);
    $requete->bindParam(':pro_stock', $pro_stock);
    $requete->bindParam(':pro_couleur', $pro_couleur);
    $requete->bindParam(':pro_photo', $pro_photo);
    $requete->bindParam(':pro_bloque', $pro_bloque);    
    $requete->bindParam(':pro_id', $pro_id);
    return $requete->execute(); 
  }