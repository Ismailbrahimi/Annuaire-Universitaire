<?php

/**
 * cette fonction envois les filieres qui sont enregistrer dans la base de donnee
 * 
 * @return array : un tableau des filieres
 */
function get_filieres() {
    require_once("../db.php");

        $resultats = [];
        $filieres_query = "SELECT * FROM filiere;";


        $resultats_filieres = mysqli_query($connexion, $filieres_query);
        while($ligne = mysqli_fetch_assoc($resultats_filieres)) {
            $resultats[] = $ligne;
        }
        mysqli_close($connexion);

        return $resultats;
    
}