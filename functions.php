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

    function addProduct($pro_cat_id, $pro_ref, $pro_libelle, $pro_description, $pro_prix, $pro_stock, $pro_couleur, $pro_photo)
    {
        $db = connexionBase();
        $sql = "INSERT INTO `produits` (`pro_cat_id`, `pro_ref`, `pro_libelle`, `pro_description`, `pro_prix`, `pro_stock`, `pro_couleur`, `pro_photo`, `pro_d_ajout`) VALUES
        (:pro_cat_id, :pro_ref, :pro_libelle, :pro_description, :pro_prix, :pro_stock, :pro_couleur, :pro_photo, NOW())";
        $requete = $db->prepare($sql);
        $requete->bindValue(':pro_cat_id', $pro_cat_id) ;
        $requete->bindValue(':pro_ref', $pro_ref);
        $requete->bindValue(':pro_libelle', $pro_libelle);
        $requete->bindValue(':pro_description', $pro_description);
        $requete->bindValue(':pro_prix', $pro_prix);
        $requete->bindValue(':pro_stock', $pro_stock);
        $requete->bindValue(':pro_couleur', $pro_couleur);
        $requete->bindValue(':pro_photo', $pro_photo);
        return $requete->execute();
    };
