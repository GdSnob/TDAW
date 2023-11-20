// Obtén todas las imágenes en miniatura
const miniaturas = document.querySelectorAll('.miniatura');

// Recorre cada imagen en miniatura
miniaturas.forEach((miniatura) => {
    // Añade un listener para el evento mouseIn
    miniatura.addEventListener('mouseenter', function (event) {
        const mouseX = event.clientX;
        const mouseY = event.clientY;
        const imagenAmpliada = document.createElement('div');

        imagenAmpliada.classList.add('imagen-ampliada');

        imagenAmpliada.style.position = 'absolute';
        imagenAmpliada.style.left = mouseX + 10 + 'px';
        imagenAmpliada.style.top = mouseY + 'px'; 

        const imagenAmpliadaSrc = document.createElement('img');
        imagenAmpliadaSrc.src = miniatura.src;

        imagenAmpliada.appendChild(imagenAmpliadaSrc);

        document.body.appendChild(imagenAmpliada);

        miniatura.addEventListener('mouseleave', function () {
            // Verifica si el nodo es un hijo antes de intentar eliminarlo
            if (document.body.contains(imagenAmpliada)) {
                document.body.removeChild(imagenAmpliada);
            }
        });
    });
});

// Obtén el formulario de filtrado y el elemento select
const filtroForm = document.getElementById('filtroForm');
const filtroGenero = document.getElementById('filtroGenero');

// Obtén todas las filas de la tabla
const filas = document.querySelectorAll('#art tbody tr');

// Añade un listener para el evento submit del formulario
filtroForm.addEventListener('submit', function (event) {
    // Evita que el formulario se envíe
    event.preventDefault();

    // Obtén el valor del género seleccionado
    const generoSeleccionado = filtroGenero.value;

    // Recorre las filas y muestra/oculta según el género seleccionado
    filas.forEach((fila) => {
        const generoFila = fila.cells[5].textContent.trim(); // Asegúrate de quitar espacios en blanco

        // Compara el género de la fila con el género seleccionado
        if (generoSeleccionado === '0' || generoSeleccionado === generoFila) {
            fila.style.display = 'table-row'; // Muestra la fila que coincide con el género
        } else {
            fila.style.display = 'none'; // Oculta las filas que no coinciden con el género
        }
    });
});

/**editar */

// Obtén todos los botones de editar
const botonesEditar = document.querySelectorAll('button');

// Obtén el cuadro modal y el contenido del modal
const modal = document.getElementById('modal');
const modalImg = document.getElementById('modalImg');
const modalTitulo = document.getElementById('modalTitulo');
const modalArtista = document.getElementById('modalArtista');
const modalAnio = document.getElementById('modalAnio');
const modalGenero = document.getElementById('modalGenero');

// Añade un listener para el evento click a cada botón de editar
botonesEditar.forEach((boton) => {
  boton.addEventListener('click', function (event) {
    // Evita que el enlace del botón provoque la navegación
    event.preventDefault();

    // Obtén la fila padre del botón presionado
    const fila = event.target.closest('tr');

    // Obtén la información de la fila seleccionada
    const imagenSrc = fila.querySelector('img').src;
    const titulo = fila.querySelector('td:nth-child(3)').textContent;
    const artista = fila.querySelector('td:nth-child(4)').textContent;
    const anio = fila.querySelector('td:nth-child(5)').textContent;
    const genero = fila.querySelector('td:nth-child(6)').textContent;

    // Muestra la información en el cuadro modal
    modalImg.src = imagenSrc;
    modalTitulo.textContent = `Título: ${titulo}`;
    modalArtista.textContent = `Artista: ${artista}`;
    modalAnio.textContent = `Año: ${anio}`;
    modalGenero.textContent = `Género: ${genero}`;

    // Muestra el cuadro modal
    modal.style.display = 'block';
  });
});

// Añade un listener para el evento click al botón de cerrar dentro del modal
const closeModalButton = document.querySelector('.close');
closeModalButton.addEventListener('click', function () {
  modal.style.display = 'none';
});

// Añade un listener para el evento click al botón de cerrar fuera del modal
window.addEventListener('click', function (event) {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
});

// Añade un listener para el evento click al botón de cerrar dentro del modal
const closeButton = document.getElementById('closeButton');
closeButton.addEventListener('click', function () {
  modal.style.display = 'none';
});

//Para la ventana modal



