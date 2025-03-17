// Recuperation des champs du formulaire
const nomInput = document.getElementById("nom");
const prenomInput = document.getElementById("prenom");
const emailInput = document.getElementById("email");
const date_naissanceInput = document.getElementById("date_naissance");
const date_inscriptionInput = document.getElementById("date_inscription");
const adresseInput = document.getElementById("adresse");
const nationaliteInput = document.getElementById("nationalite");
const matriculeInput = document.getElementById("matricule");
const sexeInput = document.getElementById("sexe");
const frmAddEtudiant = document.getElementById("addEtudiantForm");
const btnSubmit = frmAddEtudiant.querySelector("button[type='submit']");

let isNomValid = false;
let isPrenomValid = false;
let isEmailValid = false;
let isDateNaissanceValid = false;
let isDateInscriptionValid = false;
let isAdresseValid = false;
let isNationaliteValid = false;
let isMatriculeValid = false;
let isSexeValid = false;
btnSubmit.disabled = false;

//Permet d'afficher ou masquer les messages d'erreur
function showError(input, message) {
    const baliseP = input.nextElementSibling; // Sélectionne l'élément <p class="error-message"> juste après l'input

    if (baliseP && baliseP.classList.contains("error-message")) { 
        if (message) {
            baliseP.textContent = message;
            input.classList.add("is-invalid");
            baliseP.style.color = "brown";
            baliseP.style.fontWeight = "bold";
        } else {
            baliseP.textContent = "";
            input.classList.remove("is-invalid");
        }
    }
}


function checkFormValidity()
{
    if(isNomValid && isPrenomValid && isEmailValid && isDateNaissanceValid && isDateInscriptionValid){
        btnSubmit.removeAttribute("disabled");
    }
}

// Validation du champ mon a la saisie
nomInput.addEventListener("input", () => {
    console.log("Validation du nom en cours...")
    const nom = nomInput.value.trim();
    const nomValidator = Validator.nameValidator("Le nom", 5, 40, nom);

    if(nomValidator){
        showError(nomInput, nomValidator.message);
        isNomValid = false;
    }
    else{
        showError(nomInput, "");
        isNomValid = true;
    }
    checkFormValidity();
});

// Validation du champ prenom a la saisie
prenomInput.addEventListener("input", () => {
    const prenom = prenomInput.value.trim();
    const prenomValidator = Validator.nameValidator("Le prenom", 5, 40, prenom);

    if(prenomValidator){
        showError(prenomInput, prenomValidator.message);
        isPrenomValid = false;
    }
    else{
        showError(prenomInput, "");
        isPrenomValid = true;
    }
    checkFormValidity();
});

// Validation du champ email a la saisie
emailInput.addEventListener("input", () => {
    const email = emailInput.value.trim();
    const emailValidator = Validator.emailValidator("L'email", email);

    if (emailValidator) {
        showError(emailInput, emailValidator.message);
    } else {
        showError(emailInput, "");
    }

    checkFormValidity();
});

// Validation du champ date de naissance 
date_naissanceInput.addEventListener("input", () => {
    const dateNaissance = date_naissanceInput.value.trim();
    const dateValidator = Validator.dateNaissanceValidator("Date de naissance", dateNaissance);

    if (dateValidator) {
        showError(date_naissanceInput, dateValidator.message);
    } else {
        showError(date_naissanceInput, "");
    }

    checkFormValidity();
});


// Fonction de validation de la date d'inscription
date_inscriptionInput.addEventListener("input", () => {
    const dateInscription = date_inscriptionInput.value.trim();
    const dateValidator = Validator.dateInscriptionValidator("Date d'inscription", dateInscription);

    if (dateValidator) {
        showError(date_inscriptionInput, dateValidator.message);
    } else {
        showError(date_inscriptionInput, "");
    }

    checkFormValidity();
});


// Fonction pour valider l'adresse
adresseInput.addEventListener("input", () => {
    const adresse = adresseInput.value.trim();
    const adresseValidator = Validator.adresseValidator(adresse, {min : 5 });

    if(!adresseValidator){
        showError(adresseInput, "L'adresse doit contenir au moins 5 carateres.");
    } else{
        showError(adresseInput);
    }
});

// Fonction pour valider la nationalite
nationaliteInput.addEventListener("input", () => {
    const nationalite = nationaliteInput.value.trim();

    // Verifier si la nationalite contient uniquement des lettres et au moins 3 caracteres
    const nationaliteValidator = validator.isAlpha(nationalite, "fr-FR", {ignore: " -"}) && Validator.isLength(nationalite, {min: 3});
    
    if(!nationaliteValidator){
        showError(nationaliteInput, "La nationalite doit contenir au moins 3 lettres et ne doit pas inclure de chiffes.");
    } else{
        showError(nationaliteInput);
    }
});

frmAddEtudiant.addEventListener("reset", () => {
    isNomValid = false;
    isPrenomValid = false;
    isEmailValid = false;
    isDateNaissanceValid = false;
    isDateInscriptionValid = false;
    isAdresseValid = false;
    isNationaliteValid = false;
    isMatriculeValid = false;
    isSexeValid = false;
    btnSubmit.disabled = true;
})