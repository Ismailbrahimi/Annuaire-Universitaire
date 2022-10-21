<?php
session_start();
if(isset($_SESSION['ID_ADMIN'], $_GET['id_modifier'])){
    require_once('../../db.php');
    $id = mysqli_real_escape_string($connexion, $_GET['id_modifier']);

    $supprimer_query = "DELETE FROM `annuaireunilim`.`filiere` WHERE (`ID_FILIERE` = '$id');";

    mysqli_query($connexion, $supprimer_query);
    
    if(mysqli_error($connexion) == "") {
        mysqli_close($connexion);
        header("Location:../filieres.php");
    }else {
        mysqli_close($connexion);
        header("Location:../filieres.php?erreur=integrite_referentielle");
    }
}