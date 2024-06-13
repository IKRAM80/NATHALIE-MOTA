// FILTERS
    let activeCategory = 'all';
    let activeFormat = 'all';
    let activeSortByDate = 'all';

function initializeFilters() {
    
    console.log('Initializing filters...');
    
    jQuery('#categories').val(activeCategory);
    jQuery('#formats').val(activeFormat);
    jQuery('#sort-by-date').val(activeSortByDate);

    function areFiltersActive() {
        return activeCategory !== 'all' || activeFormat !== 'all' || activeSortByDate !== 'all';
    }

    jQuery('#categories, #formats, #sort-by-date').on('change', function() {
        console.log('Filter changed:', jQuery(this).attr('id'), jQuery(this).val());
        ajaxFilter();
    });

    function ajaxFilter() {
        let category = jQuery('#categories').val();
        let format = jQuery('#formats').val();
        let sortByDate = jQuery('#sort-by-date').val();

        activeCategory = category;
        activeFormat = format;
        activeSortByDate = sortByDate;

        console.log(`Filters applied: category=${category}, format=${format}, sortByDate=${sortByDate}`);

        if (areFiltersActive()) {
            jQuery('#load-more').hide();
        }

        jQuery.ajax({
            type: 'POST',
            url: 'http://localhost:8080/nathalie-mota/wp-admin/admin-ajax.php',
            data: {
                action: 'ajaxFilter',
                category: category,
                format: format,
                sortByDate: sortByDate
            },
            success: function(response) {
                console.log('AJAX request successful');
                jQuery('.gallery-container').html(response);
                if (!areFiltersActive()) {
                    jQuery('#load-more').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', status, error);
                console.log('XHR Object:', xhr);
            }
        });
    }

    console.log('Filters initialized successfully.');
}

jQuery(document).ready(initializeFilters);
