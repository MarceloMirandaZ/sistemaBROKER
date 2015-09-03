<?php
/**
 * Description of logincontrolador
 *
 * @author dev
 */
require_once '../../core/Controlador.php';
$clase="usuarios";
class usuarioscontrolador extends Controlador
{
    //put your code here
    var $modelo;
    var $controlador;
    var $path;
    function modelo($param) 
    {
        $this->controlador=$param."controlador";
        $this->path='aplicacion/'.$param.'/'.$this->controlador.'.php';
        return $this->modelo=$param."modelo";    
    }
    function formulario($valores='') 
    {
                
        $this->elementosAjax($this->path.'?seccion=datos','galeria','Registre los usuarios');
        $this->componente('texto', 'Nombre y Apellidos:',''.@$valores[0]);
        $this->componente('texto', 'Usuario:',''.@$valores[1]);
        $this->componente('clave', 'Clave:',''.rand(1, date("Ymd")));
        $this->componente('email', 'Email:',''.@$valores[3]);
        $this->componente('oculto', '','09');
        $this->componente('oculto','','INEN');
        $this->componente('botonRun','','Registrar');
        //---------------------grid-----------------
        $this->grid();
     
    }
    function grid()
    {
          
        //---------------------grid-----------------
        $grid=$this->HelpGridTable();
        $grid->gridTable('personal');
        $grid->path=  $this->path.'?seccion=grid';//direccion donde estan los archivos
        $grid->div='galeria';//donde se va cargar en la vista
        $grid->limit=10;
        $grid->initPage();//iniciamos la paginación de la tabla 
        //carecteristicas del grid o que datos quiero que salgan
        $grid->Titulo='Usuarios Registrados';//titulo de la pagina
        $grid->setTitulos('#','idpersonal'); 
        $grid->setTitulos('Nombre','nombre'); 
        $grid->setTitulos('Usuario','usuario'); 
        $grid->setTitulos('Cargo  ','cargo'); 
        $grid->setTitulos('Email  ','email'); 
        $grid->gridShow();       
    }
    function datos()
    {
        $data = $this->fuenteDatos();//recibo los datos
        require_once './usuariosmodelo.php';
        $modelo= new usuariosmodelo();
        $modelo->loadData($data->bandera, $data->salida);
        $modelo->registrar();
        $this->formulario($data->salida);
    }
}

$controlador=$clase."controlador";
$objecto = new $controlador();
$funcion="".@$_GET['seccion'];
if($funcion=="")
{}  else {
    $objecto->modelo($clase);
$objecto->$funcion();    
}
?>