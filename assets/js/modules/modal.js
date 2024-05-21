function initializeModal() {
    const contactBtns = jQuery(".menu-item-19 li, .contact-btn");
    const modalForm = jQuery(".modal-overlay");
    const modalContent = jQuery("#wpcf7-f28-o1");
    const formRefDiv = jQuery(".formRef");

    contactBtns.click(openForm);//Associe la fonction openForm à l'événement de clic sur les éléments sélectionnés dans contactBtns.

    function openForm(event) {//débute la fonctionnopenForm à exécuter lors du clic sur les boutons de contact
        event.preventDefault();
        const refValueElement = jQuery(".ref-value");

        // Vérifie si des éléments avec la classe .ref-value existent sur la page
        if (refValueElement.length) {
        //Récupère le texte contenu dans les éléments sélectionnés avec la classe .ref-value et le stocke dans la variable refValue.
            const refValue = refValueElement.text();
        //Sélectionne l'élément <input> avec l'attribut name égal à 'your-subject' à l'intérieur des éléments sélectionnés avec la classe .formRef
            const inputField = formRefDiv.find("input[name='your-subject']");
            if (inputField.length) {
                inputField.val(refValue.toUpperCase());//Met à jour la valeur de l'élément <input> avec le texte contenu dans refValue, converti en majuscules.
            }
        }
        //Ajoute la classe .active à l'élément .modal-overlay, ce qui affiche la fenêtre modale.
        modalForm.addClass("active");
        //Associe la fonction closeFormOutside à l'événement de clic sur tout le document.
        jQuery(document).click(closeFormOutside);
    }
    //Débute la déclaration de la fonction closeFormOutside() qui sera exécutée lorsqu'un clic est détecté en dehors de la fenêtre modale.
    function closeFormOutside(event) {
        // Vérifie si l'élément cliqué n'est pas un descendant de la fenêtre modale (.modal-content) et ne fait pas partie des boutons de contact.
        if (!jQuery(event.target).closest(modalContent).length && !contactBtns.toArray().includes(event.target)) {
            //Supprime la classe .active de l'élément .modal-overlay, ce qui masque la fenêtre modale.
            modalForm.removeClass("active");
            // Détache la fonction closeFormOutside de l'événement de clic sur tout le document.
            jQuery(document).unbind("click", closeFormOutside);
        }
    }
}