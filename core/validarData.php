<?php
/**
 * Description of validarData
 *
 * @author dev
 */
require_once '../../core/crudDatos.php';
class validarData extends crudDatos {
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
    function validarRegistro($param, $bandera,$tabla='',$comodin='') 
    {
      if($bandera)
      {
          $this->preparar('select * from '.$tabla.' where '.$comodin);
          $this->autoSetParametros($param);
          $this->ejecutarSql();
          $this->GetdatosSql();
         // $this->mensajesUi()->mensaje(''.$this->salida->nombre);
         
         $this->setBandera($this->validarDatos($this->salida));
         if($this->getBandera()){
             return 0;
         }else{
             return 1;
         }
      }else{
          
          return 0;
      }
    }
}
