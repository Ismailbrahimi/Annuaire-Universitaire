<?php
session_start();
    /**
     * $titre_de_page est le contenu de la balise <title>
     * $to_load : les fichier a ajouter dans la balise head 
     * 
     * Voir 'layouts/header.php'
     */

    $titre_de_page = "Admin || Annuaire Unilim";
    $to_load = '<script src="./js/app.js"></script><link rel="stylesheet" href="css/csss1.css">';

    include_once("layouts/header.php");
    require_once('../db.php');
    /**
     * je recupere toutes le filieres et je les mis dans des balises option 
     * puis je les afiche dans un select avec style='visibility: hidden;, donc il sont dans le DOM,
     * mais il sont pas visible, ce select a id=filieres_var, alors dans la ligne 83 de cette page je le recupere avec javascript,
     * si l'admin souhaire ajouter un etudiant, il vas clicker sur le button radio de l'etudiant, et la fonction javascript ajouter_champs() sera  lancer,
     * et elle vas afficher le filiere (avoir 'js/app.js' ligne 64)
     */
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
    require_once('./layouts/header.php');
?>
<?php if (isset($_SESSION['ID_ADMIN'], $_SESSION['EMAIL'])) :?>

    <?php if(isset($_SESSION['ERREUR'])) : ?>
        <div id="erreurs">
            <?=$_SESSION['ERREUR']?>
            <?php unset($_SESSION['ERREUR']);?>
        </div>
    <?php endif ?>
    <div id="erreurs_form"></div>
    <form action="./includes/ajouter_utilisateur.inc.php" id="form_ajout" method="POST">
        <div class="Inscription">
            <h1 class="titre_de_page">Annuaire de l'Université de Limoges</h1>
            <h1 class="conn">Ajouter Utilisateur</h1>
            <div class="zone_text">
              <i class="fas fa-user"></i>
              <input id="nom" type="text" name="nom" placeholder="Nom">
            </div>
            <div class="zone_text">
                <i class="fas fa-user"></i>
                <input id="prenom"  type="text" name="prenom" placeholder="Prenom">
            </div>
            <div class="zone_text">
                <i class="fas fa-envelope-open"></i>
                <input id="email" type="email" name="email" placeholder="Email">
            </div>
            <div class="zone_text">
                <i class="fas fa-phone"></i>
                <input id="numero_de_telephone" type="text" name="numero_de_telephone" placeholder="Numéro de téléphone">
            </div>     
            <div class="zone_text">
              <i class="fas fa-lock"></i>
              <input id="mot_de_passe" type="password" name="mot_de_passe" placeholder="Mot de pass">
            </div>

            <div class="radio_buttons">
                <h4>Préciser votre description :</h4>
                <div class="zone_radio">
                    <input onchange="ajouter_boire('Enseignant')" type="radio" value="Enseignant" name="description" id="enseignant" checked>
                    <label for="enseignant">Enseignant</label>
                </div>
                <div class="zone_radio">
                    <input onchange="ajouter_boire('Fonctionnaire')" type="radio" value="Fonctionnaire" name="description" id="fonctionnaire">
                    <label for="fonctionnaire">Fonctionnaire</label>
                </div>
                <div class="zone_radio">
                    <input onchange="ajouter_boire('Etudiant')" type="radio" value="Etudiant" name="description" id="etudiant">
                    <label for="etudiant">Etudiant</label>
                </div>
            </div>
            <div id="boite_specifique">
                <fieldset class="pour_fonctionnaire_et_prof boite_description">
                    <legend>Enseignant</legend>
                    <div class="zone_text">
                        <i class="fas fa-key"></i>
                        <input id="ppr" type="text" name="ppr" placeholder="PPR">
                    </div>     
                </fieldset>
            </div>
            <input type="button" onclick="validation_formulaire_ajout()" name="ajout" class="btn" value="Ajouter">
          </div>
    </form>

    <script>
        filieres_var = document.getElementById('filieres_var').innerHTML;
    </script>

<?php else : ?>
    <?php header("Location:../index.php");?>
<?php endif ?>
<?php include_once("layouts/footer.php");?>