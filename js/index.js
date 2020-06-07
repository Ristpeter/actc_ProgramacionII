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

var perfilImage = d.querySelector('#perfilImg'), divPerfilImage = d.querySelector('.divPerfilImage'), perfilRadio = d.querySelectorAll('.perfilRadio');

perfilImage.addEventListener('click',changePerfilImage);

perfilRadio.forEach(element => {
    element.addEventListener('click',changePerfilImage);
});

function changePerfilImage(){

    if(this.getAttribute('id') == 'perfilImg'){
        if(divPerfilImage.style.display == 'none'){
            divPerfilImage.setAttribute('style', 'display:grid;');
        }else{
            divPerfilImage.setAttribute('style', 'display:none;');
        }
    }else{
        let img = this.firstChild.getAttribute('src'), name = this.firstChild.getAttribute('alt');

        perfilImage.setAttribute('src', img);
        perfilImage.setAttribute('alt', name);
        


    }

}
