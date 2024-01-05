<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <title></title>
    </head>
    <body>
        <nav class="navbar  bg-primary sticky-top navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row mb-3">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="resources/images/banner1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="resources/images/banner2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="resources/images/banner3.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>


            <div class="row row-cols-1 row-cols-md-3 g-4 mb-3">
                <?php foreach ($listaCasas as $casa) { ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($casa['c_foto']); ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center text-uppercase"><?php echo $casa['c_direccion']; ?></h5>
                                <p class="card-text text-lowercase"><?php echo $casa['descripcion']; ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fa-solid fa-bed"></i> <?php echo $casa['habitaciones']; ?> habitación(es)</li>
                                <li class="list-group-item"><i class="fa-solid fa-hand-holding-dollar"></i> <?php echo $casa['costo']; ?>  por día</li>
                            </ul>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal" data-casaid="<?php echo $casa['idcasa']; ?>"> 
                                    Reservar 
                                </button>
                                <span aria-hidden="true"> </span>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalCasa<?php echo $casa['idanfitrion']; ?>"> 
                                    Ver detalle 
                                </button>
                            </div>
                            <div class="card-footer text-body-secondary">
                                RH inmuebles
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <?php
                    $idCasa = "modalCasa" . $casa['idanfitrion'];
                    $labelCasa = "modalCasaLabel" . $casa['idanfitrion'];
                    ?>
                    <div class="modal fade" id="<?php echo $idCasa; ?>" tabindex="-1"  aria-labelledby=""<?php echo $labelCasa; ?>"" aria-hidden="true">';
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="<?php $idCasa; ?>"> Datos del anfitrión</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img  class="img-fluid" src="<?php echo "data:image/jpeg;base64," . base64_encode($casa['a_foto']); ?>"/>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i class="fa-solid fa-envelope"></i> Correo: <?php echo $casa['f_email']; ?></li>
                                        <li class="list-group-item"><i class="fa-solid fa-children"></i> Número de hijos:  <?php echo $casa['numerohijos']; ?></li>
                                        <li class="list-group-item"><i class="fa-solid fa-person-arrow-up-from-line"></i> Edad del hijo mayor:  <?php echo $casa['hijomayor']; ?></li>
                                        <li class="list-group-item"><i class="fa-solid fa-person-arrow-down-to-line"></i> Edad del hijo menor:  <?php echo $casa['hijomenor']; ?></li>
                                    </ul>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>


        <div class="modal fade" id="loginModal" tabindex="-1"  aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h4>Login</h4>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <form action="controller/ReservacionController.php" method="POST">
                                <div class="form-group mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Tu direccion de correo...">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="number" class="form-control" name="idusuario" id="idusuario" placeholder="Número de usuario">                                      
                                </div>
                                <input type="hidden"  name="idcasa" id="casa" value="">

                                <input type="submit" class="btn btn-info btn-block btn-round mb-3" value="Login">
                            </form>

                            <div class="text-center text-muted delimiter mb-3">o usa tus redes sociales</div>
                            <div class="d-flex justify-content-center social-buttons mb-3">
                                <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                                    <i class="fab fa-facebook"></i>
                                </button>
                                <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                    <i class="fab fa-linkedin"></i>
                                </button>
                                </di>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <div class="signup-section">Aun no eres miembro? <a href="#a" class="text-info"> Ingresar</a>.</div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">

            const myModal = document.getElementById('loginModal');


            myModal.addEventListener('shown.bs.modal', (e) => {
               let idCasa = e.relatedTarget.dataset.casaid;
                //asignar el valor a un campo
               document.getElementById('casa').value = idCasa;
   
            });
        </script>
    </body>    
</html>
