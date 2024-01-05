<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

//Llamada al modelo
require_once("model/Casa.php");
$casa = new Casa();
$listaCasas = $casa->getCasas();
//Llamada a la vista
require_once("view/CasaView.php");
