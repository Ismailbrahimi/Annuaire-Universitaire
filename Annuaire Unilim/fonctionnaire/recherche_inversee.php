<?php
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Fonctionnaire || Annuaire Unilim";
    include_once("layouts/header.php");//inclusion du header pour attribuer le .css et le header pour modifier/voir/deconnecter du profile 
?>

<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--
    sachant que la recherche inverse va se faire par email ou numero de telephone pour tout( fonctionnaire/enseignant/etudiant) donc on va 
    afficher un bloc pour toutes les sessions 
-->

<?php if (isset($_SESSION['ID'], $_SESSION['DESCRIPTION']) && ($_SESSION['DESCRIPTION'] =="fonctionnaire" || $_SESSION['DESCRIPTION'] =="enseignant")) :?>
    <?php if($_SESSION['COMPTE_ACTIVE'] == 1) : ?>

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
                <!-- on va envoyer un alert si les champs sont vide par verifier_vide() si c'est !=0 on fait un submit simple dans resultats_inverses.php-->
                <input type="button" onclick="verifier_vide(document.getElementById('formulaire_recherche'))" id="recherche_button" value="Rechercher">            
            </form>
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