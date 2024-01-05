<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Casa
 *
 * @author Yeoshua
 */
class Persona {
    //put your code here
    private $db;
    private $persona;
 
    public function __construct(){
        $this->db=Conecta::conexion();
       
    }
    
    public function getPersonaById($idpersona,$email){
        $consulta=$this->db->query("select idpersona, CONCAT(nombre,' ',apellidop,' ', apellidom) nombre, email, CONCAT(estado,' ',municipio,' ',cp,' ',colonia, ' ',calle,' ',numero) direccion from persona where idpersona =$idpersona and email='$email';");
        if($filas=$consulta->fetch_assoc()){
            $this->persona=$filas;
        }
        return $this->persona;
    }
    

}
