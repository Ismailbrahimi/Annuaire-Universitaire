<!-- création d'une session -->
<?php
session_start();
    $titre_de_page = "Fonctionnaire || Annuaire Unilim";
    include_once("layouts/header.php");
?>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------->

<?php if (isset($_SESSION['ID'], $_SESSION['DESCRIPTION']) && ($_SESSION['DESCRIPTION'] =="fonctionnaire" || $_SESSION['DESCRIPTION'] =="enseignant")) :?>
    <!--RAPPEL 1= actif :: 0= non actif-->
    <?php if($_SESSION['COMPTE_ACTIVE'] == 1) : ?>
        <table class="elements">
            <tr>
                <td>
                    <a class="contenu" href="./recherche.php?recherche=etudiant">
                        <i class="fas fa-user-graduate fa-7x"></i><br> <!-- icone de recherche d'etudiant-->
                        <h2>Annuaire Etudiants</h2>
                    </a>
                </td>
                <td>
                    <a class="contenu" href="./recherche.php?recherche=enseignant">
                    <i class="fas fa-chalkboard-teacher fa-7x"></i><br><!-- icone de recherche de professeur-->
                    <h2>Annuaire Professeurs</h2>
                </td>
                <td>
                    <a class="contenu" href="./recherche.php?recherche=fonctionnaire">
                        <i class="fas fa-user-cog fa-7x"></i><br><!-- icone de recherche de fonctionnaire-->
                        <h2>Annuaire Fonctionnaires</h2>
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <a class="contenu" href="./recherche_inversee.php?recherche=etudiant">
                        <i class="fas fa-user-graduate fa-7x"></i><br><!-- icone de recherche inverse d'etudiant-->
                        <h2>Annuaire inversé Etudiants</h2>
                    </a>
                </td>
                <td>
                    <a class="contenu" href="./recherche_inversee.php?recherche=enseignant">
                        <i class="fas fa-chalkboard-teacher fa-7x"></i><br><!-- icone de recherche inverse de professeur-->
                        <h2>Annuaire inversé Professeurs</h2>
                    </a>
                </td>
                <td>
                    <a class="contenu" href="./recherche_inversee.php?recherche=fonctionnaire">
                        <i class="fas fa-user-cog fa-7x"></i><br><!-- icone de recherche inverse de fonctionnaire-->
                        <h2>Annuaire inversé Fonctionnaires</h2>
                    </a>
                </td>
            </tr>
        </table>
   
<!------------------------------------------------------------------------------------------------------------------------------------------------>
   
        <?php else : ?>
        <?php 
        // Dans le cas ou <?php if($_SESSION['COMPTE_ACTIVE'] == 0) : //compte desactiver 
        // on redirectionne vers comptenonactive puis destruction
            header("Location:../comptenonactive.html");
            unset($_SESSION); // détruire la variable globale $_SESSION
            session_destroy(); // détruire la session
        ?>
    <?php endif ?>
    
<?php else : ?>
<?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>