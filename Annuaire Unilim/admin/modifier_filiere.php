<?php 
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Admin || Annuaire Unilim";
    include_once("layouts/header.php");
    require_once("../db.php");
    if(isset($_GET['id_modifier'])){
        $id = $_GET['id_modifier'];
        $filiere_query = "SELECT * FROM filiere WHERE ID_FILIERE=$id;";
        
        $resultats = mysqli_query($connexion, $filiere_query);
        $row_count = mysqli_num_rows($resultats);
        $filiere = mysqli_fetch_assoc($resultats);
        mysqli_close($connexion);
        if($row_count == 0){
            header("Location:filieres.php");
        }
    }
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'], $_GET['id_modifier'])) :?>

        <div id="erreurs_form"></div>
        <div class="modification" style="margin-bottom:50px;">
            <div class="boite_titre">Modification du profile</div>
            <form action="./includes/modifier_filiere.inc.php" id="modifier_form" method="POST">
                <input type="hidden" name="id_modifier" value="<?=$id?>">

                <label for="abreviation">Abréviation Filière :</label>
                <div class="zone_text">
                    <input required id="abreviation" name="abreviation" type="text" value="<?=$filiere['ABREVIATION_FILIERE']?>" placeholder="Abréviation Filière">
                </div>

                <label for="label">Label Filière :</label>
                <div class="zone_text">
                    <input required id="label" name="label" type="text" value="<?=$filiere['LABEL_FILIERE']?>" placeholder="Label Filière">
                </div>

                <input type="submit" id="modification_button"  value="Modifier">

            </form>
        </div>

<?php else : ?>
    <?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>