<?php

/**
 * cette fonction envois les utilisateurs qui sont enregistrer dans la table etudiants et fonctionnaires
 * 
 * @return array : un tableau des utilisateurs
 */

function get_utilisateurs() {
    require_once("../db.php");

        $resultats = [];
        $fonctionnaire_query = "SELECT ID_FONCTIONNAIRE AS ID, NOM,PRENOM, COMPTE_ACTIVE, DESCRIPTION FROM fonctionnaire ORDER BY COMPTE_ACTIVE";
        $etudiant_query = "SELECT ID_ETUDIANT AS ID, NOM,PRENOM, COMPTE_ACTIVE, DESCRIPTION FROM etudiant ORDER BY COMPTE_ACTIVE";


        $resultats_fonctionnaire = mysqli_query($connexion, $fonctionnaire_query);
        while($ligne = mysqli_fetch_assoc($resultats_fonctionnaire)) {
            $resultats[] = $ligne;
        }

        $resultats_etudiant = mysqli_query($connexion, $etudiant_query);
        while($ligne = mysqli_fetch_assoc($resultats_etudiant)) {
            $resultats[] = $ligne;
        }
        mysqli_close($connexion);
        return $resultats;
    
}