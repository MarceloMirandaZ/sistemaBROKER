<?php
/**
 * Description of Controlador
 *
 * @author dev
 */
require_once '../../core/formularios.php';
class Controlador extends formularios
{
    function HelpModelos($modelo)
    {
        require_once './'.$modelo.'.php';
        $modelo= new $modelo();
        return $modelo;
    }

    function HelpGridTable()
    {
        require_once '../../core/gridTable.php';
        $grid = new gridTable();
        return $grid;
    }
        function HelpRestFull()
    {
        require_once '../../core/restFull.php';
        $grid = new restFull();
        return $grid;
    }
        function HelpJson()
    {
        require_once '../../core/json.php';
        $grid = new json();
        return $grid;
    }
    function HelpParametros()
    {
        require_once '../../core/parametros.php';
        $grid = new parametros();
        return $grid;
    }
    function HelpArchivos()
    {
        require_once '../../core/archivos.php';
        $grid = new archivos();
        return $grid;
    }
}
