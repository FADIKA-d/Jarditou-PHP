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
    function productdetails()
    {
    $db = connexionBase(); // Appel de la fonction de connexion

    $pro_id = $_GET['pro_id'] ?? '';
    $sql = "SELECT `pro_id`, `pro_ref`, `pro_cat_id`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_bloque`, `pro_d_ajout`, `pro_d_modif` FROM `produits` WHERE `pro_id`= :pro_id ";
    $req = $db->prepare($sql);
    $req->bindParam(':pro_id', $pro_id);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
    }
    function productModif()
    {
        $db = connexionBase(); // Appel de la fonction de connexion
        if (isset($_GET['pro_id'])) {$pro_id=$_GET['pro_id']; } else if (isset($_POST['for_modif'])) {$pro_id=$_POST['for_modif'];};
        $sql = "SELECT `pro_id`, `pro_ref`, `pro_cat_id`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_bloque`, `pro_d_ajout`, `pro_d_modif` FROM `produits` WHERE `pro_id`= :pro_id ";
        $req = $db->prepare($sql);
        $req->bindParam(':pro_id', $pro_id);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
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
    function uploads()
    {

    }
  function photo ()
  {
    if (isset($_FILES['pro_photo'])) 
            {
                // var_dump($_FILES['pro_photo']);
                $path_parts= pathinfo($_FILES['pro_photo']['name']);
                // echo $path_parts['dirname'],"<br>";
                // echo $path_parts['basename'], "<br>";
                // echo $path_parts['extension'], "<br>";
                // echo $path_parts['filename'], "<br>";

                $tmp = $_FILES['pro_photo']['tmp_name'];
                // $photoName = $path_parts['filename'];
                // $extension = $path_parts['extension'];
                $name = $_FILES['pro_photo']['name'];
                $src = "asset/img/images/" ;
                $photoPath = $src.$name;
                var_dump($photoPath);
                move_uploaded_file($tmp, $photoPath);
            }
    return; 
  }
  function update()
  {
      $db = connexionBase();
      $sql = ("UPDATE `produits` 
      SET `pro_cat_id`=:pro_cat_id,`pro_ref`=:pro_ref,`pro_libelle`=:pro_libelle,`pro_description`=:pro_description,`pro_prix`=:pro_prix,`pro_stock`=:pro_stock,`pro_couleur`=:pro_couleur,`pro_photo`=:pro_photo,`pro_bloque`=:pro_bloque 
      WHERE `pro_id`= :pro_id");
    $requete = $db->prepare($sql);
    $requete->bindParam(':pro_cat_id', $pro_cat_id) ;
    $requete->bindParam(':pro_ref', $pro_ref);
    $requete->bindParam(':pro_libelle', $pro_libelle);
    $requete->bindParam(':pro_description', $pro_description);
    $requete->bindParam(':pro_prix', $pro_prix);
    $requete->bindParam(':pro_stock', $pro_stock);
    $requete->bindParam(':pro_couleur', $pro_couleur);
    $requete->bindParam(':pro_photo', $pro_photo);
    $requete->bindParam(':pro_bloque', $pro_bloque);
    
    return $requete->fetchAll(PDO::FETCH_OBJ);
  }