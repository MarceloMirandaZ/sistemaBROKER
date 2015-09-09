<?php
include_once '../../../core/conexionModelo.php';
        for($i=0;$i<18;$i++){
            header('Content-type: application/json');
            $dotos_recividos[$i] = $_POST["elemento_".$i];
        }

        $que_base="broker";
        $insertar="INSERT INTO";
        $tabla="personal";

        $datos_tabla="(idpersonal, cedula, nombre, apellido, email, direccion, telefono, cargo, usuario, clave, estado, alias_empresa, tipo_cuenta, nom_banco, num_cuenta, tipo_sangre, nom_contacto, parentezco, telf_contacto)";
        
       
        $datos_insertar="VALUES (NULL, '".$dotos_recividos[0]."','".$dotos_recividos[1]."','".$dotos_recividos[2]."','".$dotos_recividos[3]."','".$dotos_recividos[4]."','".$dotos_recividos[5]."',".$dotos_recividos[6][0].",'".$dotos_recividos[7]."','".$dotos_recividos[8]."',".$dotos_recividos[9][0].",'".$dotos_recividos[10]."','".$dotos_recividos[10]."','".$dotos_recividos[11]."','".$dotos_recividos[12]."','".$dotos_recividos[13]."','".$dotos_recividos[14]."','".$dotos_recividos[15]."','".$dotos_recividos[16]."')";
        
        $sql_insert="".$insertar." ".$tabla." ".$datos_tabla." ". $datos_insertar."";
        $cn= new conexion();
        $cn->sql($sql_insert, $que_base);
       
        echo json_encode($sql_insert);
        

?>

