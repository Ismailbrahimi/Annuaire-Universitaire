<?php
session_start();
if(isset($_SESSION['ID_ADMIN'],$_POST['id_modifier'], $_POST['abreviation'], $_POST['label'])){
    require_once('../../db.php');
    $id = mysqli_real_escape_string($connexion, $_POST['id_modifier']);
    $label = mysqli_real_escape_string($connexion, $_POST['label']);
    $abreviation = mysqli_real_escape_string($connexion, strtoupper($_POST['abreviation']));

    $modifier_query = "UPDATE `annuaireunilim`.`filiere` SET `LABEL_FILIERE` = '$label', `ABREVIATION_FILIERE` = '$abreviation' WHERE (`ID_FILIERE` = $id);";

    $result = mysqli_query($connexion, $modifier_query);
    mysqli_close($connexion);
    header("Location: ../filieres.php?success=modifier");

}