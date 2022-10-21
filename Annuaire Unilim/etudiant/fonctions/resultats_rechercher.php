<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function resultats_rechercher_direct() {
    require_once("../db.php");
    if(isset($_POST['recherche_button'])) {
        $nom = '%%';
        $prenom = '%%';
        $filiere = '%%';
        $cne = '%%';
        $ppr = '%%';
        $description =  mysqli_real_escape_string($connexion, $_POST['recherche']);
        $resultats = []; //l'affichage sera simplement afficher selon un tableau ou on va affecter les elements


        /*
        pour faire la selection du nom, prenom, cne, ppr, filiere il fallait
        encodée les chaînes de caractères en une chaîne SQL échappée d'ou on 
        a travailler avec mysqli_real_escape_string on a fait la meme chose avec
        la recherche inverse pour le $numero de tel et $email  
        */

        if(isset($_POST['nom']))
            $nom = '%'.mysqli_real_escape_string($connexion, $_POST['nom']).'%';
        if(isset($_POST['prenom']))
            $prenom = '%'.mysqli_real_escape_string($connexion, $_POST['prenom']).'%';
        if(isset($_POST['PPR']))
            $ppr = mysqli_real_escape_string($connexion, $_POST['PPR']);
        if(isset($_POST['CNE']))
            $cne = mysqli_real_escape_string($connexion, $_POST['CNE']);
        if(isset($_POST['filiere']))
            $filiere = mysqli_real_escape_string($connexion, $_POST['filiere']);

        /////////////////////////////////// REQUETES  ////////////////////////////////

        if($description == 'fonctionnaire' || $description == 'enseignant')
            $recherche_query = "SELECT NOM,PRENOM ,EMAIL, NUMERO_TELEPHONE FROM fonctionnaire WHERE DESCRIPTION='$description' AND NOM like '$nom' AND PRENOM LIKE '$prenom' AND PPR LIKE '$ppr'";
        else 
            $recherche_query = "SELECT NOM,PRENOM ,EMAIL, NUMERO_TELEPHONE FROM etudiant WHERE  NOM like '$nom' AND PRENOM LIKE '$prenom' AND CNE LIKE '$cne' AND ID_FILIERE LIKE '$filiere'";

        //////////////////////////////////////////////////////////////////////////////

            $resultats_recherche = mysqli_query($connexion, $recherche_query);
            $count_resultats = mysqli_num_rows($resultats_recherche);

            if($count_resultats > 0) {
                while($ligne = mysqli_fetch_assoc($resultats_recherche)) {
                    $resultats[] = $ligne;
                }
            }// pour le else si = 0 on a envoyer un message d'erreur 
            mysqli_close($connexion);
            return $resultats;
    }
}
 
function resultats_rechercher_inverses() {
    require_once("../db.php");
    if(isset($_POST['recherche_button'])) {
        $email = '%%';
        $numero_de_telephone = '%%';

        $description =  mysqli_real_escape_string($connexion, $_POST['recherche']);
        $resultats = [];

        if(isset($_POST['numero']))
            $numero_de_telephone = mysqli_real_escape_string($connexion, $_POST['numero']);
        if(isset($_POST['email']))
            $email = mysqli_real_escape_string($connexion, $_POST['email']);


        if($description == 'fonctionnaire' || $description == 'enseignant')
            $recherche_query = "SELECT NOM, PRENOM, DESCRIPTION  FROM fonctionnaire WHERE  EMAIL like '$email' AND NUMERO_TELEPHONE LIKE '$numero_de_telephone' AND DESCRIPTION LIKE '$description'";
        else 
            $recherche_query = "SELECT  NOM, PRENOM, DESCRIPTION FROM etudiant WHERE  EMAIL like '$email' AND NUMERO_TELEPHONE LIKE '$numero_de_telephone'";


            $resultats_recherche = mysqli_query($connexion, $recherche_query);
            $count_resultats = mysqli_num_rows($resultats_recherche);

            if($count_resultats > 0) {
                while($ligne = mysqli_fetch_assoc($resultats_recherche)) {
                    $resultats[] = $ligne;
                }
            }
            mysqli_close($connexion);
            return $resultats;
    }
}