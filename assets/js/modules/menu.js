// Menu nav burger

function initializeMenu() {
    const menuBurger = document.querySelector("#menu_burger");
    const openBtn = document.querySelector("#openBtn");
    const closeBtn = document.querySelector("#closeBtn");

    // Lorsque cet élément est cliqué, la fonction openMenu sera appelée
    openBtn.addEventListener('click', openMenu);
    // Lorsque cet élément est cliqué, la fonction closeMenu sera appelée
    closeBtn.addEventListener('click', closeMenu);

    function openMenu() {
        // Ajouter la classe "active" à l'élément "menu_burger"
        // Cela ouvre le menu burger en ajoutant cette classe
        menuBurger.classList.add("active");
    }

    function closeMenu() {
         // Retirer la classe "active" de l'élément "menu_burger"
         // Cela ferme le menu burger en retirant cette classe
        menuBurger.classList.remove("active");
    }
}
