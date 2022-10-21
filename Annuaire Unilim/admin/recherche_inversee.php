<?php
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Admin || Annuaire Unilim";
    include_once("layouts/header.php");
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'])) :?>


        <div class="recherche">
            <div class="boite_titre">Recherche inversée </div>
            <h4 style="text-align: center;">Avec quoi vous voullez effectuer la recherche</h4>
            <select name="" id="choix" onchange="ajouter_champs(this)">
                <option value="">---- Choisir un nouveau champ ----</option>
                <option value="numero">Numero de telephone</option>
                <option value="email">Adresse Email</option>
            </select>
            <form action="resultats_inverses.php" id="formulaire_recherche" method="POST">
                <div id="champs_de_recherche"></div>
                <input type="hidden" name="recherche" value="<?=$_GET['recherche']?>">
                <input type="hidden" name="recherche_button">
                <input type="button" onclick="verifier_vide(document.getElementById('formulaire_recherche'))" id="recherche_button" value="Rechercher">            </form>
        </div>
        
<?php else : ?>
    <?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>