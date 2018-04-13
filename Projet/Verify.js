var patt = new RegExp (/(?=(.*[a-z]){1,})(?=(.*[A-Z]){1,})(?=(.*[0-9]){1,})([a-zA-Z0-9]{8,}).*/);

var validationRegister = document.querySelector(".signin_button");
var inputRegister = document.querySelectorAll('.champ');


validationRegister.addEventListener('click', function(e){
    for(var i=0 ; i<inputRegister.length ; i++){
        switch(inputRegister[i].type){
            case 'password' : checkpassword(inputRegister[i],e);break;
        }
    }
});



function checkpassword(champ,e){

    console.log(patt.test(champ.value));
    if(patt.test(champ.value)==false)
    {e.preventDefault();
        displayError(champ);}

}

function displayError(champ){
    
}