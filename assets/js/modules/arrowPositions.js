function initializeArrowPositions() {
    // Sélectionner tous les éléments avec la classe "arrow-left"et "arrow-right"
    var arrowLeft = document.querySelectorAll('.arrow-left');
    var arrowRight = document.querySelectorAll('.arrow-right');

    // Vérifier si au moins un élément avec la classe "arrow-left" est trouvé et aucun avec la classe "arrow-right"
    if (arrowLeft.length && !arrowRight.length) {
        // Pour chaque élément avec la classe "arrow-left"
        arrowLeft.forEach(function(element) {
            // Ajouter un écouteur d'événement "mouseover" qui appelle la fonction handleArrowMouseOver
            element.addEventListener('mouseover', handleArrowMouseOver);
            // Ajouter un écouteur d'événement "mouseout" qui appelle la fonction handleArrowMouseOut
            element.addEventListener('mouseout', handleArrowMouseOut);
        });
    }

    // Fonction appelée lors du survol d'un élément "arrow-left"
    function handleArrowMouseOver() {
         // Sélectionner l'élément avec les classes "hover-thumbnail" et "thumbnail-left"
        var thumbnailLeft = document.querySelector('.hover-thumbnail.thumbnail-left');
        if (thumbnailLeft) {
            // Si l'élément est trouvé, l'afficher
            thumbnailLeft.style.display = 'block';
            // Positionner l'élément par rapport à son élément parent
            thumbnailLeft.style.top = '-80px';
            thumbnailLeft.style.left = '-55px';
        }
    }

    // Fonction appelée lorsque la souris quitte un élément "arrow-left"
    function handleArrowMouseOut() {
        // Sélectionner l'élément avec les classes "hover-thumbnail" et "thumbnail-left"
        var thumbnailLeft = document.querySelector('.hover-thumbnail.thumbnail-left');
        if (thumbnailLeft) {
            // Si l'élément est trouvé, le cacher
            thumbnailLeft.style.display = 'none';
        }
    }
}
