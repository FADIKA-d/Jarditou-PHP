<?php
$today = date("Y-m-d"); 

    // function vide()
    // {
    //     echo "La case doit être renseignée";
    // }
    // $error = vide();
    
    $lastName = $_POST['lastName'] ?? '';
    //$lastName ?? $error
    $firstName = $_POST['firstName'] ?? '';
    //$firstName ?? $error
    $gender = $_POST['gender'] ?? '';
    //$gender ?? $error
    $dateOfBirth = $_POST["dateOfBirth"] ?? '';
    //$dateOfBirth ?? $error
    $zipCode = $_POST['zipCode'] ?? '';
    //$zipCode ?? $error
    $adress = $_POST['adress'] ?? '';
    //$adress ?? $error
    $city = $_POST['city'] ?? '';
    //$city ?? $error
    $email = $_POST["email"] ?? '';
    //$email ?? $error
    $subject = $_POST["subject"] ?? '';
    //$subject ?? $error
    $question = $_POST["question"] ?? '';
    //$question ?? $error
    $agrement = $_POST["agrement"] ?? '';
    $isSubmit = isset($_POST['submit']) ? true : false;
    //echo $submit = $_POST["submit"];
    //echo $reset = $_POST["reset"];

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

$lettersControl = '/^[a-z]{2,}((:?[- ][a-z]{2,})*)?$/' ;
$genderControl ='/"femal"|"male"/';
$zipCodeControl = '/^\d{5}$/';
$adressControl='/^\d+\s+(bis|ter|quarter)?\s+[a-z]+\s(.)+$/';
$cityControl ='/^\w+(([- ])\w+)*$/';
$questionControl = '/^\w+(([- ])(\w)*+([!.?,\(\)]*))*[?.!]?$/m';
$emailControl = filter_var($email,FILTER_SANITIZE_EMAIL);
$dateOfBirthControl = '/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/';
$year = preg_replace('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', '$1', '1986-12-07');

$errors = [];
if(!preg_match($lettersControl, $lastName))
{
    $errors['lastName'] = 'Le nom est incorrect';
}
if(!preg_match($lettersControl, $firstName)){$errors['firstName'] = 'Le prénom est incorrect';}
if($gender!=='female' && $gender!=='male'){$errors['gender'] = 'Veuillez renseigner une catégorie';}
if(!preg_match($dateOfBirthControl,$dateOfBirth)){$errors['dateOfBirth'] = 'La date est incorrect';}
if(!preg_match($zipCodeControl, $zipCode)){$errors['zipCode'] = 'Le code postal est incorrect';}
if(!preg_match($adressControl,$adress)){$errors['adress'] = 'L\'adress est incorrect';}
if(!preg_match($cityControl,$city)){$errors['city'] = 'La ville est incorrect';}
if(!filter_var($emailControl,FILTER_VALIDATE_EMAIL)){$errors['email'] = 'L\'email est incorrect';}
//if(!preg_match($questionControl,$question)){$errors['question'] = 'La question n\'est pas renseignée';}
if(empty($question)){$errors['question'] = 'La question n\'est pas renseignée';}
if($age>$deanOfHumanityAge){$errors['dateOfBirth'] = 'La date de naissance n\'est pas valide';}
if($age<$majorityAge){
    if($dateOfBirth>$today) // Si l'année de naissance est antérieur à la date du jour et l'année de naissance est inférieur à l'année de naissance du doyen de l'humanité
    {$errors['dateOfBirth'] = 'La date de naissance n\'est pas valide';} 
    else {$errors['dateOfBirth'] = 'Vous n\'êtes pas majeur !';}}
?>

    <?php include_once "topOfPage.php" ?>

    <div class="container">
        <p class="rouge">* Ces zones sont obligatoires</p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="#" method="POST" id="formContact">
                    <fieldset class="border border-dark p-2">
                        <legend>Vos coordonnées</legend>
                        <div class="form-group justify-content-center row">
                            <label for="lastName" class="col-md-3 col-form-label">Votre nom* :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text fas fa-user-circle"></div>
                                </div>
                                <input type="text" id="lastName" name="lastName" value="<?= $lastName ?>" class="form-control <?= ($isSubmit && isset($errors['lastName'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['lastName'])) ? 'is-valid' : '' ?>">
                                <div class="<?= (isset($errors['lastName'])) ? 'invalid-feedback' : ''?>"><?= $errors['lastName'] ?? '' ?></div>
                            </div>
                        </div>
                        <div class="form-group justify-content-center row">
                            <label for="firstName" class="col-md-3 col-form-label">Votre prénom* :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text far fa-user-circle"></div>
                                </div>
                                <input type="text" id="firstName" name="firstName" value="<?= $firstName ?>" class="form-control <?= ($isSubmit && isset($errors['firstName'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['firstName'])) ? 'is-valid' : '' ?>">
                                <div class="<?= (isset($errors['firstName'])) ? 'invalid-feedback' : ''?>"><?= $errors['firstName'] ?? '' ?></div>
                            </div>
                        </div>
                        <div class="form-group justify-content-center row">
                            <label for="gender" class="col-md-3 col-form-label">Sexe* :</label>
                            <div class="form-check form-check-inline col-md-8 justify-content-around">
                                <input type="radio" name="gender" id="gender" value="female" 
                                    class="form-check-input <?= ($isSubmit && isset($errors['gender'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['gender'])) ? 'is-valid': '' ?>" <?=($gender=="female")? "checked": '' ?>>
                                    
                                <label for="femme" class="form-check-label">Féminin</label>
                                <input type="radio" name="gender" id="gender" value="male"
                                    class="form-check-input <?= ($isSubmit && isset($errors['gender'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['gender'])) ? 'is-valid' : '' ?>" <?=($gender=="male")? "checked": '' ?>>
                                    
                                <label for="homme" class="form-check-label">Masculin</label>
                            </div>
                            <div class=" input-group col-md-5 <?= (isset($errors['gender'])) ? 'invalid-feedback' : ''?>"><?= ($isSubmit && (isset($errors['gender']))) ? $errors['gender'] : '' ?></div>
                        </div>
                        <div class="form-group justify-content-center row">
                            <label for="dateOfBirth" class="col-md-3 col-form-label">Date de naissance* :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text fas fa-calendar-alt"></div>
                                </div>
                                <input name="dateOfBirth" type="date"  value="<?= $dateOfBirth?>" id="dateOfBirth" value="<?=$dateOfBirth?>" class="form-control <?= ($isSubmit && isset($errors['dateOfBirth'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['dateOfBirth'])) ? 'is-valid' : '' ?>">
                                <div class="<?= (isset($errors['dateOfBirth'])) ? 'invalid-feedback' : ''?>"><?= $errors['dateOfBirth'] ?? '' ?></div>
                            </div>    
                        </div>
                        <div class="form-group justify-content-center row">
                            <label for="postalcode" class="col-md-3 col-form-label">Code postale :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text fas fa-map-marker-alt"></div>
                                </div>
                                <input type="text" name="zipCode" value="<?= $zipCode?>" id="zipCode" class="form-control <?= ($isSubmit && isset($errors['zipCode'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['zipCode'])) ? 'is-valid' : '' ?>">
                                <div class="<?= (isset($errors['zipCode'])) ? 'invalid-feedback' : ''?>"><?= $errors['zipCode'] ?? '' ?></div>
                            </div>
                        </div>
                        <div class="form-group justify-content-center row">
                            <label for="adress" class="col-md-3 col-form-label">Adresse :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text fas fa-home"></div>
                                </div>
                                <input type="text" name="adress" value="<?= $adress?>" id="adress" class="form-control <?= ($isSubmit && isset($errors['adress'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['adress'])) ? 'is-valid' : '' ?>">
                                <div class="<?= (isset($errors['adress'])) ? 'invalid-feedback' : ''?>"><?= $errors['adress'] ?? '' ?></div>
                            </div>
                        </div>
                        <div class="form-group justify-content-center row">
                            <label for="city" class="col-md-3 col-form-label">Ville :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text fas fa-city"></div>
                                </div>
                                <input type="text" name="city" id="city" value="<?= $city?>" class="form-control <?= ($isSubmit && isset($errors['city'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['city'])) ? 'is-valid' : '' ?>">
                                <div class="<?= (isset($errors['city'])) ? 'invalid-feedback' : ''?>"><?= $errors['city'] ?? '' ?></div>
                            </div>
                        </div>
                        <div class="form-group justify-content-center row">
                            <label for="email" class="col-md-3 col-form-label">Email* :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text fas fa-at"></div>
                                </div>
                                <input type="text" name="email" id="email" value="<?= $email?>" placeholder="dave.loper@afpa.fr" class="form-control <?= ($isSubmit && isset($errors['email'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['email'])) ? 'is-valid' : '' ?>">
                                <div class="<?= (isset($errors['email'])) ? 'invalid-feedback' : ''?>"><?= $errors['email'] ?? '' ?></div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="border border-dark p-2">
                        <legend>Votre demande</legend>
                        <div class="form-group justify-content-center row">
                            <label for="subject" class="col-md-3 col-form-label">Sujet* :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text fas fa-edit"></div>
                                </div>
                            <select name="subject" class="custom-select btn btn-outline-success"
                                id="subject">
                                <option value="order">Mes commandes</option>
                                <option value="productQuestion">Question sur les produits</option>
                                <option value="claim">Réclamation</option>
                                <option value="other">Autres</option>
                            </select>
                            <div class="valid-feedback">Saisissez votre nom</div>
                            </div>
                        </div>
                        <div class="form-group justify-content-center row">
                            <label for="question" class="col-md-3 col-form-label">Votre question* :</label>
                            <div class="input-group col-md-8">
                                <div class="input-group-prepend">
                                    <div class="input-group-text fas fa-question-circle"></div>
                                </div>
                                <textarea name="question" id="question" class="form-control <?= ($isSubmit && isset($errors['question'])) ? 'is-invalid' : '' ?>  <?= ($isSubmit && !isset($errors['question'])) ? 'is-valid' : '' ?>"><?= $question?></textarea>
                                <div class="<?= (isset($errors['question'])) ? 'invalid-feedback' : ''?>"><?= $errors['question'] ?? '' ?></div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-check d-flex justify-content-around pt-3 pb-3">
                        <label for="agrement" class="form-check-label">J'accepte le traitement informatique de ce
                            formulaire</label>
                        <input type="checkbox" name="agrement" class="custom-control-input" id="agrement"
                            value="agree" checked data-toggle="toggle" data-on="Oui" data-off="Non" data-onstyle="secondary" data-offstyle="danger">
                        <div class="invalid-feedback">Saisissez votre nom</div>
                    </div>
                    <div class="row d-flex justify-content-between p-0 m-0">
                        <button type="submit" name="submit" class="btn btn-secondary col-md-5">Envoyer</button>
                        <button type="reset" name="reset" class="btn btn-outline-danger col-md-5">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>

</html>