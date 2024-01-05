<?php

require_once("../db/Conecta.php");
require_once("../model/Reservacion.php");
require_once("../model/Casa.php");
$idpersona = isset($_POST["idpersona"]) ? htmlspecialchars($_POST["idpersona"]) : "";
$idanfitrion = isset($_POST["idanfitrion"]) ? htmlspecialchars($_POST["idanfitrion"]) : "";
$idcasa = isset($_POST["idcasa"]) ? htmlspecialchars($_POST["idcasa"]) : "";
$costo = isset($_POST["costo"]) ? htmlspecialchars($_POST["costo"]) : "";
$fechainicio = isset($_POST["fechainicio"]) ? htmlspecialchars($_POST["fechainicio"]) : "";
$fechafin = isset($_POST["fechafin"]) ? htmlspecialchars($_POST["fechafin"]) : "";

$reservacion = new Reservacion();

$nuevocosto = $costo * dateDifference($fechainicio, $fechafin);

$id = $reservacion->creaReservacion($idcasa, $idanfitrion, $idpersona, $nuevocosto, $fechainicio, $fechafin);

 if(isset($id)){
     $nuevareservacion = $reservacion->getReservacionById($id);
     require_once("../view/ExitoView.php"); 
    
 }else{
      require_once("../view/ErrorView.php");
 }

 function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}