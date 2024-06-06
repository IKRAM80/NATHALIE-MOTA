
function initializeModal() {
    const contactBtns = document.querySelectorAll(".menu-item-19 li, .contact-btn");
    const modalForm = document.querySelector(".modal-overlay");
    const formRefDiv = document.querySelector(".formRef");

    if (!modalForm || !formRefDiv) {
        console.error('Required elements (modalForm or formRefDiv) are not found in the DOM.');
        return;
    }

    contactBtns.forEach(function(btn) {
        btn.addEventListener('click', openForm);
    });

    function openForm(event) {
        event.preventDefault();
        let modalContent = document.getElementById("wpcf7-f25-o1");

        if (!modalContent) {
            console.error('modalContent element not found in the DOM when opening the form.');
            return;
        }

        const refValueElement = document.querySelector(".ref-value");

        if (refValueElement) {
            const refValue = refValueElement.textContent;
            const inputField = formRefDiv.querySelector("input[name='your-subject']");
            if (inputField) {
                inputField.value = refValue.toUpperCase();
            }
        }

        modalForm.classList.add("active");

        // Attach the click listener with the current modalContent
        document.addEventListener('click', closeFormOutside);

        function closeFormOutside(event) {
            if (!modalContent) {
                return;
            }

            if (!modalContent.contains(event.target) && !Array.from(contactBtns).includes(event.target)) {
                modalForm.classList.remove("active");
                document.removeEventListener('click', closeFormOutside);
            }
        }
    }
}

document.addEventListener('DOMContentLoaded', initializeModal);


