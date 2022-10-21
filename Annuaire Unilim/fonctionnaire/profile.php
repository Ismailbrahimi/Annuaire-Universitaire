<?php 
session_start();
    $titre_de_page = "Fonctionnaire || Annuaire Unilim";
    include_once("layouts/header.php");
?>
<?php if (isset($_SESSION['ID'], $_SESSION['DESCRIPTION']) && ($_SESSION['DESCRIPTION'] =="fonctionnaire" || $_SESSION['DESCRIPTION'] =="enseignant")) :?>
    <?php if($_SESSION['COMPTE_ACTIVE'] == 1) : ?>

        <div class="boite_profile">
            <div class="boite_titre">Carte Personnel</div>
            <table>
                <tr>
                    <!-- ON A UTILISER ucfirst POUR CAPITALISER LE NOM/PRENOM/DESCRIPTION -->
                    <td>Nom</td>
                    <td><?=ucfirst($_SESSION['NOM'])?></td>
                </tr>
                <tr>
                    <td>Prenom</td>
                    <td><?=ucfirst($_SESSION['PRENOM'])?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?=$_SESSION['EMAIL']?></td>
                </tr>
                <tr>
                    <td>Numero</td>
                    <td><?=$_SESSION['NUMERO_TELEPHONE']?></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><?=ucfirst($_SESSION['DESCRIPTION'])?></td>
                </tr>
                <tr>
                    <td>PPR</td>
                    <td><?=$_SESSION['IDENTIFIANT']?></td>
                </tr>
            </table>
        </div>
    <?php else : ?>
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