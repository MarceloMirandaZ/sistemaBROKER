<?php

/**
 * Description of logincontrolador
 *
 * @author dev
 */
require_once '../../core/Controlador.php';
$clase = "ragistro";

class operacioncontrolador extends Controlador {

    //put your code here
    var $modelo;
    var $controlador;
    var $path;

    function modelo($param) {
        $this->controlador = $param . "controlador";
        $this->path = 'aplicacion/' . $param . '/' . $this->controlador . '.php';
        return $this->modelo = $param . "modelo";
    }

    function grid() {

        //---------------------grid-----------------
        $grid = $this->HelpGridTable();
        $grid->gridTable('personal');
        $grid->path = $this->path . '?seccion=grid'; //direccion donde estan los archivos
        $grid->div = 'tabla_personal'; //donde se va cargar en la vista
        $grid->limit = 10;
        $grid->initPage(); //iniciamos la paginación de la tabla 
        //carecteristicas del grid o que datos quiero que salgan
        $grid->Titulo = 'Usuarios Registrados'; //titulo de la pagina
        $grid->setTitulos('#', 'idpersonal');
        $grid->setTitulos('Nombre', 'nombre');
        $grid->setTitulos('email  ', 'email');
        $grid->setTitulos('Usuario', 'usuario');
        $grid->setTitulos('clave', 'clave');
        $grid->setTitulos('cargo', 'cargo');
        $grid->setTitulos('empresa', 'empresa');
        $grid->setTitulos('permiso', 'estado');
        $grid->setTitulos('estado', 'estado');
        $grid->gridShow();
    }

    function datos() {
        $data = $this->fuenteDatos(); //recibo los datos
          require_once './registromodelo.php';
          $modelo= new operacionmodelo();
          $modelo->loadData($data->bandera, $data->salida);
          $modelo->registrar();
          //$this->formulario($data->salida);
      
    }

}

$controlador = $clase . "controlador";
$objecto = new $controlador();
$funcion = "" . @$_GET['seccion'];
if ($funcion == "") {
    
} else {
    $objecto->modelo($clase);
    $objecto->$funcion();
}
?>