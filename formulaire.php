<?php
$today = date("Y-m-d"); 

    function vide()
    {
        echo "La case doit être renseignée";
    }
    $error = vide();

    echo $lastName = $_POST["lastName"] ?? $error;
    echo $lastName;
    echo $firstName = $_POST["firstName"] ?? $error;
    $gender = $_POST["gender"] ?? $error;
    echo $dateOfBirth = $_POST["dateOfBirth"] ?? $error;
    echo $postalCode = $_POST["postalcode"] ?? $error;
    echo $adress = $_POST["adress"] ?? $error;
    echo $city = $_POST["city"] ?? $error;
    echo $email = $_POST["email"] ?? $error;
    echo $subject = $_POST["subject"] ?? $error;
    echo $question = $_POST["question"] ?? $error;
    echo $question = $_POST["agrement"] ?? $error;

$dateOfBirthTimestamp =strtotime($dateOfBirth); // Convertion de la date de naissance saissie en Timestamp (format de mesure de la date)
$dateOfBirthTable = getdate($dateOfBirthTimestamp); // Converstion du Timestamp en tableau
$yearOfBirth = $dateOfBirthTable["year"]; // Obtenir l'année de naissance
$todayTimestamp =strtotime($today); // Convertion de la date de naissance saissie en Timestamp (format de mesure de la date)
$dateOfTodayTable = getdate($todayTimestamp); // Converstion du Timestamp en tableau
$yearOfToday = $dateOfTodayTable["year"];
$majorityAge = 18; // Variable âge de la majorité
$deanOfHumanityAge = 122; //age du doyen de l'humanité
$adult = $yearOfToday-$majorityAge; //Variable âge d'une personne majeur
$age = $yearOfToday-$yearOfBirth; //Variable age

if($dateOfBirth>$today || $age>$deanOfHumanityAge) // Si l'année de naissance est antérieur à la date du jour et l'année de naissance est inférieur à l'année de naissance du doyen de l'humanité
{
    echo "erreur1 ";
}; 
if($age<$majorityAge)
{
    echo "Vous n'êtes pas majeur !"; 
};

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <?php include_once "topOfPage.php" ?>

    <p>* Ces zonez sont obligatoires</p>
    <form action="#" method="POST" id="formContact">
        <div class="container">
            <fieldset class="border border-dark row p-2">
                <legend>Vos coordonnées</legend>
                <div class="row col-8 col-md-12">
                    <label for="lastName" class="form-group col-md-6">Votre nom* :</label>
                    <input type="text" class="form-control col-md-6" id="lastName" name="lastName">
                </div>
                <div class="row col-8 col-md-12">
                    <label for="firstName" class="form-group col-md-6">Votre prénom* :</label>
                    <input type="text" class="form-control col-md-6" id="firstName" name="firstName">
                    </div>
                    <div class="row col-8 col-md-12">
                        <label for="gender" class="form-group col-md-6">Sexe* :</label>
                        <div class="form-check form-check-inline row col-md-6 d-flex justify-content-around">
                        <input type="radio" name="gender" id="gender" value="woman" class="form-check-input col-md-2">
                        <label for="femme" class="form-check-label col-md-3">Féminin</label>
                        <input type="radio" name="gender" id="gender" value="man" class="form-check-input col-md-2">
                        <label for="homme" class="form-check-label col-md-3">Masculin</label>
                        </div>
                    </div>
                <div class="row col-8 col-md-12">
                    <label for="dateOfBirth" class="form-group col-md-6">Date de naissance* :</label>
                    <input class="form-control col-md-6" name="dateOfBirth" type="date" id="dateOfBirth">
                </div>
                <div class="row col-8 col-md-12">
                    <label for="postalcode" class="form-group col-md-6">Code postale :</label>
                    <input type="text" name="postalcode" class="form-control col-md-6" id="postalcode">
                </div>
                <div class="row col-8 col-md-12">
                    <label for="adress" class="form-group col-md-6">Adresse :</label>
                    <input type="text" name="adress" class="form-control col-md-6" id="adress">
                </div>
                <div class="row col-8 col-md-12">
                    <label for="city" class="form-group col-md-6">Ville :</label>
                    <input type="text" name="city" class="form-control col-md-6" id="city">
                </div>
                <div class="row col-8 col-md-12">
                    <label for="email" class="form-group col-md-6">Email* :</label>
                    <div class="input-group col-md-6 pl-0 pr-0">
                        <div class="input-group-prepend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="text" name="email" id="email" class="form-control h-100" placeholder="dave.loper@afpa.fr">
                    </div>
                </div>
            </fieldset>
            <fieldset class="border border-dark row p-2">
                <legend>Votre demande</legend>
                <div class="row col-8 col-md-12">
                    <label for="subject" class="form-group col-md-6">Sujet* :</label>
                    <select name="subject" class="custom-select col-md-6 btn btn-outline-secondary" id="subject">
                        <option value="order">Mes commandes</option>
                        <option value="question">Question sur les produits</option>
                        <option value="claim">Réclamation</option>
                        <option value="other">Autres</option>
                    </select>
                </div>
                <div class="row col-8 col-md-12">
                    <label for="question" class="form-group col-md-6">Votre question* :</label>
                    <textarea name="question" id="question" class="col-md-6"></textarea>
                </div>
            </fieldset>
            <div class="custom-control custom-switch p-3">
                <input type="checkbox" name="agrement" class="custom-control-input" id="agrement" value="agree"></input>
                <label for="agrement" class="custom-control-label">J'accepte le traitement informatique de ce formulaire.</label>
            </div>
            <div class="row col-12 d-flex justify-content-between p-0 m-0">
            <button type="submit" class="btn btn-outline-secondary col-md-5">Envoyer</button>
            <button type="reset" class="btn btn-outline-danger col-md-5">Annuler</button>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>