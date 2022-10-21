<?php
session_start();
if(isset($_SESSION['ID_ADMIN'],$_GET['description'], $_GET['id_modifier'])){
    require_once('../../db.php');
    $id = mysqli_real_escape_string($connexion, $_GET['id_modifier']);
    $description = mysqli_real_escape_string($connexion, $_GET['description']);

    if($description == 'etudiant'){
        $supprimer_query = "DELETE FROM `annuaireunilim`.`etudiant` WHERE (`ID_ETUDIANT` = $id);";
    }else{
        $supprimer_query = "DELETE FROM `annuaireunilim`.`fonctionnaire` WHERE (`ID_FONCTIONNAIRE` = $id);";
    }

    mysqli_query($connexion, $supprimer_query);
    mysqli_close($connexion);
    header("Location:../utilisateurs.php");
}