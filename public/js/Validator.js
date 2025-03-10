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

        //Permet de valider un numero de telephone
        static phoneValidator(controlName, minlength, maxlength, value)
        {
            let pattern = '^[0-9]+(\.?[0-9]+)?$' ;
            return !value.length 
                ? { error: true, message : `${controlName} est obligatoire` }
                : !value.match(new RegExp(pattern))
                ?  { error: true, message :  `${controlName} ne doit contenir au moins que des chiffres.` }
                : value.length < minlength
                ? { error: true, message :  `${controlName} doit contenir au moins ${minlength} chiffres.` }
                : value.length > maxlength
                ? { error: true, message :  `${controlName} doit contenir au plus ${maxlength} chiffres.` }
                : null; 
                
        }
        //Permet de valider un nom compose de chaine de caractere
        static nameValidator(controlName, minLength, maxLength, value)
        {
            let pattern = '^[A-Za-ùàéèç -]$' ;
            if (!value){
                return{ error: true, message: `${controlName} est obligatoire`}
            }
            
            if (!value.match(new RegExp(pattern))){
                return{ error: true, message: `${controlName} ne doit contenir que des lettres`}
            }

            if (value.length < minLength){
                return{ error: true, message: `${controlName} doit contenirau au moins ${minLength} lettres.`}
            }

            if (value.length > maxLength){
                return{ error: true, message: `${controlName} doit contenir au plus ${maxLenght} lettres. `}
            }

            if((value != "") && (value.startsWith(" ") || value.endsWith(" "))){
                return { error: true, message: 'Les espaces ne sont pas autorises.'}
            }

            return null;
        }
  
}