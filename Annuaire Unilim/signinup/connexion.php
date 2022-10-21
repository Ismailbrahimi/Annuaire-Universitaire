<!-- création d'une session -->
<?php
session_start();
    $titre_de_page = "Page de connexion | Annuaire Unilim";
    $fichier_css = "css/conncss.css";
    require_once('./layouts/header.php');
?>
 <!-------------------------------------------------------------------------------------------------------------------------->

<?php if (!isset($_SESSION['ID'])) :?> <!-- si la session est definie -->
  <?php if(isset($_SESSION['ERREUR'])) : ?> <!-- si il y a une erreur affichage d'un background rouge pour resaisir -->
    <div id="erreurs">
      <?=$_SESSION['ERREUR']?> <!-- on retourne l'erreur -->
      <?php unset($_SESSION['ERREUR']);?>  <!-- destruction de la session d'erreur-->
    </div>
<?php endif ?>
<div id="erreurs_form"></div>

<!-------------------------------------------------------------------------------------------------------------------------->
<script>
(function(w, d) {
   w.CollectId = "633bfd236405a40542b4257f";
 var h = d.head || d.getElementsByTagName("head")[0];
  var s = d.createElement("script");
   s.setAttribute("type", "text/javascript");
    s.async=true; s.setAttribute("src", "https://collectcdn.com/launcher.js"); 
  h.appendChild(s); })(window, document);
  
  </script>
  <form action="./includes/connexion.inc.php" id="form_connexion" method="POST"> <!-- appel du fichier connexion.inc.php qui va executer la fonction de validation du form -->
    <div class="connexion">
      <h1 class="titre_de_page">Annuaire de l'Université de Limoges</h1><img src="logo.png" width="50px" length="50px">
      <h1 class="conn">Connexion</h1>
      <div class="zone_text">
        <i class="fas fa-user"></i> <!-- icone pour email-->
        <input id="email" name="email" type="text" placeholder="Email"> <!-- espace d'authentification par email -->
      </div>
    
      <div class="zone_text">
        <i class="fas fa-lock"></i><!-- icone pour mdp-->
        <input id="mot_de_passe" name="mot_de_passe" type="password" placeholder="Mot de pass"> <!-- espace du mot de passe -->
      </div>
    
      <input type="button" onclick="validation_formulaire_connexion()" class="btn" value="Se connecter"><!-- on clique on va executer la fonction validation_formulaire_connexion() -->
      <a href="./inscription.php" class="inscription">S'inscrire</a> <!-- redirection vers le formulaire d'inscription-->
    </div>
  </form>

<?php else : ?>
  <?php 
      header("Location:../index.php"); // else redirection vers l'authentification index
    ?>
<?php endif ?>


<?php 
    require_once('./layouts/footer.php'); //inclusion du footer dans layouts
?>