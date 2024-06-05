// FILTERS

function initializeFilters() {
    let activeCategory = 'all';//Cette variable représente la catégorie active dans les filtres
    let activeFormat = 'all';//représente le format actif dans les filtres.
    let activeSortByDate = 'all';//représente le tri actif par date dans les filtres.

    jQuery('#categories').val(activeCategory);// utiliser la bibliothèque jQuery pour sélectionner l'élément avec l'ID "categories" 
    jQuery('#formats').val(activeFormat);
    jQuery('#sort-by-date').val(activeSortByDate);

    function areFiltersActive() {
    //vérifier si les filtres sont actifs en comparant les valeurs des variables "activeCategory",
    // "activeFormat" et "activeSortByDate" avec la valeur "all
    // Si au moins l'un des filtres est différent de "all", la fonction renvoie true, sinon elle renvoie false  
        return activeCategory !== 'all' || activeFormat !== 'all' || activeSortByDate !== 'all';
    }

    //gestionnaire d'événements "change" aux éléments avec les ID "categories", "formats" et "sort-by-date"
    //Lorsque l'un de ces éléments change, la fonction anonyme sera appelée.
    jQuery('#categories, #formats, #sort-by-date').on('change', function() {
        ajaxFilter();//fonction appelée lorsque les filtres sont modifiés.
    });

    function ajaxFilter() {
        //récupèrer les valeurs sélectionnées dans les éléments de filtre
        let category = jQuery('#categories').val();
        let format = jQuery('#formats').val();
        let sortByDate = jQuery('#sort-by-date').val();
        
        //mettre à jour les variables avec ces valeurs puis effectuer une requête AJAX pour filtrer les données
        activeCategory = category;
        activeFormat = format;
        activeSortByDate = sortByDate;

        //cacher le bouton charger plus si les filtres sont actifs
        if (areFiltersActive()) {
            jQuery('#load-more').hide();
        }

        jQuery.ajax({//effectuer une requête AJAX en utilisant la bibliothèque jQuery.
            type: 'POST',//type de requête HTTP à envoyer, dans ce cas, une requête POST
            url: 'http://localhost:8080/nathalie-mota/wp-admin/admin-ajax.php',//la requête est envoyée à l'URL
            data: {//données à envoyer avec la requête AJAX. Les données sont fournies sous la forme d'un objet JavaScript.
                action: 'ajaxFilter',
                category: category,
                format: format,
                sortByDate: sortByDate
            },
            success: function(response) {//. La réponse de la requête AJAX est insérée dans cet élément
                jQuery('.gallery-container').html(response);

                // montrer le bouton charger plus si les filtres ne sont pas actifs
            }
        });
    }
}