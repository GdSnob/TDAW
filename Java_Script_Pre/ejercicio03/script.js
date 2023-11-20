function abrirRegalo() {
    const image = document.querySelector('img');
    image.src = 'giphy.gif';
}

const image = document.querySelector('img');
image.addEventListener('click', abrirRegalo);
