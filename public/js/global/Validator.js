class Validator
{
    //Permet de valider un mot de passe
    static passwordValidator(controlName, value, lengthWord)
    {
        return !value.length
            ? { error: true, message: `${controlName} est obligatoire.` }
            : value.length < lengthWord
            ? { error: true, message: `${controlName} doit contenir au moins ${lengthWord} caractères.` }
            : ((value != "") && (value.startsWith(" ") || value.endsWith(" ")))
            ? { error: true, message: `Les espaces de début et de fin ne sont pas autorisés.` }
            : null;
    }

    //Permet de valider une adresse email
    static emailValidator(controlName, value)
    {
        let pattern = '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,4}$';

        return !value.length
            ? { error: true, message: `${controlName} est obligatoire.` }
            : !value.match(new RegExp(pattern))
            ? { error: true, message: `${controlName} doit respecter le format exemple@gmail.com.` }
            : null;
    }

    // Fonction pour valider une matricule
    static matricule(controlName, minLength, maxLength, value) {
        // Vérifier si la valeur est une chaîne de caractères
        if (typeof value !== "string") {
            return { error: true, message: `${controlName} doit être une chaîne de caractères.` };
        }
    
        // Supprimer les espaces inutiles
        value = value.trim();
    
        // Vérifier si le champ est vide
        if (!value.length) {
            return { error: true, message: `${controlName} est obligatoire.` };
        }
    
        // Vérifier si le matricule contient uniquement des chiffres
        if (!/^[0-9]+$/.test(value)) {
            return { error: true, message: `${controlName} ne doit contenir que des chiffres.` };
        }
    
        // Vérifier la longueur minimale
        if (value.length < minLength) {
            return { error: true, message: `${controlName} doit contenir au moins ${minLength} chiffres.` };
        }
    
        // Vérifier la longueur maximale
        if (value.length > maxLength) {
            return { error: true, message: `${controlName} doit contenir au plus ${maxLength} chiffres.` };
        }
    
        // Retourner null si tout est valide
        return null;
    }
    

    //Permet de valider un nom composé de chaine de caractère
    static nameValidator(controlName, minLength, maxLength, value)
    {
        const pattern = /^[A-Za-zÀ-ÿ '-]+$/;

        if (!value) {
            return { error: true, message: `${controlName} est obligatoire.` }
        }

        if (!value.match(new RegExp(pattern))) {
            return { error: true, message: `${controlName} ne doit contenir que des lettres.` }
        }

        if (value.length < minLength) {
            return { error: true, message: `${controlName} doit contenir au moins ${minLength} lettres.` }
        }

        if (value.length > maxLength) {
            return { error: true, message: `${controlName} doit contenir au plus ${maxLength} lettres.` }
        }

        if ((value != "") && (value.startsWith(" ") || value.endsWith(" "))) {
            return { error: true, message: `Les espaces de début et de fin ne sont pas autorisés.` }
        }

        return null;

    }

    //Permet de valider une adresse
    static adresseValidator(controlName, minLength, maxLength, value)
    {
        const isContainsNumber = /^(?=.*[0-9]).*$/;
        const isContainsUpperCase = /^(?=.*[A-Z]).*$/;
        const isContainsLowerCase = /^(?=.*[a-z]).*$/;
        const isContainsSymbol = /^(?=.*[-,;.]).*$/;

        if (!value) {
            return { error: true, message: `${controlName} est obligatoire.` }
        }

        if (isContainsSymbol.test(value)
            && !isContainsNumber.test(value)
            && !isContainsUpperCase.test(value)
            && !isContainsLowerCase.test(value)) {
                return { error: true, message: `${controlName} ne doit pas contenir que des caractères spéciaux.` }
        }

        if (isContainsNumber.test(value)
            && !isContainsSymbol.test(value)
            && !isContainsUpperCase.test(value)
            && !isContainsLowerCase.test(value)) {
                return { error: true, message: `${controlName} ne doit pas contenir que des chiffres.` }
        }
        
        if (value.length < minLength) {
            return { error: true, message: `${controlName} doit contenir au moins ${minLength} lettres.` }
        }

        if (value.length > maxLength) {
            return { error: true, message: `${controlName} doit contenir au plus ${maxLength} lettres.` }
        }

        if ((value != "") && (value.startsWith(" ") || value.endsWith(" "))) {
            return { error: true, message: `Les espaces de début et de fin ne sont pas autorisés.` }
        }

        return null;
    }

    // Fonction pour valider une date de naissance 
    static dateNaissanceValidator(controlName, value) {
        // Vérifier si la valeur est une chaîne de caractères
        if (typeof value !== "string") {
            return { error: true, message: `${controlName} doit être une chaîne de caractères.` };
        }
    
        // Supprimer les espaces inutiles
        value = value.trim();
    
        // Vérifier si le champ est vide
        if (!value.length) {
            return { error: true, message: `${controlName} est obligatoire.` };
        }
    
        // Vérifier si la date est au bon format (JJ/MM/AAAA ou AAAA-MM-JJ)
        const regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$|^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;
        if (!regex.test(value)) {
            return { error: true, message: `${controlName} doit être au format JJ/MM/AAAA ou AAAA-MM-JJ.` };
        }
    
        // Vérification si la date existe réellement
        const [day, month, year] = value.includes("/") ? value.split("/").reverse() : value.split("-");
        const dateObj = new Date(`${year}-${month}-${day}`);
        
        if (isNaN(dateObj.getTime())) {
            return { error: true, message: `${controlName} est invalide.` };
        }
    
        // Vérifier si l'âge est réaliste (ex: entre 5 et 120 ans)
        const today = new Date();
        const minYear = today.getFullYear() - 120;
        const maxYear = today.getFullYear() - 5;
        if (dateObj.getFullYear() < minYear || dateObj.getFullYear() > maxYear) {
            return { error: true, message: `${controlName} doit être une date valide entre ${minYear} et ${maxYear}.` };
        }
    
        // Si tout est bon, retourne null (aucune erreur)
        return null;
    }

    // Fonction pour valider une date d'inscription
    static dateInscriptionValidator(value) {
        if (!value || value.trim().length === 0) {
            return { error: true, message: "La date d'inscription est obligatoire." };
        }
    
        // Vérifier le format JJ/MM/AAAA ou AAAA-MM-JJ
        const regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$|^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;
        if (!regex.test(value)) {
            return { error: true, message: "Format invalide. Utilisez JJ/MM/AAAA ou AAAA-MM-JJ." };
        }
    
        // Convertir en objet Date
        const [day, month, year] = value.includes("/") ? value.split("/").reverse() : value.split("-");
        const inscriptionDate = new Date(`${year}-${month}-${day}`);
    
        if (isNaN(inscriptionDate.getTime())) {
            return { error: true, message: "Date invalide." };
        }
    
        // Vérifier que la date n'est pas dans le futur
        const today = new Date();
        if (inscriptionDate > today) {
            return { error: true, message: "La date d'inscription ne peut pas être dans le futur." };
        }
    
        // Vérifier que la date n'est pas trop ancienne (avant 1900)
        if (inscriptionDate.getFullYear() < 1900) {
            return { error: true, message: "La date d'inscription est trop ancienne." };
        }
    
        return null;
    }

    // Fonction pour gerer les notes
    static noteValidator(note){
        // Vérifier si c'est un nombre valide
        if (isNaN(note) || note === "" || note === null) {
            alert("Erreur : La note doit être un nombre.");
            return false;
        }

        // Convertir en nombre flottant
        let noteValue = parseFloat(note);

        // Vérifier que la note est dans l'intervalle valide
        if (noteValue < 0 || noteValue > 20) {
            alert("Erreur : La note doit être comprise entre 0 et 20.");
            return false;
        }

        return true; // Note valide
    }  
}