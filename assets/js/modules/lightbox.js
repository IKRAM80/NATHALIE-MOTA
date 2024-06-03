// OPEN LIGHTBOX
function initializeLightbox() {
    jQuery(document).on('click', '.fullsize', function() {
        openLightbox(jQuery(this).closest('.photo-suggested'));
    });

    const lightbox = jQuery(".lightbox");
    const closeIcon = jQuery(".lightbox__close");
    const prevButton = jQuery(".lightbox__prev");
    const nextButton = jQuery(".lightbox__next");

    let currentIndex = 0; // Track the index of the currently displayed photo

    closeIcon.click(closeLightbox);
    prevButton.click(showPreviousPhoto);
    nextButton.click(showNextPhoto);

    function openLightbox(photo) {
        const photoSrc = photo.data('photo-src');
        const photoRef = photo.data('photo-ref');
        const photoCategory = photo.data('photo-category');

        jQuery('.lightbox-photo').attr('src', photoSrc);
        jQuery('.lightbox__ref').text(photoRef);
        jQuery('.lightbox__category').text(photoCategory);

        // Update the current index to the index of the clicked photo
        currentIndex = jQuery(".photo-suggested").index(photo);

        lightbox.addClass("active");
    }

    function closeLightbox() {
        lightbox.removeClass("active");
    }

    function showPreviousPhoto() {
        // Update the index to the previous photo
        currentIndex = (currentIndex - 1 + jQuery(".photo-suggested").length) % jQuery(".photo-suggested").length;

        // Get the photo at the updated index
        const prevPhoto = jQuery(".photo-suggested").eq(currentIndex);

        // Display the information of the previous photo
        openLightbox(prevPhoto);
    }

    function showNextPhoto() {
        // Update the index to the next photo
        currentIndex = (currentIndex + 1) % jQuery(".photo-suggested").length;

        // Get the photo at the updated index
        const nextPhoto = jQuery(".photo-suggested").eq(currentIndex);

        // Display the information of the next photo
        openLightbox(nextPhoto);
    }
}