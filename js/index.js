var d = document, _c = console.log, body = d.querySelector('body');

/* Menú animación */

var menuBtn = d.querySelector('header label');

menuBtn.addEventListener('click', displayMenu);

function displayMenu(){

    let menu = d.querySelector('nav');

    if(menu.getBoundingClientRect().left < -1){
        menu.style.transform = 'translateX(0%)';
        menu.style.transition = '0.5s';
        body.style.overflowY = 'hidden';
    }else{
        menu.style.transform = 'translateX(-100%)';
        menu.style.transition = '0.5s';
        body.style.overflowY = 'scroll';
    }

}
