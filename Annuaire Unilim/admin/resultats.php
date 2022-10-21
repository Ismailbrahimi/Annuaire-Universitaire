<?php
session_start();
    $titre_de_page = "Admin || Annuaire Unilim";
    include_once("layouts/header.php");
    include_once("fonctions/resultats_rechercher.php");
    $resultats = [];
    $resultats = resultats_rechercher_direct();
    $count = count($resultats);
    $count_resultats = $count > 1 ? $count.' Resultats': $count.' Resultat';
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'])) :?>


        <div class="resultats">
            <span class="titre">Resultats de la recherche</span>
            <h2 class="resultats_count"><?=$count_resultats?></h2>
            <?php if ($count >0):?>
            <table class="tableau_de_resultats">
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Numéro de Téléphone</th>
                </tr>
                <?php foreach($resultats as $resultat) :?>
                <tr>
                    <td><?=$resultat['NOM']?></td>
                    <td><?=$resultat['PRENOM']?></td>
                    <td><?=$resultat['EMAIL']?></td>
                    <td><?=$resultat['NUMERO_TELEPHONE']?></td>
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