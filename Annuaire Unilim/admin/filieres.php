<?php
session_start();
    $titre_de_page = "Admin || Annuaire Unilim";
    $to_load = '<script src="./js/app.js"></script>';
    include_once("layouts/header.php");
    include_once("fonctions/gestion_filieres.php");
    $resultats = [];
    $resultats = get_filieres();
    $count = count($resultats);
    $count_resultats = $count > 1 ? $count.' Filieres': $count.' Filiere';
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'])) :?>


        <div class="resultats">
            <span class="titre">Filieres</span>
            <h2 class="resultats_count"><?=$count_resultats?></h2>
            <a href="ajouter_filiere.php" id="ajouter_filiere">+ Ajouter une filiere</a>
            <?php if ($count >0):?>
            <table class="tableau_de_resultats">
                <tr>
                    <th>Abréviation Filière</th>
                    <th>Label Filière</th>
                    <th>Modification</th>
                    <th>Suppression</th>
                </tr>
                <?php foreach($resultats as $resultat) :?>
                <tr>
                    <td><?=$resultat['ABREVIATION_FILIERE']?></td>
                    <td><?=$resultat['LABEL_FILIERE']?></td>
                    <td><a id="button_modifier" class="button_admin" href="modifier_filiere.php?id_modifier=<?=$resultat['ID_FILIERE']?>">Modifier</a></td>
                    <td><button id="button_supprimer" class="button_admin" onclick="supprimer_element('includes/supprimer_filiere.inc.php?id_modifier=<?=$resultat['ID_FILIERE']?>')">Supprimer</button></td>                    

                </tr>
                <?php endforeach ?>
            
            </table>
            <?php else : ?> 
                <h1 style="margin:3%;">Pas de résultat pour votre recherche</h1>
            <?php endif ?>
        </div>

<?php else : ?>
    <?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>