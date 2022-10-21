<?php 
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Etudiant || Annuaire Unilim";
    include_once("layouts/header.php");
?>

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->

<?php if (isset($_SESSION['ID'], $_SESSION['DESCRIPTION']) && ($_SESSION['DESCRIPTION'] =="etudiant")) :?>
    <?php if($_SESSION['COMPTE_ACTIVE'] == 1) : ?>
        
        <?php if(isset($_SESSION['ERREUR'])) : ?>
            <div id="erreurs">
            <?=$_SESSION['ERREUR']?>
            <?php ?>
            </div>
        <?php endif ?>
        <div id="erreurs_form"></div>

        <div class="modification" style="margin-bottom:50px; <?php if(isset($_SESSION['ERREUR'])) echo 'margin-top:70px;'; unset($_SESSION['ERREUR']); ?>">
            <div class="boite_titre">Modification du profile</div>
            <form action="./includes/modifier.inc.php" id="modifier_form" method="POST">
                <label for="nom">Nom :</label>
                <div class="zone_text">
                    <input id="nom" name="nom" type="text" value="<?=$_SESSION['NOM']?>" placeholder="Nom">
                </div>

                <label for="Prenom">Prenom :</label>
                <div class="zone_text">
                    <input id="prenom" name="prenom" type="text" value="<?=$_SESSION['PRENOM']?>" placeholder="Prenom">
                </div>

                <label for="Email">Email :</label>
                <div class="zone_text">
                    <input id="email" name="email" type="text" value="<?=$_SESSION['EMAIL']?>" placeholder="Email">
                </div>

                <label for="numero">Numéro de téléphone :</label>
                <div class="zone_text">
                    <input id="numero_de_telephone" name="numero_de_telephone" type="text" value="<?=$_SESSION['NUMERO_TELEPHONE']?>" placeholder="Numéro de téléphone">
                </div>

                <label for="mot_de_passe">Mot de passe :</label>
                <div class="zone_text">
                    <span class="voir_pass" id="voir_pass" onclick="mot_de_passe_visible()"><i class="far fa-eye fa-xs "></i></span>
                    <input id="mot_de_passe" name="mot_de_passe" type="password" value="<?=$_SESSION['MOT_DE_PASSE']?>" placeholder="Mot de passe">
                </div>

                <input type="button" id="modification_button" onclick="validation_formulaire_modification()"  value="Modifier">

            </form>
        </div>

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->

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