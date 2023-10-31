/*
Se obtiene referencias a los elementos del DOM que necesitarás manipular,
como el campo de entrada de texto, el botón de agregar tarea y la lista de tareas.
*/

const entradaTarea = document.getElementById("tarea");
const botonTarea = document.getElementById("agregarTarea");
const listaTareas = document.getElementById("listaTareas");

/*
Esta función toma el texto del campo de entrada, crear un nuevo
elemento de lista (<li>) y lo agrega a la lista de tareas.
*/ 

function agregarElemento() {
    const textoTarea = entradaTarea.value;

    if (textoTarea.trim() !== "") {
        const nuevaTarea = document.createElement("li");
        nuevaTarea.textContent = textoTarea;

        // Agrega un botón de eliminar
        const botonEliminar = document.createElement("button");
        botonEliminar.textContent = "Eliminar";

        // Agrega un listener para eliminar la tarea al hacer clic en el botón
        botonEliminar.addEventListener("click", function () {
            listaTareas.removeChild(nuevaTarea);
        });

        nuevaTarea.appendChild(botonEliminar);

        // Agrega un listener para marcar la tarea como completada al hacer clic en ella
        nuevaTarea.addEventListener("click", function () {
            nuevaTarea.classList.toggle("completada");
        });

        listaTareas.appendChild(nuevaTarea);

        // Limpia el campo de entrada
        entradaTarea.value = "";

    }
}


/*Se agrega un listener para el botón*/

botonTarea.addEventListener("click",agregarElemento);