
description_courante = "Enseignant"; // par defaut on initialise la description par enseignant

nom_prenom_regex = /^([a-zA-Z -]){2,150}$/;
email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
numero_de_telephone_regex = /^0(5|6|7)([0-9]){8}$/;
mot_de_passe_regex = /^([\s\d\w\W]){5,255}$/;
cne_regex = /^[A-Za-z]([0-9]){9}$/;
ppr_regex = /^([0-9]){5,9}$/;


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const ajouter_boire = (description) => {
    description_courante = description;
// affectation de chaque variable un affichage pour ne pas confonder entre l'inscription des enseignants/fonctionnaire et etudiants
    let pour_fonctionnaire_et_prof = ` 
    <fieldset class="pour_fonctionnaire_et_prof boite_description">
    <legend>${description}</legend>
        <div class="zone_text">
            <i class="fas fa-key"></i>
            <input id="ppr" type="text" name="ppr" placeholder="PPR">
        </div>     
    </fieldset>
    `;
    let pour_etudiant = `
        <fieldset class="pour_etudiant boite_description">
            <legend>Etudiant</legend>
                <div class="zone_text">
                    <i class="fas fa-key"></i>
                    <input id="cne" type="text" name="cne" placeholder="CNE">
                </div>     
                <div class="zone_text">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <select name="filiere" id="hello"> 
                        ${filieres_var}  
                    </select>
                </div>   
        </fieldset>
    `;
    if (description == "Fonctionnaire" || description ==  "Enseignant")
    //on a utiliser innerHTML pour retourner l'affichage HTML de l'element description sachant qu'il change en changeant d'utilisateur.
        document.getElementById('boite_specifique').innerHTML = pour_fonctionnaire_et_prof; 
    else
    document.getElementById('boite_specifique').innerHTML = pour_etudiant;

}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// la validation de l'inscription

const validation_formulaire_inscription = () => {
    erreurs = [];
    //l'envoie des erreurs est fait sous forme d'une liste qu'on va stocker dans un tableau pour que si il existe plus d'une erreur on aura pas un conflits d'affichage d'erreurs
    valide = true; // si valide est true donc il n'existe pas un erreur ainsi qu'on envoie pas le message d'erreur
    //affecter les valeurs des elements depuis le formulaire par ID
    nom = document.getElementById('nom').value;
    prenom = document.getElementById('prenom').value;
    email = document.getElementById('email').value;
    numero_de_telephone = document.getElementById('numero_de_telephone').value;
    mot_de_passe = document.getElementById('mot_de_passe').value;

    
    if(!nom_prenom_regex.test(nom)) //on a utiliser la methode test() pour vérifier s'il y a une correspondance entre nom et nom_prenom_regex.
    //  Elle retourne true en cas de succès et false dans le cas contraire
    {
        valide = false; 
        //envoie d'erreur dans le tableau
        erreurs.push('<li>Le nom doit contenir entre 2 et 150 caractères</li>') 
        // on a travailler avec la methode .push pour ajouter une ou plusieurs erreurs à la fin du tableau erreurs et retourner la nouvelle taille du tableau.
    }

    if(!nom_prenom_regex.test(prenom))
    {
        valide = false;
        //envoie d'erreur dans le tableau
        erreurs.push('<li>Le prenom doit contenir entre 2 et 150 caractères</li>')
    }

    if(!email_regex.test(email))
    {
        valide = false;
        //envoie d'erreur dans le tableau
        erreurs.push('<li>Votre adresse email est invalide</li>')
    }

    if(!numero_de_telephone_regex.test(numero_de_telephone))
    {
        valide = false;//envoie d'erreur dans le tableau
        erreurs.push('<li>Le numero doit s\'ecrire sous la forme 0XXXXXXXXX</li>')
    }

    if(!mot_de_passe_regex.test(mot_de_passe))
    {
        valide = false;
        //envoie d'erreur dans le tableau
        erreurs.push('<li>Le mot de passe peut contenir entre cinq et 255 Caractères</li>')
    }
    if (description_courante == "Fonctionnaire" || description_courante == "Enseignant" )
    {
        ppr = document.getElementById('ppr').value;
        if(!ppr_regex.test(ppr))
        {
            valide = false;
            //envoie d'erreur dans le tableau
            erreurs.push('<li>Le PPR contient entre cinq et neuf nombres</li>')
        }
    }
    else 
    {
        cne = document.getElementById('cne').value;
        if(!cne_regex.test(cne))
        {
            valide = false;
            //envoie d'erreur dans le tableau 
            erreurs.push('<li>Le CNE commence par une lettre suivi de neuf nombres</li>')
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if(!valide) 
    {
        //dans le cas ou l'inscription n'est pas validee on va faire appelle au erreurs dans le tableau erreurs
        //avec le innerhtml et utilisant la methode join() qui va créer et renvoyer une nouvelle chaîne d'erreurs 
        //en concaténant tous les éléments apres un saut de ligne
        console.log("Hello"); 
        
        document.getElementById('erreurs_form').innerHTML = `
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <ol>
                ${erreurs.join('<br>')}
            </ol>
        </div>`;
    }
    else
    {
        //validation de l'inscription avec la methode submit pour soumettre le formulaire dans la bdd
        document.getElementById('form_inscription').submit();   
    }
        
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// meme chose pour la connexion 

const validation_formulaire_connexion = () => {
    erreurs = []; //meme chose pour la connexion que l'inscription
    valide = true;
    email = document.getElementById('email').value;
    mot_de_passe = document.getElementById('mot_de_passe').value;
    if(!email_regex.test(email)){
        valide = false;
        erreurs.push('<li>Votre adresse email est invalide</li>')
    }
    if(!mot_de_passe_regex.test(mot_de_passe)){
        valide = false;
        erreurs.push('<li>Le mot de passe peut contenir entre cinq et 255 Caractères</li>')
    }

    
    if(!valide) {

        document.getElementById('erreurs_form').innerHTML = `
        <div class="alert">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <ol>
                ${erreurs.join('<br>')}
            </ol>
        </div>`;
    }else{
        document.getElementById('form_connexion').submit();
    }
}

