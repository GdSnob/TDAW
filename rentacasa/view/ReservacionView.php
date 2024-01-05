<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reservación</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS de Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 
    </head>
    <body>

        <div class="container">
            <div class="row">
                <h1>
                    <?php
                    echo $mensaje;
                    ?>

                </h1>
            </div>
            <div class="row">
                <form action="../controller/ConfirmacionController.php" method="POST">
                    <input type="hidden"  name="idpersona" id="persona" value="<?php echo $usuario['idpersona']; ?>">
                    <input type="hidden"  name="idcasa" id="casa" value="<?php echo $rentar['idcasa']; ?>">
                    <input type="hidden"  name="idanfitrion" id="anfitrion" value="<?php echo $rentar['idanfitrion']; ?>">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Correo</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $usuario['email']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="<?php echo $usuario['nombre']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Dirección</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="" value="<?php echo $usuario['direccion']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Dirección de la casa</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Departamenteo, estudio piso" value="<?php echo $rentar['colonia'] . ' ' . $rentar['calle'] . ' ' . $rentar['numero']; ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputCity">Municipio/Delegación</label>
                            <input type="text" class="form-control" id="inputCity" value="<?php echo $rentar['municipio']; ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">Estado</label>
                            <input type="text" class="form-control" id="inputState" value="<?php echo $rentar['estado']; ?>">

                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Codigo Postal</label>
                            <input type="text" class="form-control" id="inputZip" value="<?php echo $rentar['cp']; ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="costo">Costo</label>
                            <input type="text" class="form-control" id="costo" name="costo" value="<?php echo $rentar['costo']; ?>">
                        </div>                  
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fechaini">Fecha de inicio</label>
                            <input type="date" class="form-control" id="fechainicio" name="fechainicio" required="true">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fechafin">FechaFin</label>
                            <input type="date" class="form-control" id="fechafin" name="fechafin" required="true">

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Aceptar
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Reservar</button>
                </form>

            </div>
        </div>
    </body>
</html>
