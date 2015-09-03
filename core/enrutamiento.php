<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of enrutamiento
 *
 * @author Cristian
 * @name enrutamiento, clase destinada a crear menu de navegacion
 */
class enrutamiento 
{
    //put your code here
function redireccionar($pagina)
{
        ?>	
                    <script language='JavaScript' type='text/javascript'>

                    setTimeout ('redireccionar("<?php echo $pagina;?>")', 1);
                    function redireccionar(pagina) 
                    {
                    location.href=pagina;
                    } 

                    </script>
        <?php
}
function getRealIP() {


    if (!empty($_SERVER['HTTP_CLIENT_IP']))


        return $_SERVER['HTTP_CLIENT_IP'];

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))

        return $_SERVER['HTTP_X_FORWARDED_FOR'];

    return $_SERVER['REMOTE_ADDR'];

}
function index() 
{@session_start ();}

function set($nombre, $valor) 
{
    $this->index();
@$_SESSION [$nombre] = $valor;
}

function get($nombre) 
{
        $this->index();
        if (isset ($_SESSION [$nombre] )) 
            {
        return @$_SESSION [$nombre];
        } else {
        return false;
        }
}
 function borrar_variable($nombre) {
     unset($nombre);
}
 function borrarsesion() {
 $this->index();
@$_SESSION = array();
session_destroy ();
}

}
