<?php

/**
 * ce script est utiliser pour modifier un utilisateur.
 */
session_start();
if(isset($_SESSION['ID_ADMIN'],$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['numero_de_telephone'], $_POST['mot_de_passe'], $_POST['id_modifier'], $_POST['description'])){
    require_once('../../db.php');
    $id = mysqli_real_escape_string($connexion, $_POST['id_modifier']);
    $description = mysqli_real_escape_string($connexion, $_POST['description']);
    $nom = mysqli_real_escape_string($connexion, strtolower($_POST['nom']));
    $prenom = mysqli_real_escape_string($connexion, strtolower($_POST['prenom']));
    $email = mysqli_real_escape_string($connexion, strtolower($_POST['email']));
    $numero_de_telephone = mysqli_real_escape_string($connexion, $_POST['numero_de_telephone']);
    $mot_de_passe = mysqli_real_escape_string($connexion, $_POST['mot_de_passe']);

    $erreurs = '';

        /**
     * Vérifier si il existe un utilisateur avec ce numéro de téléphone
     */
    $verifie_numero_query = "SELECT NOM, ID_FONCTIONNAIRE FROM fonctionnaire WHERE NUMERO_TELEPHONE='$numero_de_telephone' AND  ID_FONCTIONNAIRE <> $id";
    $verifie_numero_query .= " UNION ALL SELECT NOM, ID_ETUDIANT FROM etudiant WHERE NUMERO_TELEPHONE='$numero_de_telephone' AND  ID_ETUDIANT <> $id";
    $resultat_numero = mysqli_query($connexion, $verifie_numero_query);
    $rowcount_numero = mysqli_num_rows($resultat_numero);


    /**
     * Vérifier si il existe un utilisateur avec cette adresse email
     */
    $verifie_email_query = "SELECT NOM, ID_FONCTIONNAIRE FROM fonctionnaire WHERE EMAIL='$email' AND  ID_FONCTIONNAIRE <> $id";
    $verifie_email_query .= " UNION ALL SELECT NOM, ID_ETUDIANT  FROM etudiant WHERE EMAIL='$email' AND  ID_ETUDIANT <> $id";
    $resultat_email = mysqli_query($connexion, $verifie_email_query);
    $rowcount_email = mysqli_num_rows($resultat_email);


    $erreurs = $rowcount_numero != 0 ? '<br>Le numero de telephone est deja existant<br>' : '';
    $erreurs .= $rowcount_email != 0 ? '<br>L\'email est deja existant<br>' : '';

    if($erreurs != ''){
        /**
         * si je trouve une erreur alors je fais une redirection vers la page de modificati
         */
        $_SESSION['ERREUR'] = $erreurs;
        header("Location: ../modifier.php?description=$description&id_modifier=$id");
    }else{
        if($description == 'etudiant'){
            $modifier_query = "UPDATE `annuaireunilim`.`etudiant` SET `NOM` = '$nom', `PRENOM` = '$prenom', `EMAIL` = '$email', `NUMERO_TELEPHONE` = '$numero_de_telephone', `MOT_DE_PASSE` = '$mot_de_passe' WHERE (`ID_ETUDIANT` = $id);";
        }else{
            $modifier_query = "UPDATE `annuaireunilim`.`fonctionnaire` SET `NOM` = '$nom', `PRENOM` = '$prenom', `EMAIL` = '$email', `NUMERO_TELEPHONE` = '$numero_de_telephone', `MOT_DE_PASSE` = '$mot_de_passe' WHERE (`ID_FONCTIONNAIRE` = $id);";
        }

        $resultat_modification = mysqli_query($connexion, $modifier_query);
        mysqli_close($connexion);
        header("Location: ../utilisateurs.php?success=modifier");
    }

    
}