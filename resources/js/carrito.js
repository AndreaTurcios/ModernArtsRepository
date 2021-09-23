let paralaxef = document.querySelector('.imgbgjc');
let texto = document.querySelector('.himgjc');

function scrollParalax() {
    let scrollTop = document.documentElement.scrollTop;
    paralaxef.style.transform = 'translateY(' + scrollTop * 0.2 + 'px)';
    texto.style.transform = 'translateY(' + scrollTop * 0.02 + 'px)';
}

window.addEventListener('scroll', scrollParalax);