<?php
session_start();
if(isset($_SESSION['ID'],$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['numero_de_telephone'], $_POST['mot_de_passe'])){
    require_once('../../db.php');
    $id = $_SESSION['ID'];
    $nom = mysqli_real_escape_string($connexion, strtolower($_POST['nom']));
    $prenom = mysqli_real_escape_string($connexion, strtolower($_POST['prenom']));
    $email = mysqli_real_escape_string($connexion, strtolower($_POST['email']));
    $numero_de_telephone = mysqli_real_escape_string($connexion, $_POST['numero_de_telephone']);
    $mot_de_passe = mysqli_real_escape_string($connexion, $_POST['mot_de_passe']);

    $erreurs = '';

    /*
      on vérifie si il existe un utilisateur avec ce numéro de téléphone 
     */
    $verifie_numero_query = "SELECT NOM, ID_FONCTIONNAIRE FROM fonctionnaire WHERE NUMERO_TELEPHONE='$numero_de_telephone' AND  ID_FONCTIONNAIRE <> $id";
    $verifie_numero_query .= " UNION ALL SELECT NOM, ID_ETUDIANT FROM etudiant WHERE NUMERO_TELEPHONE='$numero_de_telephone' AND  ID_ETUDIANT <> $id";
    $resultat_numero = mysqli_query($connexion, $verifie_numero_query);
    $rowcount_numero = mysqli_num_rows($resultat_numero);


    /*
      on vérifie si il existe un utilisateur avec cette adresse email
     */
    $verifie_email_query = "SELECT NOM, ID_FONCTIONNAIRE FROM fonctionnaire WHERE EMAIL='$email' AND  ID_FONCTIONNAIRE <> $id";
    $verifie_email_query .= " UNION ALL SELECT NOM, ID_ETUDIANT  FROM etudiant WHERE EMAIL='$email' AND  ID_ETUDIANT <> $id";
    $resultat_email = mysqli_query($connexion, $verifie_email_query);
    $rowcount_email = mysqli_num_rows($resultat_email);

    // au cas ou on met un email ou um numero deja existant on lance les erreurs 
    $erreurs = $rowcount_numero != 0 ? '<br>Le numero de telephone est deja existant<br>' : '';
    $erreurs .= $rowcount_email != 0 ? '<br>L\'email est deja existant<br>' : '';

    if($erreurs != '')
    {
        $_SESSION['ERREUR'] = $erreurs;
        header("Location: ../modifier.php");
    }else
    {
        $modifier_query = "UPDATE `annuaireunilim`.`fonctionnaire` SET `NOM` = '$nom', `PRENOM` = '$prenom', `EMAIL` = '$email', `NUMERO_TELEPHONE` = '$numero_de_telephone', `MOT_DE_PASSE` = '$mot_de_passe' WHERE (`ID_FONCTIONNAIRE` = $id);";
        $resultat_modification = mysqli_query($connexion, $modifier_query);

    /*
           on va mettre a jour les variables de sessions 
    */

        $_SESSION['NOM'] = $nom;
        $_SESSION['PRENOM'] = $prenom;
        $_SESSION['EMAIL'] = $email;
        $_SESSION['NUMERO_TELEPHONE'] = $numero_de_telephone;
        $_SESSION['MOT_DE_PASSE'] = $mot_de_passe;
        mysqli_close($connexion);
        header("Location: ../index.php?success=modifier");
    }

    
}