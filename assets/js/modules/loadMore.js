// LOAD MORE
const loadMore = jQuery("#load-more");

function initializeLoadMore() {
    let currentPage = 1;

    loadMore.on('click', function(event) {
        event.preventDefault();
        currentPage++;

        // Vérifie si ajax_object est défini et si ajax_url est défini à l'intérieur
        if (typeof ajax_object === 'undefined' || !ajax_object.ajax_url) {
            console.error('L\'URL de l\'endpoint AJAX est manquante ou non définie.');
            return;
        }

        jQuery.ajax({
            type: 'POST',
            url: ajax_object.ajax_url, // Utilisez l'URL fournie par WordPress
            dataType: 'json',
            data: {
                action: 'loadMore', // Action pour déclencher la fonction PHP
                paged: currentPage,
            },
            success: function(response) {
                if (response.success) {
                    jQuery('.gallery-container').append(response.data.html);
                    checkIfMorePosts(response.data.has_more_posts);
                } else {
                    console.error('Erreur lors de la récupération des publications.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Erreur AJAX:', status, error);
            }
        });
    });
}

function checkIfMorePosts(hasMorePosts) {
    if (!hasMorePosts) {
        loadMore.hide();
        console.log('Response : Has no more posts');
    } else {
        loadMore.show();
        console.log('Response : Has more posts');
    }
}

jQuery(document).ready(function($) {
    initializeLoadMore();
});
