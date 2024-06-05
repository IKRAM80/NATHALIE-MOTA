// Menu nav burger

function initializeMenu() {
    const menuBurger = document.querySelector("#menu_burger");
    const openBtn = document.querySelector("#openBtn");
    const closeBtn = document.querySelector("#closeBtn");

    openBtn.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);

    function openMenu() {
        menuBurger.classList.add("active");
    }

    function closeMenu() {
        menuBurger.classList.remove("active");
    }
}
