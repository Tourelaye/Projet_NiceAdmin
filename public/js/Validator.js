class Validator
{
    //Permet de valider un mot de passe
    static passwordValidator(controlName, value, lengthWord)
    {
        return !value.length 
            ? { error: true, message : `${controlName} est obligatoire` }
            : value.length < lengthWord
            ? { error: true, message : `${controlName} doit contenir au moins ${lengthWord} caracteres` }
            : ((value != "") && (value.startsWith(' ') && value.endsWith(" ")))
                    ? { error: true, message : `Les espacements ne sont pas autorise.` }
            : "";
    }

    //Permet de valider une adresse email
    static emailValidator(controlName, value)
    {
        let pattern = '^[a-zA-Z0-9.-_]+@[a-zA-Z0-9._]+\\.[a-zA-Z]{2, 4}$' ;
        return !value.length 
            ? { error: true, message : `${controlName} est obligatoire` }
            : !value.match(new RegExp(pattern))
            ?  { error: true, message : 'L' `${controlName} doit respecter le format example@gmail.com.` }
            : "";
    }

}