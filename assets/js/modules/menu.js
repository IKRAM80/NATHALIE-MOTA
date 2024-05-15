// Menu nav burger

function initializeMenu() {
    const menuBurger = jQuery("#menu_burger");//sélectionner l'élément HTML avec l'ID "menu_burger" à l'aide de jQuery et l'assigner à la variable menuBurger
    const openBtn = jQuery("#openBtn"); //sélectionner l'élément HTML avec l'ID "openBtn" à l'aide de jQuery et l'assigner à la variable openBtn
    const closeBtn = jQuery("#closeBtn");// meme chose pour la variable closeBtn

    openBtn.click(openMenu);//Lorsque ce bouton est cliqué, la fonction openMenu() sera appelée pour ouvrir le menu
    closeBtn.click(closeMenu);//Lorsque ce bouton est cliqué, la fonction closeMenu() sera appelée pour fermer le menu.



    function openMenu() {
        menuBurger.addClass("active");
        // ajouter la classe CSS "active" à l'élément représentant le menu burger
    }

    function closeMenu() {
        menuBurger.removeClass("active");
        // supprimer la classe CSS "active" de l'élément représentant le menu burger, le masquant de l'écran.
    }
}