// Definición de la clase Box para representar una caja en el juego
class Box {
    constructor(x, y) {
        this.x = x;
        this.y = y;
    }

    // Métodos para obtener cajas adyacentes en la cuadrícula
    getTopBox() {
        if (this.y === 0) return null;
        return new Box(this.x, this.y - 1);
    }

    getRightBox() {
        if (this.x === 3) return null;
        return new Box(this.x + 1, this.y);
    }

    getBottomBox() {
        if (this.y === 3) return null;
        return new Box(this.x, this.y + 1);
    }

    getLeftBox() {
        if (this.x === 0) return null;
        return new Box(this.x - 1, this.y);
    }

    // Método para obtener cajas adyacentes válidas
    getNextdoorBoxes() {
        return [
            this.getTopBox(),
            this.getRightBox(),
            this.getBottomBox(),
            this.getLeftBox()
        ].filter(box => box !== null);
    }

    // Método para obtener una caja adyacente al azar
    getRandomNextdoorBox() {
        const nextdoorBoxes = this.getNextdoorBoxes();
        return nextdoorBoxes[Math.floor(Math.random() * nextdoorBoxes.length)];
    }
}

// Función para intercambiar dos cajas en la cuadrícula
const swapBoxes = (cuadricula, box1, box2) => {
    const temp = cuadricula[box1.y][box1.x];
    cuadricula[box1.y][box1.x] = cuadricula[box2.y][box2.x];
    cuadricula[box2.y][box2.x] = temp;
};

// Función para verificar si la cuadrícula resuelve el juego
const isSolved = cuadricula => {
    return (
        cuadricula[0][0] === 1 &&
        cuadricula[0][1] === 2 &&
        cuadricula[0][2] === 3 &&
        cuadricula[0][3] === 4 &&
        cuadricula[1][0] === 5 &&
        cuadricula[1][1] === 6 &&
        cuadricula[1][2] === 7 &&
        cuadricula[1][3] === 8 &&
        cuadricula[2][0] === 9 &&
        cuadricula[2][1] === 10 &&
        cuadricula[2][2] === 11 &&
        cuadricula[2][3] === 12 &&
        cuadricula[3][0] === 13 &&
        cuadricula[3][1] === 14 &&
        cuadricula[3][2] === 15 &&
        cuadricula[3][3] === 0
    );
};

// Función para obtener una cuadrícula aleatoria 
const getRandomCuadricula = () => {
    let cuadricula = [
        [1, 2, 3, 4],
        [5, 6, 7, 8],
        [9, 10, 11, 12],
        [13, 14, 15, 0]
    ];
    let blankBox = new Box(3, 3);
    for (let i = 0; i < 1000; i++) {
        const randomNextdoorBox = blankBox.getRandomNextdoorBox();
        swapBoxes(cuadricula, blankBox, randomNextdoorBox);
        blankBox = randomNextdoorBox;
    }
    // Si la cuadrícula generada inicialmente resuelve el juego, vuelve a intentarlo
    if (isSolved(cuadricula)) return getRandomCuadricula();
    return cuadricula;
};

// Definición de la clase State para representar el estado del juego
class State {
    constructor(cuadricula, move, time, status) {
        this.cuadricula = cuadricula;
        this.move = move;
        this.time = time;
        this.status = status;
    }

    // Método estático para obtener un estado listo para jugar
    static ready() {
        return new State(
            [
                [0, 0, 0, 0],
                [0, 0, 0, 0],
                [0, 0, 0, 0],
                [0, 0, 0, 0]
            ],
            0,
            0,
            "ready"
        );
    }

    // Método estático para obtener un estado al iniciar un nuevo juego
    static start() {
        return new State(getRandomCuadricula(), 0, 0, "playing");
    }
}

// Definición de la clase Game para representar el juego y su lógica
class Game {
    constructor(state) {
        this.state = state;
        this.tickId = null;
        this.tick = this.tick.bind(this);
        this.render();
        this.handleClickBox = this.handleClickBox.bind(this);
    }

    // Método estático para obtener un juego listo para jugar
    static ready() {
        return new Game(State.ready());
    }

    // Método para actualizar el tiempo en el estado del juego
    tick() {
        this.setState({ time: this.state.time + 1 });
    }

    // Método para establecer un nuevo estado y renderizar el juego
    setState(newState) {
        this.state = { ...this.state, ...newState };
        this.render();
    }

    // Método para manejar el clic en una caja del juego
    handleClickBox(box) {
        return () => {
            const nextdoorBoxes = box.getNextdoorBoxes();
            const blankBox = nextdoorBoxes.find(
                nextdoorBox => this.state.cuadricula[nextdoorBox.y][nextdoorBox.x] === 0
            );
            if (blankBox) {
                const newCuadricula = [...this.state.cuadricula];
                swapBoxes(newCuadricula, box, blankBox);
                // Si la cuadrícula resuelve el juego, detén el temporizador y establece el estado como "ganado"
                if (isSolved(newCuadricula)) {
                    clearInterval(this.tickId);
                    this.setState({
                        status: "won",
                        cuadricula: newCuadricula,
                        move: this.state.move + 1
                    });
                } else {
                    // Si no se resuelve, actualiza la cuadrícula y el número de movimientos
                    this.setState({
                        cuadricula: newCuadricula,
                        move: this.state.move + 1
                    });
                }
            }
        };
    }

    // Método para renderizar el juego 
    render() {
        const { cuadricula, move, time, status } = this.state;
        const newCuadricula = document.createElement("div");
        newCuadricula.className = "cuadricula";
        for (let i = 0; i < 4; i++) {
            for (let j = 0; j < 4; j++) {
                const button = document.createElement("button");
                if (status === "playing") {
                    button.addEventListener("click", this.handleClickBox(new Box(j, i)));
                }
                button.textContent = cuadricula[i][j] === 0 ? "" : cuadricula[i][j].toString();
                newCuadricula.appendChild(button);
            }
        }
        const currentCuadricula = document.querySelector(".cuadricula");
        currentCuadricula.parentNode.replaceChild(newCuadricula, currentCuadricula);

        // Crear un nuevo botón y asignar eventos según el estado del juego
        const newButton = document.createElement("button");
        if (status === "ready") newButton.textContent = "Jugar";
        if (status === "playing") newButton.textContent = "Reiniciar";
        if (status === "won") newButton.textContent = "Jugar";
        newButton.addEventListener("click", () => {
            clearInterval(this.tickId);
            // Iniciar el temporizador y establecer el estado al iniciar un nuevo juego
            this.tickId = setInterval(this.tick, 1000);
            this.setState(State.start());
        });

        // Reemplazar el botón actual con un nuevo botón
        const currentButton = document.querySelector(".footer button");
        currentButton.parentNode.replaceChild(newButton, currentButton);

        // Actualizar los elementos de texto información del juego
        document.getElementById("Movimientos").textContent = `Movimientos: ${move}`;
        document.getElementById("Tiempo").textContent = `Tiempo: ${time}`;
    }
}

// Crear una instancia del juego y prepararlo para jugar
const juego = Game.ready();
