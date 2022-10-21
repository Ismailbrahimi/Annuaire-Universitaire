<?php
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Admin || Annuaire Unilim";
    include_once("layouts/header.php");
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'])) :?>

    <div class="recherche">
            <div class="boite_titre">Modifier Mot de Passe </div>

            <form action="includes/modifier_admin.inc.php" method="POST">
                <div class="zone_text">
                    <span class="voir_pass" id="voir_pass" onclick="mot_de_passe_visible()"><i class="far fa-eye fa-xs "></i></span>
                    <input id="mot_de_passe" name="mot_de_passe" type="password" placeholder="Mot de passe" value="<?=$_SESSION['MOT_DE_PASSE']?>">
                </div>
                <input type="submit" id="recherche_button" name="recherche_button" value="Modifier">            
            </form>
        </div>
   
<?php else : ?>
<?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>