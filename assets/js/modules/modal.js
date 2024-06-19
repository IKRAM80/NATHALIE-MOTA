// Déclarer une fonction appelée initializeModal qui initialise la fonctionnalité modale
function initializeModal() {
    // Sélectionner tous les boutons de contact avec les classes spécifiées
    const contactBtns = document.querySelectorAll(".menu-item-19 li, .contact-btn");
    // Sélectionner l'élément de superposition modale
    const modalForm = document.querySelector(".modal-overlay");
    // Sélectionner le conteneur de référence du formulaire
    const formRefDiv = document.querySelector(".formRef");
    
    // Vérifier si les éléments requis (modalForm ou formRefDiv) sont absents dans le DOM
    if (!modalForm || !formRefDiv) {
        console.error('Required elements (modalForm or formRefDiv) are not found in the DOM.');
        return;  // Sortir de la fonction si les éléments ne sont pas trouvés
    }

    // Ajouter un événement de clic à chaque bouton de contact pour ouvrir le formulaire
    contactBtns.forEach(function(btn) {
        btn.addEventListener('click', openForm);
    });

    // Déclarer une fonction appelée openForm qui gère l'ouverture du formulaire
    function openForm(event) {
        event.preventDefault();// Empêcher le comportement par défaut de l'événement de clic
        let modalContent = document.getElementById("wpcf7-f25-o1");

        // Vérifier si l'élément modalContent est absent dans le DOM
        if (!modalContent) {
            console.error('modalContent element not found in the DOM when opening the form.');
            return; // Sortir de la fonction si l'élément n'est pas trouvé
        }

        // Sélectionner l'élément contenant la valeur de référence
        const refValueElement = document.querySelector(".ref-value");

        // Si l'élément refValueElement existe, mettre à jour le champ de saisie avec la valeur de référence en majuscules
        if (refValueElement) {
            const refValue = refValueElement.textContent;
            const inputField = formRefDiv.querySelector("input[name='your-subject']");
            if (inputField) {
                inputField.value = refValue.toUpperCase();
            }
        }

        // Ajouter la classe "active" à modalForm pour l'afficher
        modalForm.classList.add("active");

        // Attache un écouteur d'événement de clic pour fermer le formulaire lorsqu'on clique à l'extérieur
        document.addEventListener('click', closeFormOutside);

        // Déclarer une fonction appelée closeFormOutside qui gère la fermeture du formulaire
        function closeFormOutside(event) {
            // Si modalContent n'existe pas, sortir de la fonction
            if (!modalContent) {
                return;
            }

            // Si le clic n'est pas à l'intérieur de modalContent ou un des boutons de contact, fermer le formulaire
            if (!modalContent.contains(event.target) && !Array.from(contactBtns).includes(event.target)) {
                modalForm.classList.remove("active");
                document.removeEventListener('click', closeFormOutside);
            }
        }
    }
}

// Ajoute un écouteur d'événement pour exécuter initializeModal lorsque le contenu du document est chargé
document.addEventListener('DOMContentLoaded', initializeModal);


