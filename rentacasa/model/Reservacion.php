<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Anfitrion
 *
 * @author Yeoshua
 */
class Reservacion {
    //put your code here
    private $db;
 
    public function __construct(){
        $this->db=Conecta::conexion();
    }
    
    public function creaReservacion( $idcasa,$idanfitrion, $idpersona, $costo, $fechaingreso, $fechasalida){
        $consulta= "INSERT INTO reservacion(idcasa,idanfitrion,idpersona,costo,fechaingreso,fechasalida) VALUES($idcasa,$idanfitrion,$idpersona,$costo,'$fechaingreso','$fechasalida');";
        
         if( $this->db->query($consulta)) {
           $nuevoid = $this->db->insert_id;
        }         
        return $nuevoid;
    }
    
    public function getReservacionById($idreservacion){
       $consulta=$this->db->query("SELECT r.idreservacion, concat(p.nombre,' ',p.apellidop,' ', p.apellidom) p_nombre, p.email f_email, concat(c.estado,' ',c.municipio,' ',c.cp,' ',c.colonia, ' ',c.calle,' ',c.numero) c_direccion,
            concat(anf.nombre,' ',anf.apellidop,' ', anf.apellidom) f_nombre, r.costo, DATE_FORMAT(r.fechaingreso,'%d/%m/%Y') ingreso,DATE_FORMAT(r.fechasalida,'%d/%m/%Y') salida
            FROM reservacion r INNER JOIN persona p ON r.idpersona = p.idpersona
            INNER JOIN anfitrion a ON r.idanfitrion = a.idanfitrion
            INNER JOIN persona anf on  a.idpersona = anf.idpersona
            INNER JOIN casa c ON r.idcasa=c.idcasa WHERE r.idreservacion=$idreservacion;");

        if($filas=$consulta->fetch_assoc()){
            $result=$filas;
        }
        return $result;
    }
}
