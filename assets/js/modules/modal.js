
function initializeModal() {
    const contactBtns = document.querySelectorAll(".menu-item-19 li, .contact-btn");
    const modalForm = document.querySelector(".modal-overlay");
    const modalContent = document.getElementById("wpcf7-f28-o1");
    const formRefDiv = document.querySelector(".formRef");

    contactBtns.forEach(function(btn) {
        btn.addEventListener('click', openForm);
    });

    function openForm(event) {
        event.preventDefault();
        const refValueElement = document.querySelector(".ref-value");

        if (refValueElement) {
            const refValue = refValueElement.textContent;
            const inputField = formRefDiv.querySelector("input[name='your-subject']");
            if (inputField) {
                inputField.value = refValue.toUpperCase();
            }
        }

        modalForm.classList.add("active");
        document.addEventListener('click', closeFormOutside);
    }

    function closeFormOutside(event) {
        if (!modalContent.contains(event.target) && ![...contactBtns].includes(event.target)) {
            modalForm.classList.remove("active");
            document.removeEventListener('click', closeFormOutside);
        }
    }
}

