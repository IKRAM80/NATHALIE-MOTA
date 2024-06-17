// Définition des variables pour les filtres actifs
let activeCategory = 'all';
let activeFormat = 'all';
let activeSortByDate = 'all';

// Fonction pour initialiser les filtres
function initializeFilters() {
    // Initialisation des valeurs des éléments de sélection avec les valeurs des filtres actifs
    jQuery('#categories').val(activeCategory);
    jQuery('#formats').val(activeFormat);
    jQuery('#sort-by-date').val(activeSortByDate);

    // Fonction pour vérifier si au moins un filtre est actif
    function areFiltersActive() {
        return activeCategory !== 'all' || activeFormat !== 'all' || activeSortByDate !== 'all';
    }

    // Gestionnaire d'événement pour les changements sur les éléments de sélection
    jQuery('#categories, #formats, #sort-by-date').on('change', function() {
        // Appel de la fonction ajaxFilter lorsque les filtres changent
        ajaxFilter();
    });

    // Fonction pour effectuer la requête AJAX basée sur les filtres sélectionnés
    function ajaxFilter() {
        // Récupération des valeurs des filtres depuis les éléments de sélection
        let category = jQuery('#categories').val();
        let format = jQuery('#formats').val();
        let sortByDate = jQuery('#sort-by-date').val();

        // Mise à jour des valeurs des filtres actifs avec les nouvelles valeurs sélectionnées
        activeCategory = category;
        activeFormat = format;
        activeSortByDate = sortByDate;

        // Masquage du bouton "Load More" si au moins un filtre est actif
        if (areFiltersActive()) {
            jQuery('#load-more').hide();
        }

        // Requête AJAX pour filtrer et récupérer les résultats basés sur les filtres
        jQuery.ajax({
            type: 'POST',   // Méthode de la requête
            url: 'http://localhost:8080/nathalie-mota/wp-admin/admin-ajax.php',   // URL de l'endpoint AJAX WordPress
            data: {         // Données envoyées avec la requête
                action: 'ajaxFilter',   // Action WordPress pour gérer la requête
                category: category,     // Valeur de la catégorie sélectionnée
                format: format,         // Valeur du format sélectionné
                sortByDate: sortByDate, // Valeur de l'ordre de tri sélectionné
                nonce: myAjax.nonce     // Nonce de sécurité pour prévenir les attaques CSRF
            },
            success: function(response) {   // Fonction appelée en cas de succès de la requête AJAX
                // Remplacement du contenu de la classe '.gallery-container' avec la réponse AJAX
                jQuery('.gallery-container').html(response);
                // Affichage du bouton "Load More" si aucun filtre n'est actif après la mise à jour
                if (!areFiltersActive()) {
                    jQuery('#load-more').show();
                }
            },
            error: function(xhr, status, error) {   // Fonction appelée en cas d'échec de la requête AJAX
                console.error('AJAX request failed:', status, error);
                // Affichage de l'objet XMLHttpRequest dans la console pour le débogage
                console.log('XHR Object:', xhr);
            }
        });
    }
}

// Appel de la fonction initializeFilters lorsque le document est prêt
jQuery(document).ready(initializeFilters);

