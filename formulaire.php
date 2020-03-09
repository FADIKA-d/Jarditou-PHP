<?php
require_once 'connexion_bdd.php';
$today = date("Y-m-d"); // variable contenant la date du jour
security($data);
//VARIABLES DE RECUPERATION DES REPONSES DU QUESTIONNAIRE
    $lastName = $_POST['lastName'] ?? '';
        $lastName = security($lastName);
    $firstName = $_POST['firstName'] ?? '';
        $firstName = security($firstName);
    $gender = $_POST['gender'] ?? '';
    
    $dateOfBirth = $_POST["dateOfBirth"] ?? '';
        
    $zipCode = $_POST['zipCode'] ?? '';
        $zipCode = security($zipCode);
    $adress = $_POST['adress'] ?? '';
        //$adress = security();
    $city = $_POST['city'] ?? '';
        //$city = security();
    $email = $_POST["email"] ?? '';
        $email = filtreEmail($email);
    $subject = $_POST["subject"] ?? '';

    $question = $_POST["question"] ?? '';
        $question = filtre($question);
    $agrement = $_POST["agrement"] ?? '';
    $isSubmit = isset($_POST['submit']) ? true : false;
    //echo $submit = $_POST["submit"];
    //echo $reset = $_POST["reset"];


$dateOfBirthTimestamp =strtotime($dateOfBirth); // convertion de la date de naissance saissie en Timestamp (format de mesure de la date)
$dateOfBirthTable = getdate($dateOfBirthTimestamp); // converstion du Timestamp en tableau
$yearOfBirth = $dateOfBirthTable["year"]; // obtenir l'année de naissance
$todayTimestamp =strtotime($today); // convertion de la date de naissance saissie en Timestamp (format de mesure de la date)
$dateOfTodayTable = getdate($todayTimestamp); // converstion du Timestamp en tableau
$yearOfToday = $dateOfTodayTable["year"];
$majorityAge = 18; // variable âge de la majorité
$deanOfHumanityAge = 122; //age du doyen de l'humanité
$adult = $yearOfToday-$majorityAge; //variable âge d'une personne majeur
$age = $yearOfToday-$yearOfBirth; //variable age

//REGEX
$lettersControl = '/^[a-z]{2,}((:?[- ][a-z]{2,})*)?$/' ; //regex : au moins deux lettres sépararés ou non par un espace ou un tiret
$genderControl ='/"femal"|"male"/'; // regex : uniquement réponse male ou femal
$zipCodeControl = '/^\d{5}$/'; //regex code postal
$adressControl='/^\d+\s+(bis|ter|quarter)?\s+[a-z]+\s(.)+$/'; // regex un nombre (au moins un chiffre) suivi de l'adresse (lettres)
$cityControl ='/^\w+(([- ])\w+)*$/'; //un ou plusieurs mots séparés par des tirets ou espaces (pouvant contenir un ou plusieurs chiffres)
$questionControl = '/^\w+(([- ])(\w)*+([!.?,\(\)]*))*[?.!]?$/m'; //regex texte libre
$emailControl = filter_var($email,FILTER_SANITIZE_EMAIL); //filtre email
$dateOfBirthControl = '/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/'; // controle date 
$year = preg_replace('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', '$1', '1986-12-07');

$errors = []; //declaration d'un tableau errors

//CONDITIONS DE REGEX SUR LES VALEURS RENSEIGNEES
if(!preg_match($lettersControl, $lastName)) //condition si : regex est faux 
{
    $errors['lastName'] = 'Le nom est incorrect'; //execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
}
if(!preg_match($lettersControl, $firstName)){$errors['firstName'] = 'Le prénom est incorrect';}  //condition si : regex est faux, execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
if($gender!=='female' && $gender!=='male'){$errors['gender'] = 'Veuillez renseigner une catégorie';} //condition si : valeur renseignée égale à 'femal' ou 'male', execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
if(!preg_match($dateOfBirthControl,$dateOfBirth)){$errors['dateOfBirth'] = 'La date est incorrect';} //condition si : regex est faux, execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
if(!preg_match($zipCodeControl, $zipCode)){$errors['zipCode'] = 'Le code postal est incorrect';} //condition si : regex est faux, execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
if(!preg_match($adressControl,$adress)){$errors['adress'] = 'L\'adress est incorrect';} //condition si : regex est faux, execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
if(!preg_match($cityControl,$city)){$errors['city'] = 'La ville est incorrect';} //condition si : regex est faux, execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
if(!filter_var($emailControl,FILTER_VALIDATE_EMAIL)){$errors['email'] = 'L\'email est incorrect';} //condition si : filtre faux, execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
//if(!preg_match($questionControl,$question)){$errors['question'] = 'La question n\'est pas renseignée';}
if(empty($question)){$errors['question'] = 'La question n\'est pas renseignée';} //condition si : vide, execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
if($age>$deanOfHumanityAge){$errors['dateOfBirth'] = 'La date de naissance n\'est pas valide';} //condition si : la variable age est supérieur à celle du doyen de l'humanité, execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
if($age<$majorityAge) //condition si la variable âge est inférieur à l'âge de la majorité 
    {if($dateOfBirth>$today) // execute : Si la date de naissance est posterieur à la date du jour 
    {$errors['dateOfBirth'] = 'La date de naissance n\'est pas valide';} // execute : le tableau errors prend la valeur entre cotes pour l'index entre crochet
    else {$errors['dateOfBirth'] = 'Vous n\'êtes pas majeur !';}} // Sinon : le tableau errors prend la valeur entre cotes pour l'index entre crochet

//         $db = connectionBase();
//         $requete = $db->prepare("INSERT INTO form (`form_last_name`, `form_first_name`,`form_gender`, `form_date_of_birth`, `form_zip_code`, `form_adress`, `form_city`, `form_email`,`form_subject`, `form_question`,`form_agrement`) VALUES 
// (:form_last_name, :form_first_name, :form_gender, :form_date_of_birth, :form_zip_code, :form_adress, :form_city, :form_email, :form_subject, :form_question, :form_agrement)");
// if($requete->execute(array(
//     ':form_last_name' => $lastName ,
//     ':form_first_name' => $firstName ,
//     ':form_gender' => $gender ,
//     ':form_date_of_birth' => $dateOfBirth ,
//     ':form_zip_code' => $zipCode ,
//     ':form_adress' => $adress ,
//     ':form_city' => $city ,
//     ':form_email' => $email ,
//     ':form_subject' => $subject ,
//     ':form_question' => $question ,
//     ':form_agrement' => $agrement
// ))) 
// {
//     $success=true;
// }
// else
// {
//     echo 'le formulaire n\'est pas valide'; 
// }; 

?>

<?php include_once "topOfPage.php" ?>
    <?php
    if(isset($success)) 
    { 
    ?>
    <p class="alert alert-success">Le formulaire a été ajouté!</p>
    <?php 
    } 
    ?>
<div class="container">
        <p class="rouge">* Ces zones sont obligatoires</p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="#" method="POST" id="formContact" class="">
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
    <?php include_once "endOfPage.php" ?> 