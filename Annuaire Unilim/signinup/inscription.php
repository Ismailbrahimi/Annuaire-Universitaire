<!-- création d'une session -->
<?php 
session_start();
/*
  @titte_de_page : le titre dans la balise title qui se trouve dans le fichier ./layouts/header.php
  @fichier_css : inscription.php et connexion.php n'on pas le meme fichier css, donc je le passe d'une façons dynamique
*/
    $titre_de_page = "Page d'inscription | Annuaire Unilim";
    $fichier_css = "css/inscss.css";
    
    require_once('../db.php'); //appel de la bdd
    // Pour l'inscription autant que etudiant il faut preciser quelle filiere appartient il cet etudiant du coup on doit ajouter 
    //  une requete de selection de la table filiere dans le cas ou on choisi dans les radio etudiant

    $filiere_query = "SELECT * FROM filiere";
    $result_filiare = mysqli_query($connexion, $filiere_query);
    $filieres = '';
    while($ligne_filiere = mysqli_fetch_assoc($result_filiare)) {
        $filiere_id = $ligne_filiere['ID_FILIERE'];
        $filiere_nom = $ligne_filiere['ABREVIATION_FILIERE'];
        $filieres .= "<option value='$filiere_id'>$filiere_nom</option>";
    }
    // on va afficher la script html de selection des filieres avec le innerhtml en l'appelant avec son id
    $select = "<select id='filieres_var' style='visibility: hidden;'>\n$filieres\n</select>";
    echo "$select";
    require_once('./layouts/header.php');
?>

<!-- Lancement de l'erreur dans le cas ou on entre une variable incompatible aux elements de la table dans la bdd-->
<?php if (!isset($_SESSION['ID'])) :?>
    <?php if(isset($_SESSION['ERREUR'])) : ?>
        <div id="erreurs">
        <?=$_SESSION['ERREUR']?>
        <?php unset($_SESSION['ERREUR']);?>
        </div>
<?php endif ?>
<div id="erreurs_form"></div>
   
<!--formulaire d'inscription-->
<form action="./includes/inscription.inc.php" id="form_inscription" method="POST"> <!-- redirection vers inscription.inc.php pour appliquer la fonction validation_formulaire_inscription()-->
        <div class="Inscription">
            <h1 class="titre_de_page">Annuaire de l'Université de Limoges</h1>
            <!--on precise encore que les icones sont importes par "https://use.fontawesome.com/releases/v5.5.0/css/all.css"-->
            <h1 class="conn">Inscription</h1>
            <div class="zone_text">
              <i class="fas fa-user"></i> <!--icone pour le nom-->
              <input id="nom" type="text" name="nom" placeholder="Nom">
            </div>
            <div class="zone_text">
                <i class="fas fa-user"></i> <!--icone pour le prenom-->
                <input id="prenom"  type="text" name="prenom" placeholder="Prenom">
            </div>
            <div class="zone_text">
                <i class="fas fa-envelope-open"></i><!--icone pour l'email-->
                <input id="email" type="email" name="email" placeholder="Email">
            </div>
            <div class="zone_text">
                <i class="fas fa-phone"></i> <!--icone pour le numero de tel-->
                <input id="numero_de_telephone" type="text" name="numero_de_telephone" placeholder="Numéro de téléphone">
            </div>     
            <div class="zone_text">
              <i class="fas fa-lock"></i><!--icone pour le mdp-->
              <input id="mot_de_passe" type="password" name="mot_de_passe" placeholder="Mot de pass">
            </div>

            <div class="radio_buttons">
                <h4>Préciser votre description :</h4>
                <div class="zone_radio">
                    <!-- on l'a mis sur on change car on aura besoin de selection de la filiere comme on a dis precedement -->
                    <!-- on a definie une fonction ajouter_boire en js qui va nous permettre de differencier l'affichage entre enseignant/fonctionnaire/etudiants-->
                   <!--  elle va contenir deux variables contenant chacuns son affichage html et on va travailler avec le inner html -->
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
                <!--on a separer lale fonctionnaire et le prof de l'etudiant -->
                <fieldset class="pour_fonctionnaire_et_prof boite_description">
                    <legend>Enseignant</legend> <!-- comme on va voir dans je .js on a donner comme affichage par defaut au enseignant-->
                    <div class="zone_text">
                        <i class="fas fa-key"></i><!--icone pour le ppr-->
                        <input id="ppr" type="text" name="ppr" placeholder="PPR">
                    </div>     
                </fieldset>
            </div>
            <input type="button" onclick="validation_formulaire_inscription()" name="inscription_valide" class="btn" value="S'inscrire">
            <a href="./connexion.php" class="connexion">Se connecter</a> <!--pour acceder a la connexion directe-->
          </div>
</form>
 
    <script>
        filieres_var = document.getElementById('filieres_var').innerHTML;  //appelle du script html du la selection des filieres 
    </script>
    <?php else : ?>
    <?php 
        header("Location:../index.php");
        ?>
    <?php endif ?>
<?php 
    require_once('./layouts/footer.php');
?>