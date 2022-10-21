<?php
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Etudiant || Annuaire Unilim";
    include_once("layouts/header.php");//inclusion du header pour attribuer le .css et le header pour modifier/voir/deconnecter du profile
?>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!--
    sachant que la recherche inverse chez les etudiants va se faire juste par email pour tout( fonctionnaire/enseignant/etudiant) donc on va 
    afficher un bloc pour toutes les sessions 
-->
<?php if (isset($_SESSION['ID'], $_SESSION['DESCRIPTION']) && ($_SESSION['DESCRIPTION'] =="etudiant")) :?>
    <?php if($_SESSION['COMPTE_ACTIVE'] == 1) : ?>

        <div class="recherche">
            <div class="boite_titre">Recherche inversée </div>

            <form action="resultats_inverses.php" id="formulaire_recherche" method="POST">
                <div class="zone_text">
                    <input id="email" name="email" type="text" placeholder="Adresse email">
                </div>
                <input type="hidden" name="recherche" value="<?=$_GET['recherche']?>">
                <input type="submit" id="recherche_button" name="recherche_button" value="Rechercher">            
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