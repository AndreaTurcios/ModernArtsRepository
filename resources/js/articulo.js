function menuAnimeOn(){
    var menu = document.getElementById("menu");
    var btnMenu = document.getElementById("btnMenu");
    menu.classList.add('menu-anime');
    btnMenu.classList.add('btn-menu-anime');
}
function menuAnimeOff(){
    var menu = document.getElementById("menu");
    var btnMenu = document.getElementById("btnMenu");
    menu.classList.remove('menu-anime');
    btnMenu.classList.remove('btn-menu-anime');
}