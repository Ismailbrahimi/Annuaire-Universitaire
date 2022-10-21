<?php
session_start();
if(isset($_SESSION['ID_ADMIN'], $_POST['mot_de_passe'])){
    require_once('../../db.php');
    $mot_de_passe = mysqli_real_escape_string($connexion, $_POST['mot_de_passe']);
    $id = $_SESSION['ID_ADMIN'];

    $ajouter_filiere_query = "UPDATE `annuaireunilim`.`admin` SET `MOT_DE_PASSE` = '$mot_de_passe' WHERE (`ID_ADMIN` = '$id');";
    mysqli_query($connexion, $ajouter_filiere_query);

    $_SESSION['MOT_DE_PASSE'] = $mot_de_passe;
    mysqli_close($connexion);
    header("Location:../index.php");
}