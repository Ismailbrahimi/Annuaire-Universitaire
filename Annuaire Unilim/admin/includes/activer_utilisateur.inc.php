<?php
/**
 * ce script active les compte desactiver avec une requete UPDATE avec la clause WHERE id = l'utilisateur cible($_GET['id_modifier'])
 */
session_start();
if(isset($_SESSION['ID_ADMIN'],$_GET['description'], $_GET['id_modifier'])){
    require_once('../../db.php');
    $id = mysqli_real_escape_string($connexion, $_GET['id_modifier']);
    $description = mysqli_real_escape_string($connexion, $_GET['description']);

    if($description == 'etudiant'){
        $activer_query = "UPDATE `annuaireunilim`.`etudiant` SET `COMPTE_ACTIVE` = '1' WHERE (`ID_ETUDIANT` = $id);";
    }else{
        $activer_query = "UPDATE `annuaireunilim`.`fonctionnaire` SET `COMPTE_ACTIVE` = '1' WHERE (`ID_FONCTIONNAIRE` = $id);";
    }

    mysqli_query($connexion, $activer_query);
    mysqli_close($connexion);
    header("Location:../utilisateurs.php");
}