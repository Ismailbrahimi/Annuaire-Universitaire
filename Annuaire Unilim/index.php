<?php
session_start();
if(isset($_SESSION['ID']))
{
    if($_SESSION['DESCRIPTION']=="fonctionnaire" || $_SESSION['DESCRIPTION']=="enseignant"){ 
        header("Location:fonctionnaire/index.php"); //redirection vers l'index du fonctionnaire et de l'enseignant 
    }else {
        header("Location:etudiant/index.php"); // sinon redirection vers l'index de l'etudiant
    }
}
else if(isset($_SESSION['ID_ADMIN']))
{  //redirection vers la session de l'admin
    header("Location:admin/index.php");
}
else 
{
    header("Location:signinup/connexion.php");  //sinon la page d'authentification
}