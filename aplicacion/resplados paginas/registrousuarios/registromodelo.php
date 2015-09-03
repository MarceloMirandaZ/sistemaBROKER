<?php
require_once '../../core/crudDatos.php';
class operacionmodelo extends crudDatos
{
    var $bandera;
    var $data;
    var $entidad='personal';
    function loadData($bandera="",$data="")
    {
        $this->bandera=$bandera;
        $this->data=$data;
   
    }
    function registrar()
    {
        //var_dump($this->data);
        if($this->bandera)
        {
        $comodin=' personal=?';
        $data[0]=@$this->data[0];
        $bandera[0]=$this->helpValidar()->validarRegistro($data, $this->bandera,  $this->entidad,$comodin);
       
        //echo "--------->>3=".$bandera[2]."<br>";
        if(($bandera[0]==1))
        {
          $comodin="values (Null,?,?,?,?,?,?,?,?)";
          $this->preparar('insert into '.$this->entidad.'  '.$comodin);
          $this->autoSetParametros($this->data);
          $this->ejecutarSql();
            
            $bandera=1;
        }
        else{
            $bandera=0;
        }
        echo $this->mensajesUi()->mensajeBooleam($bandera, 'Datos correctos', 'Error registro ya exite! ');
        }else{}
    }
}
