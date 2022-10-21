<?php
session_start();
    $titre_de_page = "Admin || Annuaire Unilim";
    include_once("layouts/header.php");
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'])) :?>
    <div id="erreurs_form"></div>
    <div class="recherche">
            <div class="boite_titre">Ajouter filière </div>

            <form action="includes/ajouter_filiere.inc.php" id="formulaire_recherche" method="POST">
                <div class="zone_text">
                    <input required name="label" type="text" placeholder="Label Filière">
                </div>

                <div class="zone_text">
                    <input required name="abreviation" type="text" placeholder="Abréviation Filière">
                </div>
                <input type="submit" id="recherche_button" name="ajouter_button" value="Ajouter">            
            </form>
    </div>
        
<?php else : ?>
<?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>