

function verifMotdepasse(champ)
{
var patt = new RegExp (/[A-Z](?=(.*[a-z]){1,})(?=(.*[0-9]){1,})/);

   if(patt.test(champ.value))
   {
    console.log("vrai")
    alert("Bon MDP");
    
    
    
   }
   else
   {
    console.log("faux")
    alert("Le mot de passe doit au moins commencer par une Majuscule , avoir au moins un chiffre , au moins une minuscule et comporter 8 caractères");
           
            
   }
}