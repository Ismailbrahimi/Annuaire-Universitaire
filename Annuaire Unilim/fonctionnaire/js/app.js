champs_visible = [] // on a creer un tableau qui va represente les champs de visibilite de l'element avec quoi on va rechercher
// on va dabord voir si le tableau contient la valeur choisi avec .includes()  puis on push

// 
nom_prenom_regex = /^([a-zA-Z -]){2,150}$/;
email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
numero_de_telephone_regex = /^0(5|6|7)([0-9]){8}$/;
mot_de_passe_regex = /^([\s\d\w\W]){5,255}$/;

nombre_de_champs = 0; // represente le champs ou on va saisir la recherche => initier a 0;
// on la ajouter generalement pour checker si la saisie est faite ou non pour qu'on envoie un alert de saisie

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const supprimer_imput = (element) => {

    //on va filtrer le tableau avec la methode .filter() selon la condition que le champs visible sera celui
    //affecter a l'attribut for 
    // cad si on choisi 'nom' on choisis que le input ou on a for="nom"
    // puis on retire l'element 
    element.parentElement.remove();
    champs_visible = champs_visible.filter(e => e !== element.getAttribute('for')); 
    nombre_de_champs--;
}


const ajouter_champs = (choix) => {
    //deux variables une pour l'element de recherche choisie (champ_a_ajouter) et l'autre pour juste afficher le placeholder (champs_de_recherche)
    let champ_a_ajouter = choix.options[choix.selectedIndex].value; // on a initier l'element de recherche a 0
    choix.selectedIndex = 0;
    let champs_de_recherche = document.getElementById('champs_de_recherche'); 
    nombre_de_champs++; // on incremente apres la saisie 
    if(champ_a_ajouter == 'nom' && !champs_visible.includes('nom'))
    {
        champs_visible.push('nom')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="nom" onclick="supprimer_imput(this)">&times;</span>
            <input required id="nom" name="nom" type="text" placeholder="Nom">
        </div>
        `;
    }
    else if(champ_a_ajouter == 'prenom' && !champs_visible.includes('prenom'))
    {
        champs_visible.push('prenom')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="prenom" onclick="supprimer_imput(this)">&times;</span>
            <input required id="prenom" name="prenom" type="text" placeholder="Prenom">
        </div>
        `;
    }
    else if(champ_a_ajouter == 'PPR' && !champs_visible.includes('PPR'))
    {
        champs_visible.push('PPR')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="PPR" onclick="supprimer_imput(this)">&times;</span>
            <input required id="PPR" name="PPR" type="text" placeholder="PPR">
        </div>
        `;
    } 
    else if(champ_a_ajouter == 'CNE' && !champs_visible.includes('CNE'))
    {
        champs_visible.push('CNE')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="CNE" onclick="supprimer_imput(this)">&times;</span>
            <input required id="CNE" name="CNE" type="text" placeholder="CNE">
        </div>
        `;
    }
    else if(champ_a_ajouter == 'filieres' && !champs_visible.includes('filieres'))
    {
        champs_visible.push('filieres')
        champs_de_recherche.innerHTML += `
        <div class="zone_select">
            <span class="closebtn" for="filieres" id="closebtn_select" onclick="supprimer_imput(this)">&times;</span>

            <select name="filiere" id="filieres">
                ${filieres_var}
            </select>
        </div>
        `;
    }
    else if(champ_a_ajouter == 'numero' && !champs_visible.includes('numero'))
    {
        champs_visible.push('numero')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="numero" onclick="supprimer_imput(this)">&times;</span>
            <input required id="numero" name="numero" type="text" placeholder="Numéro de téléphone">
        </div>
        `;
    }
    else if(champ_a_ajouter == 'email' && !champs_visible.includes('email'))
    {
        champs_visible.push('email')
        champs_de_recherche.innerHTML += `
        <div class="zone_text">
            <span class="closebtn" for="email" onclick="supprimer_imput(this)">&times;</span>
            <input required id="email" name="email" type="text" placeholder="Adresse email">
        </div>
        `;
    }

}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
    if(!valide) 
    {
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
        document.getElementById('modifier_form').submit();
    }   
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Pour afficher le mot de passe avec just un onclick sur le logo specifier sachant que le mdp sera initialement masque
// car il est de type input="password"
const mot_de_passe_visible = () => {
    let champs = document.getElementById('mot_de_passe').type;
    let type = champs == 'text' ? 'password' : 'text';
    document.getElementById('mot_de_passe').type = type;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//verification si le formulaire est vide
const verifier_vide = (formulaire) => {
    if(nombre_de_champs != 0){
        formulaire.submit();
    }else
        alert("veuillez choisir au moins un champs");
}