// LOAD MORE
const loadMore = jQuery("#load-more");//sélectionner l'élément avec l'ID "load-more"

function initializeLoadMore() {//fonction pour initialiser le comportement du bouton "Load More".
    let currentPage = 1;//Cette variable sera utilisée pour suivre la page actuelle lors du chargement de plus de contenu

    loadMore.on('click', function(event) {//gestionnaire d'événements au clic sur le bouton
        event.preventDefault();//empêcher le comportement par défaut du clic sur le bouton, ce qui évite que la page ne se recharge.
        currentPage++;//incrémenter la valeur de la variable "currentPage" de 1 à chaque fois que le bouton "Load More" est cliqué

        jQuery.ajax({//effectuer une requête AJAX en utilisant la bibliothèque jQuery avec ces détails
            type: 'POST',
            url: 'http://localhost:8080/nathalie-mota/wp-admin/admin-ajax.php', // Use the absolute URL provided by WordPress
            dataType: 'json',//on attend une réponse au format JSON.
            data: {//les données envoyées sont l'action "loadMore"et la page actuelle "currentPage".
                action: 'loadMore',
                paged: currentPage,
            },
            success: function(response) {//La réponse de la requête est ajoutée à la fin du contenu de cet élément.
                jQuery('.gallery-container').append(response.html);
                //déclarer une fonction appelée "checkIfMorePosts" prenant la réponse de la requête AJAX en tant que paramètre.
                checkIfMorePosts(response);
            },
        });
    });
}

function checkIfMorePosts(res) {
    if (!res.has_more_posts) {//si la propriété "has_more_posts" de la réponse est fausse? il n'y a plus de publications à charger.
        loadMore.hide();
        console.log('Response : Has no more posts');
    } else {
        loadMore.show();
        console.log('Response : Has more posts');
    }
//La fonction "checkIfMorePosts" est appelée pour vérifier si la réponse indique s'il y a plus de publications à charger ou non, 
//et en fonction de cela, le bouton "Load More" est affiché ou masqué.
}