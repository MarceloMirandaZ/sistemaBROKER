<?php
include_once '../../../core/conexionModelo.php';
header('Content-type: application/json');
//$tamaño = $_POST["elemento_4"];
        for($i=5;$i<7;$i++){
            
            $dotos_recividos[$i] = $_POST["elemento_".$i];
        }

        $que_base="broker";
        $insertar="INSERT INTO";
        $tabla="permiso_personal";
        $cn= new conexion();
        $datos_tabla="(personal, permiso)";

           $datos_insertar="VALUES (".$dotos_recividos[5][0].",".$dotos_recividos[6][0].")"; 
           $sql_insert="".$insertar." ".$tabla." ".$datos_tabla." ". $datos_insertar."";
           $cn->sql($sql_insert, $que_base);
           echo json_encode($sql_insert);

?>

