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
        $procesar->validarUsuario($data->salida,$data->bandera);//envio a comprobar los datos de la busqueda
        if($procesar->getBandera())
        {
            require_once '../../core/enrutamiento.php';
            $nave = new enrutamiento();
            $nave->set('nombre', ''.utf8_encode($procesar->getdataSource()->nombre));
            $nave->set('usuario', ''.utf8_encode($procesar->getdataSource()->usuario));
            $nave->set('id', ''.utf8_encode($procesar->getdataSource()->idpersonal));
            $nave->set('cargo', ''.utf8_encode($procesar->getdataSource()->cargo));
            $nave->set('empresa', ''.utf8_encode($procesar->getdataSource()->empresa));
            $nave->set('permisos', ''.utf8_encode($procesar->getdataSource()->permisos));
            $nave->set('estado', ''.utf8_encode($procesar->getdataSource()->estado));
            //$this->mensajesUi()->mensaje('Bienvenido '.  utf8_encode($procesar->getdataSource()->nombre));
           $nave->redireccionar('../plantilla/index.html');
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