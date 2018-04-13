



var getJSON = function(){

    return new Promise(function(data,err){
        var xhr = new XMLHttpRequest();
        xhr.open('GET',TOP3.php,true);

        xhr.responseType = 'json';
        xhr.onload = function() {
            if(xhr.status === 200){
                data(xhr.response);
            }
            else {
                err(xhr.status, xhr.response);
            }

    }
    xhr.send();
});

};

const products = function(data){

    let products = data[0];
    var i =0;

    product.forEach(prod => {
        let name ='name'+i;
        let description='descrition'+i;
        let price ='price'+i;

        document.querySelector('#'+name).innerHTML=author.name;
        document.querySelector('#'+description).innerHTML=author.description;
        document.querySelector('#'+price).innerHTML=author.price;
        
        i++;
    });


}

const printError = function(data){
    console.error(data);
}

const print = function(data){
    console.log(data);}