    <meta charset="UTF-8">
<?php
/**
 * Description of logincontrolador
 *
 * @author dev
 */
require_once '../../core/formularios.php';
$clase="logincontrolador";
class logincontrolador extends formularios
{
    //put your code here
 
    function datos()
    {
        
        $data = $this->fuenteDatos();//recibo los datos
        $procesar = $this->loadModelo('loginmodelo');//cargo el modelo
        //$data->imprimirPost();
       // $this->mensajesUi()->mensaje('datos'.$data->salida[2]);    
        $procesar->validarUsuario($data->salida,$data->bandera);//envio a comprobar los datos de la busqueda
        if($procesar->getBandera())
        {
            require_once '../../core/enrutamiento.php';
            $nave = new enrutamiento();
            $nave->set('id', ''.utf8_encode($procesar->getdataSource()->idpersonal));
            $nave->set('nombre', ''.utf8_encode($procesar->getdataSource()->nom_personal));
            $nave->set('cargo', ''.utf8_encode($procesar->getdataSource()->cargo));
            //$nave->set('usuario', ''.utf8_encode($procesar->getdataSource()->usuario));
            $nave->set('estado', ''.utf8_encode($procesar->getdataSource()->estado));
            $nave->set('alias', ''.utf8_encode($procesar->getdataSource()->alias_empresa));
            //$nave->set('permiso', ''.utf8_encode($procesar->getdataSource()->permiso));
            //$nave->set('permiso2', ''.utf8_encode($procesar->getdataSource()->permiso[0]));
            //$nave->set('pagina', ''.utf8_encode($procesar->getdataSource()->pagina));
            //$this->mensajesUi()->mensaje('Bienvenido '.  utf8_encode($procesar->getdataSource()->nombre));
           $nave->redireccionar('../vista/plantilla.html');
       }  else {
            $this->mensajesUi()->mensaje('Error el usuario es incorrecto');    
        }

       
    }
}

$objecto = new $clase();
$funcion="".@$_GET['seccion'];
if($funcion=="")
{}  else {
$objecto->$funcion();    
}
?>