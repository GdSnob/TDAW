<?php

// incluir librerías
require_once("../db/Conecta.php");
require_once("../model/Persona.php");
require_once("../model/Casa.php");

// leer los elementos del objeto POST
$email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
$idusuario = isset($_POST["idusuario"]) ? htmlspecialchars($_POST["idusuario"]) : "";
$idcasa = isset($_POST["idcasa"]) ? htmlspecialchars($_POST["idcasa"]) : "";

// insertar una cookie 
if (isset($_COOKIE['contador'])) {
    // Caduca en un día
    setcookie('contador', $_COOKIE['contador'] + 1, time() + 24 * 60 * 60);
    $mensaje = 'Número de visitas: ' . $_COOKIE['contador'];
} else {
    // Caduca en un día
    setcookie('contador', 1, time() + 24 * 60 * 60);
    $mensaje = 'Bienvenido a nuestra página web';
}

// obtener los datos del usuario
$persona = new Persona();
$usuario = $persona->getPersonaById($idusuario, $email);

// obtener los datos de la casa
$casa = new Casa();
$rentar = $casa->getCasaById($idcasa);

// si existe el usuario y la casa preparar la reservación, en otro caso mostrar mensaje de error
if (isset($usuario) && isset($rentar)) {
    require_once("../view/ReservacionView.php"); 
} else {
    require_once("../view/ErrorView.php");
}

