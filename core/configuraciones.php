<?php
// esta son las  configuraciones para el sistema

class config 
{
    
/**
 * nombre del host
*/
 var $host = "localhost";
    //var $host = "localhost";
/**
 * nombre de la base de datos
*/
var  $bd;
/**
 * el usuario con permisos
*/
 var  $usuario="root";
/**
* password
 */
 var $pass="tailoredapptech2015";
 /**
  * aplicacion
  */
 var $aplicacion="login";
 function que_base($base){
     $this->bd=$base;
    }
 function index()
 {
	$dato= array();
	$dato[0]= $this->host;
	$dato[1]= $this->bd;
	$dato[2]= $this->usuario;
	$dato[3]= $this->pass;
        $dato[4]=$this->aplicacion;
	return $dato;
	 
 }
 function conexion_local() 
 {
     $dato= array();
	$dato[0]= 'localhost';
	$dato[1]= $this->bd;
	$dato[2]= $this->usuario;
	$dato[3]= $this->pass;
        $dato[4]=$this->aplicacion;
	return $dato;
 }

}
?>
