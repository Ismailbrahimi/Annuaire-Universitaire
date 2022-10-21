<?php
/**
 * ce script est utiliser pour l'ajout d'une utilisateur, il cherche si un utilisateur figure deja dans la base de donne avec cet email ou numero de telephone car ils sont unique
 */
session_start();
if(isset($_SESSION['ID_ADMIN'],$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['numero_de_telephone'], $_POST['mot_de_passe'], $_POST['description'])){
    require_once('../../db.php');
    $nom = mysqli_real_escape_string($connexion, strtolower($_POST['nom']));
    $prenom = mysqli_real_escape_string($connexion, strtolower($_POST['prenom']));
    $email = mysqli_real_escape_string($connexion, strtolower($_POST['email']));
    $numero_de_telephone = mysqli_real_escape_string($connexion, $_POST['numero_de_telephone']);
    $mot_de_passe = mysqli_real_escape_string($connexion, $_POST['mot_de_passe']);
    $description = mysqli_real_escape_string($connexion, strtolower($_POST['description']));


    $erreurs = '';

    if($description == 'enseignant' || $description == 'fonctionnaire'){
        $nom_table = "fonctionnaire";
        $identifiant_label = "PPR";
        
        if(isset($_POST['ppr'])) {
            $ppr = mysqli_real_escape_string($connexion, strtolower($_POST['ppr']));
            $identifiant = mysqli_real_escape_string($connexion, strtolower($ppr));
        }
    } else if ($description == 'etudiant') {
        $nom_table = "etudiant";
        $identifiant_label = "CNE";
        if(isset($_POST['cne'], $_POST['filiere'])) {
            $cne = mysqli_real_escape_string($connexion, strtolower($_POST['cne']));
            $identifiant = mysqli_real_escape_string($connexion, strtolower($cne));
            $filiere = mysqli_real_escape_string($connexion, $_POST['filiere']);
        }
    }



    /**
     * Vérifier si il existe un utilisateur avec ce numéro de téléphone
     */
    $verifie_numero_query = "SELECT NOM FROM fonctionnaire WHERE NUMERO_TELEPHONE='".$numero_de_telephone."'";
    $verifie_numero_query .= " UNION ALL SELECT NOM FROM etudiant WHERE NUMERO_TELEPHONE='".$numero_de_telephone."'";
    $resultat_numero = mysqli_query($connexion, $verifie_numero_query);
    $rowcount_numero = mysqli_num_rows($resultat_numero);


    /**
     * Vérifier si il existe un utilisateur avec cette adresse email
     */
    $verifie_email_query = "SELECT NOM FROM fonctionnaire WHERE EMAIL='".$email."'";
    $verifie_email_query .= "UNION ALL SELECT NOM FROM etudiant WHERE EMAIL='".$email."'";
    $resultat_email = mysqli_query($connexion, $verifie_email_query);
    $rowcount_email = mysqli_num_rows($resultat_email);


    /**
     * Vérifier si il existe un utilisateur avec cet identifiant (PPR pour les professeurs et les fonctionnaires || CNE pour l'etudiants)
     * 
     * @nom_table : soit c'est etudiant si l'utilisateur a choisi dans le formulaire Etudiant, soit fonctionnaire si l'utilisateur a choisi dans le formulaire professeurs | fonctionnaires
     * @identifiant_label : soit PPR ou bien CNE
     */
    $verifie_identifiant_query = "SELECT NOM FROM $nom_table WHERE $identifiant_label='".$identifiant."'";
    $resultat_identifiant = mysqli_query($connexion, $verifie_identifiant_query);
    $rowcount_identifiant = mysqli_num_rows($resultat_identifiant);
    


    /**
     * si mysqli_num_rows retourne une valeur differente de 0, alors j'ajoute une erreur d'existance
     */
    $erreurs = $rowcount_numero != 0 ? '<br>Le numero de telephone est deja existant<br>' : '';
    $erreurs .= $rowcount_email != 0 ? '<br>L\'email est deja existant<br>' : '';
    $erreurs .= $rowcount_identifiant != 0 ? '<br>L\'identifiant est deja existant' : '';

    /**
     * Insertion dans la base de donnees
     */
    if($erreurs != '') {
        $_SESSION['ERREUR'] = $erreurs;
        header("Location: ../ajouter_utilisateur.php");
    }else {
        if($identifiant_label == 'PPR'){
            $insert_fonctionnaire_query = "INSERT INTO `annuaireunilim`.`fonctionnaire` (`NOM`, `PRENOM`, `DESCRIPTION`, `EMAIL`, `NUMERO_TELEPHONE`, `MOT_DE_PASSE`, `PPR`) VALUES ('$nom', '$prenom', '$description', '$email', '$numero_de_telephone', '$mot_de_passe', '$ppr');";
            $resultat_insert = mysqli_query($connexion, $insert_fonctionnaire_query);
        }else if($identifiant_label == 'CNE'){
            $insert_etudiant_query = "INSERT INTO `annuaireunilim`.`etudiant` (`NOM`, `PRENOM`, `DESCRIPTION`, `EMAIL`, `NUMERO_TELEPHONE`, `MOT_DE_PASSE`, `ID_FILIERE`, `CNE`) VALUES ('$nom', '$prenom', '$description', '$email', '$numero_de_telephone', '$mot_de_passe', $filiere, '$cne');";
            $resultat_insert = mysqli_query($connexion, $insert_etudiant_query);
        }

        mysqli_close($connexion);
        if($resultat_insert) {
            header("Location: ../utilisateurs.php?success=true");
        }else {
            header("Location: ../utilisateurs.php?success=false");
        }
    }

}


    