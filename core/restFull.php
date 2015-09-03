<?php
require_once './listaModelo.php';
class restFull extends listaModelo
{
    function login() 
    {
        $tabla ='personal';
	$campo ='*';
        $where=' '.$_GET['w'];
        $sql="select ".$campo." from ".$tabla."  ".$where;
 	header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
        $this->getAllDaos($sql);//funcion me devuelve los datos en json 
        
    }
    function limpiarinformacion() 
    {
        require_once 'enrutamiento.php';
        $nave= new enrutamiento();
        header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
       $nave->borrarsesion();
        $data['usuario']='usuario';//nombre del sistema
        $data['id']='';//nombre del sistema
        $data['cargo']="usuario";//nombre del sistema
        $data['empresa']='';
       echo json_encode($data);
    }
    
    function recordSet() 
    {
	$tabla =''.@$_GET['t'];
	$campo =''.@$_GET['c'];
        $where=''.@$_GET['w'];
        require_once './listaModelo.php';
        $lista= new listaModelo();
            $sql="select ".$campo." from ".$tabla."  ".$where;
 	header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
         $lista->cargarDatos(utf8_decode($sql), ''.$campo);//funcion me devuelve los datos en json 
    }
    function Query() 
    {
	$tabla =''.@$_GET['t'];
        $where=''.@$_GET['w'];
        require_once './listaModelo.php';
        $lista= new listaModelo();
        $sql= utf8_decode("select * from ".$tabla."  ".$where);
 	header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
        $lista->getAllDatos($sql);//funcion me devuelve los datos en json 
    }
    function recordSetSincronizado() 
    {
	$tabla =''.@$_GET['t'];
	$campo =''.@$_GET['c'];
        $where=''.@$_GET['w'];
        $comodin=''.@$_GET['dato'];
        require_once './listaModelo.php';
        $lista= new listaModelo();

        $sql="select ".$campo." from ".$tabla."  ".$where."='".$comodin."' group by ".$campo;
        //echo $sql;
 	header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
       $lista->cargarDatos(utf8_decode($sql), ''.$campo);//funcion me devuelve los datos en json 
    }  
}
$objecto = new restFull();
if(@$_GET['api']=="")
{
    
}else
    {
    $funcion=@$_GET['api'];
    $objecto->$funcion();
    }
?>
