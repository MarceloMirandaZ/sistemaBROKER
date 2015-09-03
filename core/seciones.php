<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seciones
 *
 * @author serverPCW
 */
require_once './enrutamiento.php';
class seciones extends enrutamiento 
{
    var $secion;
    //put your code here
    function secciones() 
    {
        array_push($this->secion, $this->get('usuario'));
        array_push($this->secion, $this->get('id'));
        array_push($this->secion, $this->get('cargo'));
        array_push($this->secion, $this->get('empresa'));
          header('Content-type: application/json');//esta cabecera  nos permite obtener el dato en json
          echo json_encode($this->secion);
          return $this->secion;
    }
    
}
