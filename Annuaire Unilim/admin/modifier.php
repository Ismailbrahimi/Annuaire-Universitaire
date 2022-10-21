<?php 
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Admin || Annuaire Unilim";
    include_once("layouts/header.php");
    require_once("../db.php");
    if(isset($_GET['description'], $_GET['id_modifier'])){
        $description = $_GET['description'];
        $id = $_GET['id_modifier'];
        if($description == "etudiant") {
            $utilisateur_query = "SELECT * FROM etudiant WHERE ID_ETUDIANT=$id;";
        }else{
            $utilisateur_query = "SELECT * FROM fonctionnaire WHERE ID_FONCTIONNAIRE=$id;";
        }
        $resultats = mysqli_query($connexion, $utilisateur_query);
        $row_count = mysqli_num_rows($resultats);
        $utilisateur = mysqli_fetch_assoc($resultats);
        mysqli_close($connexion);
        if($row_count == 0){
            header("Location:index.php");
        }
    }
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'], $_GET['description'], $_GET['id_modifier'])) :?>

        <?php if(isset($_SESSION['ERREUR'])) : ?>
            <div id="erreurs">
                <?=$_SESSION['ERREUR']?>
                <?php ?>
            </div>
        <?php endif ?>
        <div id="erreurs_form"></div>
        <div class="modification" style="margin-bottom:50px; <?php if(isset($_SESSION['ERREUR'])) echo 'margin-top:70px;'; unset($_SESSION['ERREUR']); ?>">
            <div class="boite_titre">Modification du profile</div>
            <form action="./includes/modifier_utilisateur.inc.php" id="modifier_form" method="POST">
                <input type="hidden" name="id_modifier" value="<?=$id?>">
                <input type="hidden" name="description" value="<?=$description?>">
                <label for="nom">Nom :</label>
                <div class="zone_text">
                    <input id="nom" name="nom" type="text" value="<?=$utilisateur['NOM']?>" placeholder="Nom">
                </div>

                <label for="Prenom">Prenom :</label>
                <div class="zone_text">
                    <input id="prenom" name="prenom" type="text" value="<?=$utilisateur['PRENOM']?>" placeholder="Prenom">
                </div>

                <label for="Email">Email :</label>
                <div class="zone_text">
                    <input id="email" name="email" type="text" value="<?=$utilisateur['EMAIL']?>" placeholder="Email">
                </div>

                <label for="numero">Numéro de téléphone :</label>
                <div class="zone_text">
                    <input id="numero_de_telephone" name="numero_de_telephone" type="text" value="<?=$utilisateur['NUMERO_TELEPHONE']?>" placeholder="Numéro de téléphone">
                </div>

                <label for="mot_de_passe">Mot de passe :</label>
                <div class="zone_text">
                    <span class="voir_pass" id="voir_pass" onclick="mot_de_passe_visible()"><i class="far fa-eye fa-xs "></i></span>
                    <input id="mot_de_passe" name="mot_de_passe" type="password" value="<?=$utilisateur['MOT_DE_PASSE']?>" placeholder="Mot de passe">
                </div>

                <input type="button" id="modification_button" onclick="validation_formulaire_modification()"  value="Modifier">

            </form>
        </div>

<?php else : ?>
    <?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>