<?php 
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Admin || Annuaire Unilim";
    include_once("layouts/header.php");

    require_once('../db.php');
    $filiere_query = "SELECT * FROM filiere";
    $result_filiare = mysqli_query($connexion, $filiere_query);
    $filieres = '';
    while($ligne_filiere = mysqli_fetch_assoc($result_filiare)) {
        $filiere_id = $ligne_filiere['ID_FILIERE'];
        $filiere_nom = $ligne_filiere['ABREVIATION_FILIERE'];
        $filieres .= "<option value='$filiere_id'>$filiere_nom</option>";
    }
    $select = "<select id='filieres_var' style='visibility: hidden;'>\n$filieres\n</select>";
    echo "$select";
    mysqli_close($connexion);

?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'])) :?>

        <div class="recherche">
            <div class="boite_titre">Recherche</div>
            <h4 style="text-align: center;">Avec quoi vous voullez effectuer la recherche</h4>
            <select name="" id="choix" onchange="ajouter_champs(this)">
                <option value="">---- Choisir un nouveau champ ----</option>
                <option value="nom">Nom</option>
                <option value="prenom">Prenom</option>
                <?php if($_GET['recherche']=='fonctionnaire' || $_GET['recherche']=='enseignant') :?>
                    <option value="PPR">PPR</option>
                <?php else : ?>
                    <option value="filieres">Filiere</option>
                    <option value="CNE">CNE</option>
                <?php endif ?>
            </select>
            <form action="resultats.php" id="formulaire_recherche" method="POST">
                <div id="champs_de_recherche"></div>
                <input type="hidden" name="recherche" value="<?=$_GET['recherche']?>">
                <input type="hidden" name="recherche_button">
                <input type="button" onclick="verifier_vide(document.getElementById('formulaire_recherche'))" id="recherche_button" value="Rechercher">
            </form>

            <script>
                filieres_var = document.getElementById('filieres_var').innerHTML;
            </script>

        </div>
        
<?php else : ?>
    <?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>