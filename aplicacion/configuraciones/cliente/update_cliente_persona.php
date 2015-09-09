
<?php
include_once '../../../core/conexionModelo.php';
header('Content-type: application/json');
//$tamaño = $_POST["elemento_4"]; 

        for($i=0;$i<9;$i++){
            
            $dotos_recividos[$i] = $_POST["elemento_".$i];
        }
        $cn= new conexion();    
        $que_base="broker";
        $insertar="UPDATE";
        $tabla="cliente_persona";
        
        $id_tabla="idcliente_persona";
     
        $datos_editar="SET cedula='".$dotos_recividos[0]."',nombre='".$dotos_recividos[1]."',apellido='".$dotos_recividos[2]."',direccion='".$dotos_recividos[3]."',telefono_fijo='".$dotos_recividos[4]."',telefono_movil='".$dotos_recividos[5]."',email='".$dotos_recividos[6]."',estado=".$dotos_recividos[7][0]." WHERE ".$tabla.".".$id_tabla."=".$dotos_recividos[8].""; 
        
        $sql_insert="".$insertar." ".$tabla." ".$datos_editar."";
        $cn->sql($sql_insert, $que_base);
        echo json_encode("datos guardados pertenecientes a:  ".$dotos_recividos[1]." ".$dotos_recividos[2].", con cédula: ".$dotos_recividos[0]);
?>


