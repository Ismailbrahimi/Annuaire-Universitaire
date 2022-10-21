<?php 
session_start();
    $to_load = '<script src="./js/app.js"></script>';
    $titre_de_page = "Fonctionnaire || Annuaire Unilim";
    include_once("layouts/header.php"); //inclusion du header pour attribuer le .css et le header pour modifier/voir/deconnecter du profile 

    require_once('../db.php');
    //pour la recherche d'un etudiant on a ajouter l'option filiere parmis les selecteurs
    //du coup on a fait appelle au element de filiere
    $filiere_query = "SELECT * FROM filiere";
    $result_filiare = mysqli_query($connexion, $filiere_query);
    $filieres = '';
    while($ligne_filiere = mysqli_fetch_assoc($result_filiare)) {
        $filiere_id = $ligne_filiere['ID_FILIERE'];
        $filiere_nom = $ligne_filiere['ABREVIATION_FILIERE'];
        $filieres .= "<option value='$filiere_id'>$filiere_nom</option>";
    }
    //on va appeller ce script html vers la balise select pour la recherche etudiant avec le innerHTML
    $select = "<select id='filieres_var' style='visibility: hidden;'>\n$filieres\n</select>";
    echo "$select";
    mysqli_close($connexion);

?>

<!-- PS : on a fait la meme chose avec les autres options de select (PPR et CNE) => innerHTML-->

<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<?php if (isset($_GET['recherche'], $_SESSION['ID'], $_SESSION['DESCRIPTION']) && ($_SESSION['DESCRIPTION'] =="fonctionnaire" || $_SESSION['DESCRIPTION'] =="enseignant")) :?>
    <!--Rappelle : actif = 1 et non actif = 0 -->
    <?php if($_SESSION['COMPTE_ACTIVE'] == 1) : ?>
        <div class="recherche">
            <div class="boite_titre">Recherche</div>
<!-- POUR NE pas faire un travail double on a creer la boite de recherche directe du fonctionnaire/enseignant et etudiant en meme temps 
     on a travailler avec onchange encore qui va changer la liste deroulante selon la description de recherche-->
            <h4 style="text-align: center;">Avec quoi vous voullez effectuer la recherche</h4>
            <!---->
            <select name="" id="choix" onchange="ajouter_champs(this)">
                <option value="">---- Choisir un nouveau champ ----</option>
                <option value="nom">Nom</option>
                <option value="prenom">Prenom</option>
                <?php if($_GET['recherche']=='fonctionnaire' || $_GET['recherche']=='enseignant') :?>
                    <option value="PPR">PPR</option>
                <?php else : ?>
                    <option value="filieres">Filiere</option> <!-- selection de la table deja faite -->
                    <option value="CNE">CNE</option>
                <?php endif ?>
            </select>
            <form action="resultats.php" id="formulaire_recherche" method="POST">
                <div id="champs_de_recherche"></div>
                <input type="hidden" name="recherche" value="<?=$_GET['recherche']?>">
                <input type="hidden" name="recherche_button"> <!-- on la declarer hidden pour que ca affiche lorsque on fait la saisie dans les champs d'abord-->
                <!-- on va envoyer un alert si les champs sont vide par verifier_vide() si c'est !=0 on fait un submit simple dans resultat.php-->
                <input type="button" onclick="verifier_vide(document.getElementById('formulaire_recherche'))" id="recherche_button" value="Rechercher">
            </form>

<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
            <script>
                filieres_var = document.getElementById('filieres_var').innerHTML;
            </script>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------->
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