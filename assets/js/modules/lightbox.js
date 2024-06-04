// OPEN LIGHTBOX
function initializeLightbox() {
    //attache un gestionnaire d'événement de clic à tous les éléments avec la classe "fullsize" dans le document
    openLightbox(jQuery(this).closest('.photo-suggested'));
    jQuery(document).on('click', '.fullsize', function() {
    });

    const lightbox = jQuery(".lightbox");//sélectionne l'élément avec la classe "lightbox" et le stocke dans la variable lightbox
    const closeIcon = jQuery(".lightbox__close");
    const prevButton = jQuery(".lightbox__prev");
    const nextButton = jQuery(".lightbox__next");

    let currentIndex = 0; // suivre l'index de la photo actuellement affichée dans la lightbox

    closeIcon.click(closeLightbox);//gestionnaire d'événement de clic à l'icône de fermeture de la lightbox
    prevButton.click(showPreviousPhoto);//gestionnaire d'événement de clic au bouton précédent de la lightbox
    nextButton.click(showNextPhoto);//gestionnaire d'événement de clic au bouton suivant de la lightbox

    function openLightbox(photo) {
        //fonction appelée lorsque l'utilisateur clique sur une image avec la classe "fullsize"
        const photoSrc = photo.data('photo-src');
        const photoRef = photo.data('photo-ref');
        const photoCategory = photo.data('photo-category');
        //récupèrer les informations de la photo cliquée
        //mettre à jour le contenu de la lightbox avec ces informations
        jQuery('.lightbox-photo').attr('src', photoSrc);
        jQuery('.lightbox__ref').text(photoRef);
        jQuery('.lightbox__category').text(photoCategory);

        // mettre à jour l'index de la photo actuelle
        currentIndex = jQuery(".photo-suggested").index(photo);
        //ajoute la classe "active" à la lightbox pour l'afficher
        lightbox.addClass("active");
    }

    function closeLightbox() {
        //fonction appelée lorsque l'utilisateur clique sur le bouton précédent de la lightbox
        lightbox.removeClass("active");
    }

    function showPreviousPhoto() {
        // mettre à jour l'index de la photo actuelle pour afficher la photo précédente
        currentIndex = (currentIndex - 1 + jQuery(".photo-suggested").length) % jQuery(".photo-suggested").length;

        const prevPhoto = jQuery(".photo-suggested").eq(currentIndex);

        // appeler la fonction openLightbox() pour afficher les informations de la photo précédente
        openLightbox(prevPhoto);
    }

    function showNextPhoto() {
        // mettre à jour l'index de la photo actuelle pour afficher la photo suivante
        currentIndex = (currentIndex + 1) % jQuery(".photo-suggested").length;

        const nextPhoto = jQuery(".photo-suggested").eq(currentIndex);

        // appeler la fonction openLightbox() pour afficher les informations de la photo suivante
        openLightbox(nextPhoto);
    }
}