// FILTERS

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
        console.log(category)
        console.log(format)
        console.log(sortByDate)

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
            url: '../wp-admin/admin-ajax.php',
            data: {
                action: 'ajaxFilter',
                category: category,
                format: format,
                sortByDate: sortByDate
            },
            success: function(response) {
                jQuery('.gallery-container').html(response);

                // Show the "Load More" button if no filters are active
            }
        });
    }
}