// Récupération des champs du formulaire
const etudiant_idInput = document.getElementById("etudiant_id");
const nomInput = document.getElementById("nom");
const semestreInput = document.getElementById("semestre");
const type_evaluationInput = document.getElementById("type_evaluation");
const frmAddEvaluation = document.getElementById("addEvaluationForm");
const btnSubmit = frmAddEvaluation.querySelector("button[type='submit']");

let isetudiant_idValid = false;
let issemestreValid = false;
let isnomValid = false;
let istype_evaluationValid = false;

btnSubmit.disabled = true;

function showError(input, message) {
    const baliseP = input.nextElementSibling;
    if (message) {
        baliseP.textContent = message;
        input.classList.add("is-invalid");
    } else {
        baliseP.textContent = "";
        input.classList.remove("is-invalid");
    }
}

function checkFormValidity() {
    if (isetudiant_idValid && issemestreValid && isnomValid && istype_evaluationValid) {
        btnSubmit.disabled = false;
    } else {
        btnSubmit.disabled = true;
    }
}

// Validation du nom de l'évaluation
nomInput.addEventListener("input", () => {
    const nom = nomInput.value.trim();
    const nomValidator = nom.length >= 3 && nom.length <= 40 ? null : { message: "Le nom de l'évaluation doit contenir entre 3 et 40 caractères." };

    if (nomValidator) {
        showError(nomInput, nomValidator.message);
        isnomValid = false;
    } else {
        showError(nomInput, "");
        isnomValid = true;
    }
    checkFormValidity();
});

// Validation du semestre
semestreInput.addEventListener("change", () => {
    const semestre = semestreInput.value;
    const semestreValidator = semestre === "1" || semestre === "2" ? null : { message: "Veuillez choisir le semestre 1 ou 2." };

    if (semestreValidator) {
        showError(semestreInput, semestreValidator.message);
        issemestreValid = false;
    } else {
        showError(semestreInput, "");
        issemestreValid = true;
    }
    checkFormValidity();
});

// Validation du type d'évaluation
type_evaluationInput.addEventListener("change", () => {
    const type = type_evaluationInput.value.toLowerCase();
    const typesValides = ["devoir", "examen"];
    const typeValidator = typesValides.includes(type) ? null : { message: "Type d'évaluation invalide." };

    if (typeValidator) {
        showError(type_evaluationInput, typeValidator.message);
        istype_evaluationValid = false;
    } else {
        showError(type_evaluationInput, "");
        istype_evaluationValid = true;
    }
    checkFormValidity();
});

// Validation de letudiant_id
etudiant_idInput.addEventListener("input", () => {
    const etudiant_id = parseFloat(etudiant_idInput.value);
    const etudiant_idValidator = !isNaN(etudiant_id) && etudiant_id >= 1 && etudiant_id <= 10 ? null : { message: "Le etudiant_id doit être un nombre entre 0 et 10." };

    if (etudiant_idValidator) {
        showError(etudiant_idInput, etudiant_idValidator.message);
        isetudiant_idValid = false;
    } else {
        showError(etudiant_idInput, "");
        isetudiant_idValid = true;
    }
    checkFormValidity();
});

// Réinitialisation du formulaire
frmAddEvaluation.addEventListener("reset", () => {
    isnomValid = false;
    issemestreValid = false;
    istype_evaluationValid = false;
    isetudiant_idValid = false;
    btnSubmit.disabled = true;
});
