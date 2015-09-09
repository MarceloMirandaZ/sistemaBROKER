<?php
include_once '../../../core/conexionModelo.php';
header('Content-type: application/json');
//$tamaño = $_POST["elemento_4"]; 

        for($i=0;$i<8;$i++){
            
            $dotos_recividos[$i] = $_POST["elemento_".$i];
        }

        $que_base="broker";
        $insertar="INSERT INTO";
        $tabla="cliente_persona";
        $cn= new conexion();
        $datos_tabla="(idcliente_persona, cedula, nombre, apellido, direccion, telefono_fijo, telefono_movil, email, estado)";
     
        $datos_insertar="VALUES (NULL,'".$dotos_recividos[0]."','".$dotos_recividos[1]."','".$dotos_recividos[2]."','".$dotos_recividos[3]."','".$dotos_recividos[4]."','".$dotos_recividos[5]."','".$dotos_recividos[6]."',".$dotos_recividos[7][0].")"; 
        
        $sql_insert="".$insertar." ".$tabla." ".$datos_tabla." ". $datos_insertar."";
        $cn->sql($sql_insert, $que_base);
        
        echo json_encode("datos guardados");
?>

