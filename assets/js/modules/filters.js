// FILTERS

jQuery(document).ready(function($) {
function initializeFilters() {
    let activeCategory = 'all';
    let activeFormat = 'all';
    let activeSortByDate = 'all';

    jQuery('#categories').val(activeCategory);
    jQuery('#formats').val(activeFormat);
    jQuery('#sort-by-date').val(activeSortByDate);

    function areFiltersActive() {
        return activeCategory !== 'all' || activeFormat !== 'all' || activeSortByDate !== 'all';
    }

    // Event handler for filter changes
    jQuery('#categories, #formats, #sort-by-date').on('change', function() {
        ajaxFilter();
    });

    function ajaxFilter() {
        let category = jQuery('#categories').val();
        let format = jQuery('#formats').val();
        let sortByDate = jQuery('#sort-by-date').val();

        // Update active filter states
        activeCategory = category;
        activeFormat = format;
        activeSortByDate = sortByDate;

        // Hide the "Load More" button if filters are active
        if (areFiltersActive()) {
            jQuery('#load-more').hide();
        }

        jQuery.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'ajaxFilter',
                category: category,
                format: format,
                sortByDate: sortByDate
            },
            success: function(response) {
                jQuery('.gallery-container').html(response);

                // Show the "Load More" button if no filters are active
                if (!areFiltersActive()) {
                    $('#load-more').show();
                }
            },
            error: function(error) {
                console.log('Erreur AJAX : ', error);
            }
        });
    }
}
initializeFilters();
});