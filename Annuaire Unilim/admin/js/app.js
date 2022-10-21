champs_visible = []
description_courante = "Enseignant";
nom_prenom_regex = /^([a-zA-Z -]){2,150}$/;
email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
numero_de_telephone_regex = /^0(5|6|7)([0-9]){8}$/;
mot_de_passe_regex = /^([\s\d\w\W]){5,255}$/;
cne_regex = /^[A-Za-z]([0-9]){9}$/;
ppr_regex = /^([0-9]){5,9}$/;

nombre_de_champs = 0;

const supprimer_imput = (element) => {
    element.parentElement.remove();
    champs_visible = champs_visible.filter(e => e !== element.getAttribute('for'));
    nombre_de_champs--;
}



const ajouter_champs = (choix) => {
    let champ_a_ajouter = choix.options[choix.selectedIndex].value;
    choix.selectedIndex = 0;
    let champs_de_recherche = document.getElementById('champs_de_recherche');
    nombre_de_champs++;
    if(champ_a_ajouter == 'nom' && !champs_visible.includes('nom')){
        champs_visible.push('nom')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="nom" onclick="supprimer_imput(this)">&times;</span>
            <input required id="nom" name="nom" type="text" placeholder="Nom">
        </div>
        `;
    } else if(champ_a_ajouter == 'prenom' && !champs_visible.includes('prenom')){
        champs_visible.push('prenom')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="prenom" onclick="supprimer_imput(this)">&times;</span>
            <input required id="prenom" name="prenom" type="text" placeholder="Prenom">
        </div>
        `;
    }else if(champ_a_ajouter == 'PPR' && !champs_visible.includes('PPR')){
        champs_visible.push('PPR')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="PPR" onclick="supprimer_imput(this)">&times;</span>
            <input required id="PPR" name="PPR" type="text" placeholder="PPR">
        </div>
        `;
    } else if(champ_a_ajouter == 'CNE' && !champs_visible.includes('CNE')){
        champs_visible.push('CNE')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="CNE" onclick="supprimer_imput(this)">&times;</span>
            <input required id="CNE" name="CNE" type="text" placeholder="CNE">
        </div>
        `;
    }else if(champ_a_ajouter == 'filieres' && !champs_visible.includes('filieres')){
        champs_visible.push('filieres')
        champs_de_recherche.innerHTML += `
        <div class="zone_select">
            <span class="closebtn" for="filieres" id="closebtn_select" onclick="supprimer_imput(this)">&times;</span>

            <select name="filiere" id="filieres">
                ${filieres_var}
            </select>
        </div>
        `;
    }else if(champ_a_ajouter == 'numero' && !champs_visible.includes('numero')){
        champs_visible.push('numero')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="numero" onclick="supprimer_imput(this)">&times;</span>
            <input required id="numero" name="numero" type="text" placeholder="Numéro de téléphone">
        </div>
        `;
    }else if(champ_a_ajouter == 'email' && !champs_visible.includes('email')){
        champs_visible.push('email')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="email" onclick="supprimer_imput(this)">&times;</span>
            <input required id="email" name="email" type="text" placeholder="Adresse email">
        </div>
        `;
    }

}

const ajouter_boire = (description) => {
    description_courante = description;

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
        document.getElementById('boite_specifique').innerHTML = pour_fonctionnaire_et_prof;
    else
    document.getElementById('boite_specifique').innerHTML = pour_etudiant;

}

const validation_formulaire_modification = () => {
    erreurs = [];
    valide = true;
    nom = document.getElementById('nom').value;
    prenom = document.getElementById('prenom').value;
    email = document.getElementById('email').value;
    numero_de_telephone = document.getElementById('numero_de_telephone').value;
    mot_de_passe = document.getElementById('mot_de_passe').value;
    
    if(!nom_prenom_regex.test(nom)){
        valide = false;
        erreurs.push('<li>Le nom doit contenir entre 2 et 150 caractères</li>')
    }

    if(!nom_prenom_regex.test(prenom)){
        valide = false;
        erreurs.push('<li>Le prenom doit contenir entre 2 et 150 caractères</li>')
    }

    if(!email_regex.test(email)){
        valide = false;
        erreurs.push('<li>Votre adresse email est invalide</li>')
    }

    if(!numero_de_telephone_regex.test(numero_de_telephone)){
        valide = false;
        erreurs.push('<li>Le numero doit s\'ecrire sous la forme 0XXXXXXXXX</li>')
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
    }else {
        document.getElementById('modifier_form').submit();
    }
        
}

const validation_formulaire_ajout = () => {
    erreurs = [];
    valide = true;
    nom = document.getElementById('nom').value;
    prenom = document.getElementById('prenom').value;
    email = document.getElementById('email').value;
    numero_de_telephone = document.getElementById('numero_de_telephone').value;
    mot_de_passe = document.getElementById('mot_de_passe').value;

    
    if(!nom_prenom_regex.test(nom)){
        valide = false;
        erreurs.push('<li>Le nom doit contenir entre 2 et 150 caractères</li>')
    }

    if(!nom_prenom_regex.test(prenom)){
        valide = false;
        erreurs.push('<li>Le prenom doit contenir entre 2 et 150 caractères</li>')
    }

    if(!email_regex.test(email)){
        valide = false;
        erreurs.push('<li>Votre adresse email est invalide</li>')
    }

    if(!numero_de_telephone_regex.test(numero_de_telephone)){
        valide = false;
        erreurs.push('<li>Le numero doit s\'ecrire sous la forme 0XXXXXXXXX</li>')
    }

    if(!mot_de_passe_regex.test(mot_de_passe)){
        valide = false;
        erreurs.push('<li>Le mot de passe peut contenir entre cinq et 255 Caractères</li>')
    }
    if (description_courante == "Fonctionnaire" || description_courante == "Enseignant" ){
        ppr = document.getElementById('ppr').value;
        if(!ppr_regex.test(ppr)){
            valide = false;
            erreurs.push('<li>Le PPR contient entre cinq et neuf nombres</li>')
        }
    }else {
        cne = document.getElementById('cne').value;
        if(!cne_regex.test(cne)){
            valide = false;
            erreurs.push('<li>Le CNE commence par une lettre suivi de neuf nombres</li>')
        }
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
        document.getElementById('form_ajout').submit();
    }
        
}

const mot_de_passe_visible = () => {
    let champs = document.getElementById('mot_de_passe').type;
    let type = champs == 'text' ? 'password' : 'text';
    document.getElementById('mot_de_passe').type = type;
}

const verifier_vide = (formulaire, event) => {
    console.log(event);
    if(nombre_de_champs != 0){
        formulaire.submit();
    }else
        alert("veuillez choisir au moins un champs");
}

const supprimer_element = (lien) => {
    if(window.confirm("etes vous sur de vouloir supprimer cet element ?"))
        open(lien, "_top")
    
}