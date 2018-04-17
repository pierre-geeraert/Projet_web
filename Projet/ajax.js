function ajax(url, params) {
    return fetch(url, params)
        .then(function(response) {
            var data = response.json();
            if (!response.ok) // Si il y a eu une erreur côté serveur
                return Promise.reject(data.error || 'Ajax request failure');
            else
                return data;
        });
}

var pictures = document.querySelectorAll('.pictures');

for (var picture in pictures) {
    picture.addEventListener('click', liker);
}


// Exemple d'utilisation
function liker() {
    var photo_id = this.dataset.id;
    ajax('nbr_like.php?picture_id=' + photo_id)
        .then(function(data) {
            console.log(data);
            // var node = '<p>' + data.test + '</p>';
            var like_link = document.querySelector('#like-link2'); // element du dom ou est affiché le nombre de like
            console.log(like_link.dataset)
            var nblike = parseInt(like_link.dataset.nblike, 10); // récupération du nombre de like via le data attribute
            console.log('nb like : ', nblike)
            like_link.innerHTML = (nblike + 1).toString(); // remplacement par la nouvelle valeur
            // document.querySelector('body').innerHTML = node;
        })
        .catch(function(error) {
            console.log(error)
            console.log('erreur lors du like');
        });
}
//liker();


