class Validator {
    // Permet de valider un mot de passe
    static passwordValidator(controlName, value, lengthWord) {
        return !value.length
            ? { error: true, message: `${controlName} est obligatoire` }
            : value.length < lengthWord
            ? { error: true, message: `${controlName} doit contenir au moins ${lengthWord} caractères` }
            : value.startsWith(' ') || value.endsWith(' ')
            ? { error: true, message: `Les espacements au début ou à la fin ne sont pas autorisés.` }
            : "";
    }

    // Permet de valider une adresse email
    static emailValidator(controlName, value) {
        let pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return !value.length
            ? { error: true, message: `${controlName} est obligatoire` }
            : !pattern.test(value)
            ? { error: true, message: `${controlName} doit respecter le format example@gmail.com.` }
            : "";
    }
}
