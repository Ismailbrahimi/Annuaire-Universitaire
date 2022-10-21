<?php
session_start();
    $titre_de_page = "Etudiant || Annuaire Unilim";
    include_once("layouts/header.php");
    include_once("fonctions/resultats_rechercher.php");
    $resultats = [];
    $resultats = resultats_rechercher_inverses();

    $count = count($resultats);
    $count_resultats = $count > 1 ? $count.' Resultats': $count.' Resultat';//affichage du nombre d'elements trouves
?>

<!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<?php if (isset($_SESSION['ID'], $_SESSION['DESCRIPTION']) && ($_SESSION['DESCRIPTION'] =="etudiant")) :?>
    <?php if($_SESSION['COMPTE_ACTIVE'] == 1) : //on verifie toujours si le compte est actif?>
        <div class="resultats">
            <span class="titre">Resultats de la recherche</span>
            <h2 class="resultats_count"><?=$count_resultats?></h2>
            <?php if ($count >0):?>
            <table class="tableau_de_resultats">
                <tr>
                    <!-- Pour la recherche inverse chez les etudiant on a afficher le nom/prenom/description-->
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Description</th>
                </tr>
                <?php foreach($resultats as $resultat) :?>
                <tr>
                    <td><?=$resultat['NOM']?></td>
                    <td><?=$resultat['PRENOM']?></td>
                    <td><?=$resultat['DESCRIPTION']?></td>
                </tr>
                <?php endforeach ?>
            
            </table>
            <?php else : ?> 
                 <!-- si le $count = 0-->
                <h1 style="margin:3%;">Pas de résultat pour votre recherche</h1>
            <?php endif ?>
        </div>
<!---------------------------------------------------------------------------------------------------------------------------------------------------->

    <?php else : // Dans le cas ou <?php if($_SESSION['COMPTE_ACTIVE'] == 0) : //compte desactiver ?>
        <?php 
            header("Location:../comptenonactive.html");
            unset($_SESSION); // détruire la variable globale $_SESSION
            session_destroy(); // détruire la session
        ?>
    <?php endif ?>
<?php else : ?>
    <?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>