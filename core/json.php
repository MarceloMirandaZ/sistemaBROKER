<?php
/**
 * esta clase es un generdado de informacion json para que la plataforma pueda emitir información en forma de json
 */

class json
{

    function leerJson() 
    {
    $data = file_get_contents("../parametros/personalizacion.json");
        $products = json_decode($data, true);

foreach ($products as $product) {
    print_r($product);
}    
    }
    
    function informacion() 
    {
        require_once 'enrutamiento.php';
        $nave= new enrutamiento();
        header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
        $data['id']=''.$nave->get('id');//id del sistema
        $data['nombre']=''.$nave->get('nombre');//usuario del sistema
        //$data['usuario']=''.$nave->get('usuario');//usuario del sistema
        $data['cargo']=''.$nave->get('cargo');//cargo
        $data['alias']=''.$nave->get('alias');//cargo
        //$data['permisos']=''.$nave->get('permisos');//cargo
        $data['estado']=''.$nave->get('estado');//cargo
        $data['permiso']=''.$nave->get('permiso');
        //$data['permiso2']=''.$nave->get('permiso2');
        $data['pagina']=''.$nave->get('pagina');

        
       echo json_encode($data);
    }
        function cerrarSeccion() 
    {
        require_once 'enrutamiento.php';
        $nave= new enrutamiento();
        header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
        $nave->borrarsesion();
        $data['usuario']='';//nombre del sistema
        $data['id']='';//nombre del sistema
        $data['cargo']='';//nombre del sistema
        $data['empresa']='';
       echo json_encode($data);
    }
    
        function recordSet() 
    {
        $que_base=''.@$_GET['bd'];
	$tabla =''.@$_GET['t'];
	$campo =''.@$_GET['c'];
        $where=''.@$_GET['w'];
        require_once './listaModelo.php';
        $lista= new listaModelo();
        $sql="select ".$campo." from ".$tabla."  ".$where."";
 	header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
         $lista->cargarDatos(utf8_decode($sql), ''.$campo,$que_base);//funcion me devuelve los datos en json 
         echo json_encode($lista);
    }
    function Query() 
    {
        
        $que_base=''.@$_GET['bd'];
       // echo 'desde json que bd:'.$que_base;
	$tabla =''.@$_GET['t'];
        //$where=''.@$_GET['w'];
        require_once './listaModelo.php';
        $lista= new listaModelo();
        $sql= utf8_decode("select * from ".$tabla);
 	header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
        $lista->getAllDatos($sql,$que_base);//funcion me devuelve los datos en json 
    }
        function recordSetSincronizado() 
    {
        $que_base = ''.@$_GET['bd'];
	$tabla =''.@$_GET['t'];
        //campo "c" se refire a que columna elejir de la tabla
	$campo =''.@$_GET['c'];
        $where=''.@$_GET['w'];
        //comodin "dato" es el filtro de where
        $comodin=''.@$_GET['dato'];
        
        require_once './listaModelo.php';
        $lista= new listaModelo();

        $sql="select ".$campo." from ".$tabla."  ".$where." ".$comodin." group by ".$campo;
      
        //echo $sql;
 	header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
       $lista->cargarDatos(utf8_decode($sql), ''.$campo,$que_base);//funcion me devuelve los datos en json 
    }
    function restFull() 
    {
        $que_base=''.@$_GET['bd'];
        $tabla =''.@$_GET['t'];
	//$campo =''.@$_GET['c'];
        $dato = ''.@$_GET['d'];
        /*if($campo=="")
        {
            $campo="*";
        }else{}*/
        require_once './listaModelo.php';
        $lista= new listaModelo();
        $sql="select * from ".$tabla." where ".$dato."";
 	header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
        $lista->getAllDatos(utf8_decode($sql),$que_base);//funcion me devuelve los datos en json 
        
    }
         

    
}
$objecto = new json();
if(@$_GET['funcion']=="")
{
    
}else
    {
    $funcion=@$_GET['funcion'];
    $objecto->$funcion();
    }
?>
