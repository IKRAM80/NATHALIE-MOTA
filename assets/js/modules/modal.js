function initializeModal() {
    const contactBtns = jQuery(".menu-item-29 a, .contact-btn");
    const modalForm = jQuery(".modal-overlay");
    const modalContent = jQuery("#wpcf7-f28-o1");
    const formRefDiv = jQuery(".formRef");

    contactBtns.click(openForm);

    function openForm(event) {
        event.preventDefault();
        const refValueElement = jQuery(".ref-value");

        // Check if ref-value element is present on the page
        if (refValueElement.length) {
            const refValue = refValueElement.text();

            const inputField = formRefDiv.find("input[name='your-subject']");
            if (inputField.length) {
                inputField.val(refValue.toUpperCase());
            }
        }
        modalForm.addClass("active");
        jQuery(document).click(closeFormOutside);
    }

    function closeFormOutside(event) {
        if (!jQuery(event.target).closest(modalContent).length && !contactBtns.toArray().includes(event.target)) {
            modalForm.removeClass("active");
            jQuery(document).unbind("click", closeFormOutside);
        }
    }
}