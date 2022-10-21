<?php

/**
 * l'ajout d'une filiere
 */
session_start();
if(isset($_SESSION['ID_ADMIN'], $_POST['abreviation'], $_POST['label'])){
    require_once('../../db.php');
    $abreviation = mysqli_real_escape_string($connexion, strtoupper($_POST['abreviation']));
    $label = mysqli_real_escape_string($connexion,  $_POST['label']);
    $ajouter_filiere_query = "INSERT INTO `annuaireunilim`.`filiere` (`LABEL_FILIERE`, `ABREVIATION_FILIERE`) VALUES ('$label', '$abreviation');";


    mysqli_query($connexion, $ajouter_filiere_query);
    mysqli_close($connexion);
    header("Location:../filieres.php");
}