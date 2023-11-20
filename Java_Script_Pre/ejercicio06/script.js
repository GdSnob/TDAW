function abrirRegalo(event) {
    const image = event.target;
    image.removeEventListener('click', abrirRegalo);

    const regaloAbierto = document.querySelector('#regalo-abierto');
    const regaloCerrado = document.querySelector('#regalo-cerrado');


    regaloCerrado.classList.add('oculto');
    regaloAbierto.classList.remove('oculto');
 

}

const image = document.querySelector('#regalo-cerrado img');
image.addEventListener('click', abrirRegalo);