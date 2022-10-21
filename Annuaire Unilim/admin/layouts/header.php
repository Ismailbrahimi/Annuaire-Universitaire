<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$titre_de_page?></title>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/css.css"> 
    <?php if(isset($to_load)) echo($to_load);?>
</head>

<body>
    <header>
        <a href="index.php" id="titre_page"> <img src="logounilim.png" width=160px length="160px"></a>
        <nav>
            <ul class="nav_liens">
                <li><a href="utilisateurs.php">Utilisateurs</a></li>
                <li><a href="filieres.php">Filière</a></li>
                <li><a href="modifier_admin.php">Modifier profile</a></li>
                <li><a href="../signinup/deconnexion.php">Se deconnecter</a></li>
            </ul>
        </nav>
       
    </header>