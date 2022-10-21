<?php
session_start();
    $titre_de_page = "Admin || Annuaire Unilim";
    $to_load = '<script src="./js/app.js"></script>';
    include_once("layouts/header.php");
    include_once("fonctions/gestion_utilisateurs.php");
    $resultats = [];
    $resultats = get_utilisateurs();
    $count = count($resultats);
    $count_resultats = $count > 1 ? $count.' Utilisateurs': $count.' Utilisateur';
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'])) :?>


        <div class="resultats">
            <span class="titre">Utilisateurs</span>
            <h2 class="resultats_count"><?=$count_resultats?></h2>
            <a href="ajouter_utilisateur.php" id="ajouter_utilisateur">+ Ajouter un utilisateur</a>

            <?php if ($count >0):?>
            <table class="tableau_de_resultats tableau_utilisateurs">
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Description</th>
                    <th>Modification</th>
                    <th>Suppression</th>
                    <th>Activation</th>
                </tr>
                <?php foreach($resultats as $resultat) :?>
                <tr>
                    <td><?=$resultat['NOM']?></td>
                    <td><?=$resultat['PRENOM']?></td>
                    <td><?=$resultat['DESCRIPTION']?></td>
                    <td><a id="button_modifier" class="button_admin" href="modifier.php?description=<?=$resultat['DESCRIPTION']?>&id_modifier=<?=$resultat['ID']?>">Modifier</a></td>
                    <td><button id="button_supprimer" class="button_admin" onclick="supprimer_element('includes/supprimer_utilisateur.inc.php?description=<?=$resultat['DESCRIPTION']?>&id_modifier=<?=$resultat['ID']?>')">Supprimer</button></td>                    
                    <?php if($resultat['COMPTE_ACTIVE'] == 0) :?>
                        <td><a id="button_desactiver" class="button_admin" href="includes/activer_utilisateur.inc.php?description=<?=$resultat['DESCRIPTION']?>&id_modifier=<?=$resultat['ID']?>">Desactivé</a></td>
                    <?php else :?>
                        <td><a id="button_activer" class="button_admin" href="includes/desactiver_utilisateur.inc.php?description=<?=$resultat['DESCRIPTION']?>&id_modifier=<?=$resultat['ID']?>">Activé</a></td>
                    <?php endif ?>
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