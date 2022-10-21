<!-- création d'une session -->
<?php
session_start();
if(isset($_POST['email'], $_POST['mot_de_passe'])){ //si l'email et le mdp sont bien definie
    require_once('../../db.php'); //appel de la bdd dans db.php
    //declaration de l'email et mdp
    $email = $_POST['email'];  
    $mot_de_passe = $_POST['mot_de_passe'];
 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*
      On cherche dans le deux tables a la fois (Table des etudiants et table des fonctionnaire & enseignants)
      Pour cela on utilise UNION
      Si on ne trouve pas dans le deux tables, alors on cherche dans la table admin (ligne 37 )
     */
//recherche :
    $connexion_query = "SELECT ID_FONCTIONNAIRE as ID,PPR as IDENTIFIANT, NOM, PRENOM, EMAIL, DESCRIPTION,NUMERO_TELEPHONE, MOT_DE_PASSE, COMPTE_ACTIVE FROM fonctionnaire WHERE EMAIL='$email' AND MOT_DE_PASSE='$mot_de_passe'";
    $connexion_query .= "UNION ALL SELECT ID_ETUDIANT ,CNE , NOM, PRENOM, EMAIL, DESCRIPTION, NUMERO_TELEPHONE, MOT_DE_PASSE, COMPTE_ACTIVE FROM etudiant WHERE EMAIL='$email' AND MOT_DE_PASSE='$mot_de_passe';";
    $connexion_resultats = mysqli_query($connexion, $connexion_query);
    $rowcount_utilisateurs = mysqli_num_rows($connexion_resultats);

    if ($rowcount_utilisateurs != 0) { // si on trouve un resultat dans les tables
        $utilisateur = mysqli_fetch_assoc($connexion_resultats);
        //declaration des variables id, description .....
        $_SESSION['ID'] = $utilisateur['ID'];
        $_SESSION['DESCRIPTION'] = $utilisateur['DESCRIPTION'];
        $_SESSION['COMPTE_ACTIVE'] = $utilisateur['COMPTE_ACTIVE'];
        $_SESSION['NOM'] = $utilisateur['NOM'];
        $_SESSION['PRENOM'] = $utilisateur['PRENOM'];
        $_SESSION['EMAIL'] = $utilisateur['EMAIL'];
        $_SESSION['NUMERO_TELEPHONE'] = $utilisateur['NUMERO_TELEPHONE'];
        $_SESSION['MOT_DE_PASSE'] = $utilisateur['MOT_DE_PASSE'];
        $_SESSION['IDENTIFIANT'] = $utilisateur['IDENTIFIANT'];
        header("Location:../connexion.php?success=true"); //connexion avec reussite
    }
    else
    {
        // on recherche dans la table admin 
        $admin_query = "SELECT * FROM admin WHERE EMAIL = '$email' AND MOT_DE_PASSE='$mot_de_passe'";
        $admin_resultas = mysqli_query($connexion, $admin_query);
        $rowcount_admin = mysqli_num_rows($admin_resultas);

        if($rowcount_admin != 0) //si connexion reussite
        {
            $admin = mysqli_fetch_assoc($admin_resultas);
            $_SESSION['ID_ADMIN'] = $admin['ID_ADMIN'];
            $_SESSION['EMAIL'] = $admin['EMAIL'];
            $_SESSION['MOT_DE_PASSE'] = $admin['MOT_DE_PASSE'];
            mysqli_close($connexion);
            header("Location:../../admin/index.php"); //redirection directe vers la page principale d'admin
        }
        else //si on n'arrive pas a trouver un resultat on lance l'erreur, cette session d'erreur contient la barre rouge 
        {
            $_SESSION['ERREUR'] = 'Votre email ou bien mot de passe est incorrrect';
            mysqli_close($connexion);
            header("Location:../connexion.php");
        }
    }
}