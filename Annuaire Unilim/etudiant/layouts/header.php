<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titre_de_page?></title>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/csss.css">
    <?php if(isset($to_load)) echo($to_load);?>
</head>

<body>
    <header>
        <a href="index.php" id="titre_page"><img src="logounilim.png" width=160px length="160px"> </a>
        <nav>
            <!-- on a mis ces liens au debut dans l'index de chaque session mais c'est un travail tripple pour rien 
         du coup on a penser a l'attribuer au header sachant que quelquesoit l'utilisateur(fonctionnaire/enseignant/etudiant) 
         on aura les memes options c'est a dire modifier/voir/deconnecter -->
            <ul class="nav_liens">
                <li><a href="profile.php">Voir profile</a></li>
                <li><a href="modifier.php">Modifier profile</a></li>
                <li><a href="../signinup/deconnexion.php">Se deconnecter</a></li>
            </ul>
        </nav>
    </header>