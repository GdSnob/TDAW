<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of conecta
 *
 * @author LENOVO
 */
class Conecta {

    //Creamos un método estático que no necesita ser instanciado
    public static function conexion() {
        //new mysqli creamos o instanciamos el objeto mysqli
        //new mysqli('servidor','usuario','contraseña','nombre de la BD');
        $conexion = new mysqli("localhost", "userestancias", "estancias.user", "estancias_db");
        if ($conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: " . $conexion->connect_error;
        }
        //llamamos a la conexión y hacemos una consulta para utilizar UTF-8
        $conexion->query("SET NAMES 'utf8'");
        //devolvemos la conexión para que pueda ser utilizada en otros métodos
        return $conexion;
    }
}