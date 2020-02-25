<?php 
 require "connexion_bdd.php"; // Inclusion de notre bibliothèque de fonctions
 
 $db = connexionBase(); // Appel de la fonction de connexion
 //Debut de la requete produit
 $requete = "SELECT * FROM produits WHERE pro_id";
$resultProduct = $db->query($requete);
$produit = $resultProduct->fetch(PDO::FETCH_OBJ); // Renvoi de l'enregistrement sous forme d'un objet

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produit</title>
        <link rel="stylesheet" href="asset/css/style.css">
        <link
            href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/litera/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-pLgJ8jZ4aoPja/9zBSujjzs7QbkTKvKw1+zfKuumQF9U+TH3xv09UUsRI52fS+A6"
            crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link
            href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css"
            rel="stylesheet">

    </head>
    <body>
        <?php include_once "topOfPage.php" ?>
        <table class="table tabletable-bordered table-hover table-responsive border"></table>
        <thead>
            <tr class="table-primary">
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
            <tr>

                <td><?=(isset($produit)) ? $produit->pro_libelle : '' ?></td>
            </tr>
        </tbody>
    </table>

    <script
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>