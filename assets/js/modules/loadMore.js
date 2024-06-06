// LOAD MORE
const loadMore = jQuery("#load-more");

function initializeLoadMore() {
    let currentPage = 1;

    loadMore.on('click', function(event) {
        event.preventDefault();
        currentPage++;

        jQuery.ajax({
            type: 'POST',
            url: 'http://localhost:8080/nathalie-mota/wp-admin/admin-ajax.php',
            dataType: 'json',
            data: {
                action: 'loadMore',
                paged: currentPage,
            },
            success: function(response) {
                if (response && response.hasOwnProperty('html') && response.hasOwnProperty('has_more_posts')) {
                    jQuery('.gallery-container').append(response.html);

                    if (!response.has_more_posts) {
                        loadMore.hide();
                        console.log('Response: Has no more posts');
                    }
                } else {
                    console.error('Invalid AJAX response structure');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', status, error);
            }
        });
    });
}

jQuery(document).ready(function($) {
    initializeLoadMore();
});
