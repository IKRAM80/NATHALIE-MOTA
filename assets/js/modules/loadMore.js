// LOAD MORE
const loadMore = jQuery("#load-more");

function initializeLoadMore() {
    let currentPage = 1;

    loadMore.on('click', function(event) {
        event.preventDefault();
        currentPage++;

        jQuery.ajax({
            type: 'POST',
            url: './wp-admin/admin-ajax.php', // Use the absolute URL provided by WordPress
            dataType: 'json',
            data: {
                action: 'loadMore',
                paged: currentPage,
            },
            success: function(response) {
                jQuery('.gallery-container').append(response.html);

                checkIfMorePosts(response);
            },
        });
    });
}

function checkIfMorePosts(res) {
    if (!res.has_more_posts) {
        loadMore.hide();
        console.log('Response : Has no more posts');
    } else {
        loadMore.show();
        console.log('Response : Has more posts');
    }
}