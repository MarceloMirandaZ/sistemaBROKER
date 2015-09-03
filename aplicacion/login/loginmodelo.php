<?php
require_once '../../core/crudDatos.php';
class loginmodelo extends crudDatos
{
    var $bandera=false;
    var $dataSource;
    function setBandera($estado) 
    {
        $this->bandera=$estado;
    }
    function getBandera()
    {
        return $this->bandera;
    }
    function setdataSource($data)
    {
        $this->dataSource=$data;
    }
    function getdataSource()
    {
        return $this->dataSource;
    }
    //put your code here
    function validarUsuario($param, $bandera) 
    {
      if($bandera)
      {
          //$this->mensajesUi()->mensaje('esto es parametro'.$param[2]);    
          $this->preparar('select * from vista_permiso_personal where usuario=? and clave=? and alias_empresa=?');
          $this->autoSetParametros($param);
          $this->ejecutarSql($param[2]);
          $this->GetdatosSql();
         //$this->mensajesUi()->mensaje(''.$this->salida->permisos);
         
         $this->setBandera($this->validarDatos($this->salida));
         if($this->getBandera()){
             $this->setdataSource($this->salida);
         }else{
             $this->setdataSource('');
         }
      }else{
          
           $this->setBandera(false);
      }
    }
}
