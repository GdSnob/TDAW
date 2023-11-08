// Definición de la clase Box para representar una casilla en el juego
class Box {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }

  // Métodos para obtener las casillas adyacentes
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

  // Método para obtener todas las casillas adyacentes válidas
  getNextdoorBoxes() {
    return [
      this.getTopBox(),
      this.getRightBox(),
      this.getBottomBox(),
      this.getLeftBox()
    ].filter(box => box !== null);
  }

  // Método para obtener una casilla adyacente aleatoria
  getRandomNextdoorBox() {
    const nextdoorBoxes = this.getNextdoorBoxes();
    return nextdoorBoxes[Math.floor(Math.random() * nextdoorBoxes.length)];
  }
}

// Función para intercambiar dos casillas en la cuadrícula
const swapBoxes = (cuadricula, box1, box2) => {
  const temp = cuadricula[box1.y][box1.x];
  cuadricula[box1.y][box1.x] = cuadricula[box2.y][box2.x];
  cuadricula[box2.y][box2.x] = temp;
};

// Función para verificar si la cuadrícula está resuelta (en el estado final)
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

  // Mezclar la cuadrícula
  let blankBox = new Box(3, 3);
  for (let i = 0; i < 1000; i++) {
    const randomNextdoorBox = blankBox.getRandomNextdoorBox();
    swapBoxes(cuadricula, blankBox, randomNextdoorBox);
    blankBox = randomNextdoorBox;
  }

  // Si la cuadrícula generada está resuelta, obtener otra
  if (isSolved(cuadricula)) return getRandomCuadricula();
  return cuadricula;
};

// Clase que representa el estado del juego
class State {
  constructor(cuadricula, move, time, status) {
    this.cuadricula = cuadricula;
    this.move = move;
    this.time = time;
    this.status = status;
  }

  // Método estático para crear un estado inicial listo para jugar
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

  // Método estático para crear un estado de juego al comenzar
  static start() {
    return new State(getRandomCuadricula(), 0, 0, "playing");
  }
}

// Clase principal que controla el juego
class Game {
  constructor(state) {
    this.state = state;
    this.tickId = null;
    this.tick = this.tick.bind(this);
    this.render();
    this.handleClickBox = this.handleClickBox.bind(this);
  }

  // Método estático para crear un juego listo para jugar
  static ready() {
    return new Game(State.ready());
  }

  // Función para actualizar el tiempo en el juego
  tick() {
    this.setState({ time: this.state.time + 1 });
  }

  // Función para actualizar el estado del juego
  setState(newState) {
    this.state = { ...this.state, ...newState };
    this.render();
  }

  // Manejador de clic en una casilla
  handleClickBox(box) {
    return () => {
      const nextdoorBoxes = box.getNextdoorBoxes();
      const blankBox = nextdoorBoxes.find(
        nextdoorBox => this.state.cuadricula[nextdoorBox.y][nextdoorBox.x] === 0
      );
      if (blankBox) {
        const newCuadricula = [...this.state.cuadricula];
        swapBoxes(newCuadricula, box, blankBox);
        if (isSolved(newCuadricula)) {
          clearInterval(this.tickId);
          this.setState({
            status: "won",
            cuadricula: newCuadricula,
            move: this.state.move + 1
          });
        } else {
          this.setState({
            cuadricula: newCuadricula,
            move: this.state.move + 1
          });
        }
      }
    };
  }

  // Función para renderizar el juego en la página
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

    const newButton = document.createElement("button");
    if (status === "ready") newButton.textContent = "Jugar";
    if (status === "playing") newButton.textContent = "Reiniciar";
    if (status === "won") newButton.textContent = "Jugar";
    newButton.addEventListener("click", () => {
      clearInterval(this.tickId);
      this.tickId = setInterval(this.tick, 1000);
      this.setState(State.start());
    });

    const currentButton = document.querySelector(".footer button");
    currentButton.parentNode.replaceChild(newButton, currentButton);

    document.getElementById("Movimientos").textContent = `Movimientos: ${move}`;
    document.getElementById("Tiempo").textContent = `Tiempo: ${time}`;

    if (status === "won") {
      clearInterval(this.tickId);
      const tiempoFinal = document.getElementById("TiempoFinal");
      tiempoFinal.textContent = `${time} segundos`;
    }
  }
}

// Crear una instancia del juego listo para jugar
const juego = Game.ready();
