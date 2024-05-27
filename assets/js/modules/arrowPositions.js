function initializeArrowPositions() {
    var arrowLeft = jQuery('.arrow-left');
    var arrowRight = jQuery('.arrow-right');

    if (arrowLeft.length && !arrowRight.length) {
        arrowLeft.mouseover(handleArrowMouseOver);
        arrowLeft.mouseout(handleArrowMouseOut);
    }

    function handleArrowMouseOver() {
        var thumbnailLeft = jQuery('.hover-thumbnail.thumbnail-left');
        if (thumbnailLeft.length) {
            thumbnailLeft.css({
                display: 'block',
                top: '-80px',
                left: '-55px'
            });
        }
    }

    function handleArrowMouseOut() {
        var thumbnailLeft = jQuery('.hover-thumbnail.thumbnail-left');
        if (thumbnailLeft.length) {
            thumbnailLeft.css('display', 'none');
        }
    }
}