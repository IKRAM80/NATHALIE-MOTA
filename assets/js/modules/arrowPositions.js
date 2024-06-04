function initializeArrowPositions() {
    // utilise la bibliothèque jQuery pour sélectionner tous les éléments avec la classe "arrow-left"et  "arrow-right"
    var arrowLeft = jQuery('.arrow-left');
    var arrowRight = jQuery('.arrow-right');

    if (arrowLeft.length && !arrowRight.length) {//vérifie si la variable "arrowLeft" contient des éléments et que la variable "arrowRight" ne contient pas d'éléments
        arrowLeft.mouseover(handleArrowMouseOver);//attacher un gestionnaire d'événements "mouseover" à tous les éléments sélectionnés avec la classe "arrow-left"
        arrowLeft.mouseout(handleArrowMouseOut);//attacher un gestionnaire d'événements "mouseout" à tous les éléments sélectionnés avec la classe "arrow-left"
    }

    function handleArrowMouseOver() {//appeler la fonction lorsque la souris survole les éléments avec la classe "arrow-left"
        var thumbnailLeft = jQuery('.hover-thumbnail.thumbnail-left');
        if (thumbnailLeft.length) {//érifier si la variable "thumbnailLeft" contient des éléments
            thumbnailLeft.css({//appliquer ces styles
                display: 'block',
                top: '-80px',
                left: '-55px'
            });
        }
    }

    function handleArrowMouseOut() {//fonction appelée lorsque la souris quitte les éléments avec la classe "arrow-left"
        var thumbnailLeft = jQuery('.hover-thumbnail.thumbnail-left');
        if (thumbnailLeft.length) {
            thumbnailLeft.css('display', 'none');
        }
    //Lorsque la souris survole la flèche de gauche, une miniature est affichée à une position spécifique.
    //Lorsque la souris quitte la flèche de gauche, la miniature est masquée
    }
}