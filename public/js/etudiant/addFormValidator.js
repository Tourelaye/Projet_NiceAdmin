// Recuperation des champs du formulaire
const nomInput = document.getElementById("nom");
const prenomInput = document.getElementById("prenom");
const emailInput = document.getElementById("email");
const date_naissanceInput = document.getElementById("date_naissance");
const date_inscriptionInput = document.getElementById("date_inscription");
const frmAddEtudiant = document.getElementById("addEtudiantForm");
const btnSubmit = frmAddEtudiant.querySelector("button[type='submit']");

let isNomValid = false;
let isPrenomValid = false;
let isEmailValid = false;
let isDateNaissanceValid = false;
let isDateInscriptionValid = false;
btnSubmit.disabled = false;

//Permet d'afficher ou masquer les messages d'erreur
function showError(input, message)
{
    const baliseP = input.nextElementSibling;
    if(message){
        baliseP.textContent = message;
        input.classList.add("is-invalid");
        baliseP.style.color = "brown";
        baliseP.style.fontWeight = "bold";
    }
    else{
        baliseP.textContent = "";
        input.classList.remove("is-invalid");
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
    const nom = nomInput.value.trim();
    const nomValidator = Validator.nomValidator("Le nom", 5, 40, nom);

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
    const prenomValidator = Validator.nomValidator("Le prenom", 5, 40, prenom);

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
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 

    if (!emailPattern.test(email)) {
        showError(emailInput, "L'email est invalide.");
        isEmailValid = false;
    } else {
        showError(emailInput, "");
        isEmailValid = true;
    }

    checkFormValidity();
});

// Validation du champ date de naissance 
date_naissanceInput.addEventListener("input", () =>{
    const date_naissance = new Date(date_naissanceInput.value);
    const aujourdHui = new Date();
    const age = aujourdHui.getFullYear() - date_naissance.getFullYear();

    // Verification si l'etudiant est majeure ou pas
    if (age < 18 || (age === 18 && aujourdHui < new Date(date_naissance.setFullYear(date_naissance.getFullYear() + 18)))){
        showError(date_naissanceInput, "L'etudiant doit avoir au moins 18 ans");
        isDateNaissanceValid = false;
    } else{
        showError(date_naissanceInput, "");
        isDateNaissanceValid = true;
    }
    checkFormValidity();
})

// Fonction de validation de la date d'inscription
date_inscriptionInput.addEventListener("input", () =>{
    const date_inscription = new Date(date_inscriptionInput.value);
    const aujourdHui = new Date();

    // verifer si la date d'inscription n'est pas anterieur a aujourdhui
    if(date_inscription < aujourdHui.setHours(0, 0, 0, 0)){
        showError(date_inscriptionInput, "La date d'inscription ne peut pas etre dans le passe.");
        isDateInscriptionValid = false;
    }else{
        showError(date_inscriptionInput, "");
        isDateInscriptionValid = true;
    }
    checkFormValidity();
})

frmAddEtudiant.addEventListener("reset", () => {
    isNomValid = false;
    isPrenomValid = false;
    isEmailValid = false;
    isDateNaissanceValid = false;
    isDateInscriptionValid = false;
    btnSubmit.disabled = true;
})