var patt = new RegExp (/(?=(.*[a-z]){1,})(?=(.*[A-Z]){1,})(?=(.*[0-9]){1,})([a-zA-Z0-9]{8,}).*/);



/*var test = patt.test(champ.value);



   whille 
   if(patt.test(champ.value))
   {
    console.log("vrai")
    alert("Bon MDP");
    
    
    
   }
   else
   {

    console.log("faux")
    alert("Le mot de passe doit au moins commencer par une Majuscule , avoir au moins un chiffre , au moins une minuscule et comporter 8 caractères");
           
            
   }*/

var myInput = document.getElementById("Mdp"), confirm_password=document.getElementById("signin_button");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var nom = document.getElementById("Nom")

myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";

myInput.onblur = function() {
    document.getElementById("message").style.display = "none";

}
// When the user starts to type something inside the password field
myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if(myInput.value.match(lowerCaseLetters)) { 
      letter.classList.remove("invalid");
      letter.classList.add("valid");
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
  }
  
    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if(myInput.value.match(upperCaseLetters)) { 
      capital.classList.remove("invalid");
      capital.classList.add("valid");
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }
  
    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) { 
      number.classList.remove("invalid");
      number.classList.add("valid");
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }
  
    // Validate length
    if(myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  }

}