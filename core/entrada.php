<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entrada
 *
 * @author Cristian
 */
class entrada {
    //put your code here
    var $objecto;
    var $bandera;
    var $salida;
    function saludar() {
        echo 'Validando datos';
    }
    function entrada() {
        $this->setParamentrosPost();
    }
    function setParamentrosPost() 
    {
        require_once '../../core/parametros.php';
        $negocios = new parametros();
        $parametros=$negocios->getPost();
        
        $this->objecto=$parametros;
        $this->bandera=$this->validarBlancos();
       if($this->bandera)
       {
             $this->salida=$parametros;;
       }else{
           $this->salida="";
       }
   
    }
    function validarBlancos()
    {
        require_once '../../core/parametros.php';
        $negocios = new parametros();
         return $negocios->depurarInputBlancos($this->objecto);
    }
    function tieneDatos($data)
    {
        require_once '../../core/parametros.php';
        $negocios = new parametros();
         return @$negocios->validarVariable($data);
    }

    function imprimirPost() 
    {
        require_once '../../core/parametros.php';
        $negocios = new parametros();
        $negocios->traceArray($this->objecto);
        
    }

}
